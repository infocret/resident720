<?php

namespace App\Http\Controllers;

// use App\Http\Requests\CreateheadmovRequest;
// use App\Http\Requests\UpdateheadmovRequest;
use App\Http\Requests\CreateinmuchargeRequest;
use App\Http\Requests\UpdateinmuchargeRequest;
use App\Http\Requests\CreateinmumovtoRequest;
use App\Http\Requests\UpdateinmumovtoRequest;

use App\Repositories\inmuchargeRepository;      // cargos aplicados
use App\Repositories\inmumovtoRepository;       // movimientos aplicados 

use App\Repositories\inmuebleRepository;        // consulta inmuebles
use App\Repositories\conceptserviceRepository;  // consulta concepto/servicios
use App\Repositories\catmovtoRepository;        // consulta tipos de movimiento de egresos
use App\Repositories\propertyareasRepository;   // consulta areas
use App\Repositories\providersRepository;       // consulta proveedores
use App\Repositories\measurunitRepository;      // consulta unidades de medida
use App\Repositories\unidadmovtoRepository;     // consulta contratos
use App\Repositories\checkissuanceRepository;   // consulta de aplicaciones de cheques

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Illuminate\Support\Facades\Storage;    // para subir archivos
use App\Traits\SendMailEdoCtaEg;         // Gen PDF y Envio de mail Estado de Cuenta


use Carbon\Carbon;
use App\Traits\GenFolio;                        // Genera Folio

class egresoedoctaController extends AppBaseController
{
    /** @var  headmovRepository */
    private $headmovRepository;

    public function __construct(
        inmuchargeRepository $inmuchargeRepo,
        inmumovtoRepository $inmumovtoRepo,
        inmuebleRepository $inmuebleRepo,
        conceptserviceRepository $conceptserviceRepo,
        catmovtoRepository $catmovtoRepo,
        propertyareasRepository $propertyareasRepo,
        providersRepository $providersRepo,
        measurunitRepository $measurunitRepo,
        unidadmovtoRepository $unidadmovtoRepo,
        checkissuanceRepository $checkissuanceRepo        
        )
    {
        $this->inmuchargeRepository = $inmuchargeRepo;
        $this->inmumovtoRepository = $inmumovtoRepo;
        $this->inmuebleRepository = $inmuebleRepo;
        $this->conceptserviceRepository = $conceptserviceRepo;
        $this->catmovtoRepository = $catmovtoRepo;
        $this->propertyareasRepository = $propertyareasRepo;
        $this->providersRepository = $providersRepo;
        $this->measurunitRepository = $measurunitRepo;
        $this->unidadmovtoRepository = $unidadmovtoRepo; 
        $this->checkissuanceRepository = $checkissuanceRepo;
    }

//============================================================================
//use GenFolio;
use SendMailEdoCtaEg;
//============================================================================

//******************************************************************************************
/**
*    Presenta vista para seleccionar fechas 
*    de periodo de consulta de egresos.   
*    @param  condomid -inmuebles.id - condominio id
*    @return  Response
*/
 public function selperiod($condomid)
 {
    $dfrom  = carbon::now()->startOfMonth()->toDateString();
    $dto    = carbon::now()->endOfMonth()->toDateString();
    //$unids = $this->inmuebleRepository->gInmuUnidades($condomid);
    //$concepservs = $this->conceptserviceRepository->all();
   
     return view('egresos.selperiod')
    ->with('condomid',$condomid)
    ->with('dfrom',$dfrom)
    ->with('dto',$dto)   
    ;
 }
 
//******************************************************************************************
 /**
*    Recibe las fechas seleccionadas y llama a la consulta
*    @return  Response
*/
public function sendperiod(Request $request)
{
    //dd($request->all());   

  // "_token" => "bsauMUVpiVMPieSn7bRMIXAxsYCr84T3gB54GQIG"
  // "dfrom" => "2020-06-01"
  // "dto" => "2020-06-30"
  // "condomid" => "68"
  // "folio" => null

    $dfrom      = $request->dfrom;
    $dto        = $request->dto;
    $condomid   = $request->condomid;
   // $unidid     = $request->unidadid;
    $folio      = $request->folio;   
   // $conceptservid = $request->conceptserv_id ;
   //dd($flong);    
  return redirect(route('egresos.indexb',[$condomid,$dfrom,$dto]));
    
}
//******************************************************************************************
/**
 * Display a listing of the egresos.
 *
 * @param Request $request
 * @return Response
 */
    public function indexb(Request $request,$condomid,$dfrom,$dto)
    {

    //$egresos = $this->inmuebleRepository->getegresos($condomid,$dfrom,$dto);
    $egresos = $this->inmuchargeRepository->gEgPayBalConcept($condomid,$dfrom,$dto);
        //dd($egresos);

    return view('egresos.indexb')
           ->with('egresos', $egresos)
           ->with('condomid',$condomid)
           ;

    }

//******************************************************************************************
/**
 * Lista de cargos, pagos y saldos aplicados 
 * a un concepto/servicio especifico por id de cargo
 *
 * @param   chrid   - inmucharges.id - id de cargo
 * @param   unidid  - inmueble_id - Unidad
 * @return  Response
 */
//public function indexd($chrid,$dfrom,$dto)
public function indexc($chrid)
    {
    $condomid = Session('condominioexpid');      
    $charges = $this->inmuchargeRepository->gMovtoCH($chrid);     
    
    if ($charges->isEmpty()) {
        Flash::error('No se localizo informacion para ese folio o Id de concepto.');
        return redirect(route('edoscta.selperiod',[$condomid]));
    }  
    $charge = $charges[0];

    $cargos = $this->inmumovtoRepository->GetMovtos($chrid,'E');
    $pagos  = $this->inmumovtoRepository->GetMovtos($chrid,'P');  

    $totpagos = $this->inmumovtoRepository->GetPays($chrid,'A');        
    $tpagos = $totpagos->tpagos;

    $checkissuances = $this->checkissuanceRepository->gapchecks();

       return view('egresos.indexc')
            ->with('charge',$charge)
            ->with('cargos', $cargos)
            ->with('pagos', $pagos)              
            ->with('tpagos',$tpagos) 
            ->with('checkissuances',$checkissuances) 
            //->with('dfrom',$dfrom)
            //->with('dto',$dto)           
            ;
    }

//******************************************************************************************
    /**
     * Muestra Estado de cuenta en HTML
     *
     * @param   $hmoveid - inmucharge.id  
     * @return  Response
     */
    public function indexd($chrid)
    {
        // Consulta registro de Cargo (Cabecera)      
        $charges = $this->inmuchargeRepository->gMovtoCH($chrid);  
        
        // if (empty($charges)) {
        //    Flash::error('Datos no localizados.');
        //    return redirect(route('edoscta.indexb',$unidid));
        // }
        $charge = $charges[0];           // obtener el primer registro y solo ese                
        $chrid = $charge->chrid;         // obtener el id de la cabecera                
        $unidid = $charge->unidid;       // obtener el id de la unidad (immuebles.id)         
        $conceptocve = $charge->chrcve;    // obtener cve del concepto / serv   
        //$provider = $charge->providrazsoc;    


        // Consulta Todos los Movimientos aplicados de un cargo 
        $details = $this->inmumovtoRepository->GetMovtos($chrid,'T');         

        // Obtiene a la persona que esta relacionada como propietario
        // $personas = $this->personaRepository->gpropietario($unidid);        
        // $propietario = $personas[0];                
         
        //Datos de proveedor
        //$providers = $this->providersRepository->findWithoutFail($inmucharge->provider_id);  

        // Obtiene nom condominio        
        //$condomi = $this->inmuchargeRepository->gChCondomiName($unidid);                      
        $condomi = $this->inmuebleRepository->findWithoutFail($unidid);  
        $ncondomi =  $condomi->ident." ".$condomi->descripcion;// arma nombre condominio  
        $condomid = $condomi->id;    // id del condominio
//dd($condomid);
        $filename =  $charge->chrfolio.'.pdf';
        $filepath =  'movscond1/';
        $exists = Storage::disk('pdftemp')->exists($filename); 

        // Obtiene datos de la cuenta relacionada a un concepto / servicio $conceptocve);
        //$arr_propaccount = 
        //$this->conceptservpropaccountRepository->gCtaConcept($conceptocve);
        
        //$propaccount = $arr_propaccount[0];  
       
        $totpagos = $this->inmumovtoRepository->GetPays($chrid,'P');                        
        $tpagos = $totpagos->tpagos;

        $checkissuances = $this->checkissuanceRepository->gapchecks();
        //setlocale(LC_ALL, 'es_ES');
        //Carbon::setLocale('es');
        //$fecha = Carbon::parse($mhead->ffact);
        //$fecha->format("F"); // Inglés.
        //$nmes = $fecha->formatLocalized('%B');// mes en idioma español         
        //dd($mes);
        
        //dd($charge);
        //dd($details);
        //dd($propietario);
        //dd($ncondomi);
        //dd($arr_propaccount);
        //dd($propaccount );
        //dd($referencia);
        //dd($rback);
        //dd($tpagos);

       
        // dd($edoscta);
       return view('egresos.movtob')
            ->with('charge', $charge)
            ->with('details',$details)
            // ->with('propietario',$propietario)
            ->with('ncondomi',$ncondomi)
            ->with('filename',$filename)
            ->with('filepath',$filepath)
            ->with('exists',$exists)
            ->with('unidid',$unidid)
            //->with('propaccount',$propaccount)  
            ->with('tpagos',$tpagos)   
            ->with('checkissuances',$checkissuances)        
            ;
    }

//*******************************************************************************

    /**
     * Lista de cheques emitidos a un cargo (inmuchargeid)
     *
     * @param Request $request     * 
     * @return Response
     */
    public function indexch(Request $request, $inmuchargeid)
    {
        $this->checkissuanceRepository->pushCriteria(new RequestCriteria($request));

        $checkissuances = $this->checkissuanceRepository->gapchecksbycharge($inmuchargeid);        
        
        $charges = $this->inmuchargeRepository->gMovtoCH($inmuchargeid);
        $charge = $charges[0];
        $chtot = $this->checkissuanceRepository->gapcheckssum($inmuchargeid);        

        return view('checkissuances.indexch')
            ->with('charge', $charge)
            ->with('chtot', $chtot)
            ->with('checkissuances', $checkissuances)        
            ;
        
    }


    /**
     * Exporta recibo a un archivo PDF
     *
     * @param  int chrid  - inmucharges.id
     * @param  int action - accion : 0 muestra pdf / 1 descarga pdf
     * @return Response
     */
    public function showpdf($chrid,$action)
    {
      
      //Crea PDF en trait
      $pdfile = $this->pdfedoctaegresosids($chrid) ;      
      //Pido 0 mostrar / 1 descargar                                              
      if ($action == 0) {                     //Show PDF
      // Mostrar PDF existente en explorador
      return Redirect(url($pdfile->pathfile));  
      }
      else {                                  //Download PDF
      // Agrega cabecera de mimetype
      $headers = ['Content-Type' => 'application/pdf',];                                      
      // Descarga el archivo existente
      return response()->download($pdfile->pathfile, $pdfile->filename, $headers); 
      }
    }


//******************************************************************************
    public function mailpdf($hmoveid)   {
    
    $mailhead = $this->creamailheadeg();

    return view('egresos.emailsend')
     ->with('hmoveid',$hmoveid)
     ->with('mailhead',$mailhead)
    ;
    }

    public function sendrecipmail(Request $request)
    {   
       $mailhead = new \stdClass();
        $mailhead->tfrom = $request->tfrom; // email remitente
        $mailhead->tname = $request->tname; // Nombre remitente
        $mailhead->tto   = $request->tto;   // email destinatario
        $mailhead->tsub  = $request->tsub;  // asunto
        $mailhead->tmsg  = $request->tmsg;  // mensage
        $hmoveid=$request->thid;    // recupera id de cabecera de movimiento

        $chrid  = $request->thid;   // recupera id de cabecera de movimiento
        $movid  = $request->tmid;   // recupera id de movimiento 


        //*****************   Envia Mail   ******************************
        $result = $this->egsendmailbychargeid($chrid,$mailhead);

        Flash::success('Correo enviado.');                  // menaje Flash

        return redirect(route('egresos.indexd',$chrid));  
    }

//******************************************************************************

} //cierre de clase controller
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\inmuchargeRepository;  //Nueva aplicacion de cargos 2019
use App\Repositories\inmumovtoRepository;   //Nueva aplicacion de cargos 2019
use App\Repositories\personaRepository;
use App\Repositories\conceptservpropaccountRepository; // Cuentas rel Concepto/serv
use App\Repositories\propertyparameterRepository;
use App\Repositories\maillistRepository;             // mailists
use App\Repositories\inmuebleRepository;  
use App\Repositories\conceptserviceRepository;

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;    // para subir archivos
// use \Milon\Barcode\DNS1D;              // Para generar codigo de barras
// use \Milon\Barcode\DNS2D;              // Para generar codigo de barras
use \Carbon\Carbon;                    // Para formateo de fechas
// use Barryvdh\DomPDF\Facade as PDF;     // Para generar PDF
// use Illuminate\Support\Facades\Mail;   // Fachada Mail
//use App\Mail\EmailRecipSend;           // clase para enviar correo

use App\Traits\SendMailEdoCta;         // Gen PDF y Envio de mail Estado de Cuenta

class condominioectaController extends AppBaseController
{
    /** @var  movtoheadRepository */
    private $movtoheadRepository;

    public function __construct(
        inmuchargeRepository $inmuchargeRepo,
        inmumovtoRepository $inmumovtoRepo,
        personaRepository $personaRepo,
        conceptservpropaccountRepository $conceptservpropaccountRepo,
        propertyparameterRepository $propertyparameterRepo,
        conceptserviceRepository $conceptserviceRepo,
        inmuebleRepository $inmuebleRepo
            )
    {
        $this->inmuchargeRepository = $inmuchargeRepo;
        $this->inmumovtoRepository = $inmumovtoRepo;
        // $this->movtoheadRepository = $movtoheadRepo;
        // $this->movtodetailRepository = $movtodetailRepo;
        $this->personaRepository = $personaRepo;
       // $this->propaccountRepository = $propaccountRepo;
        $this->conceptservpropaccountRepository = $conceptservpropaccountRepo;
        $this->propertyparameterRepository = $propertyparameterRepo;
        $this->conceptserviceRepository = $conceptserviceRepo; 
        $this->inmuebleRepository = $inmuebleRepo;
    }
//============================================================================
use SendMailEdoCta;
//============================================================================

/**
*    Presenta vista para seleccionar fechas 
*    de periodo de consulta de movimientos.   
*    @param  condomid -inmuebles.id - condominio id
*    @return  Response
*/
 public function selperiod($condomid)
 {
    $dfrom  = carbon::now()->startOfMonth()->toDateString();
    $dto    = carbon::now()->endOfMonth()->toDateString();
    $unids = $this->inmuebleRepository->gInmuUnidades($condomid);
    $concepservs = $this->conceptserviceRepository->all();
     return view('expededocta.selperiod')
    ->with('condomid',$condomid)
    ->with('dfrom',$dfrom)
    ->with('dto',$dto)
    ->with('unids',$unids)
    ->with ('concepservs',$concepservs)
    ;
 }

/**
*    Recibe las fechas seleccionadas y llama a la consulta
*    @return  Response
*/
public function sendperiod(Request $request)
{
   //dd($request->all());        
          // "dfrom" => "2019-10-01"
          // "dto" => "2019-10-31"
          // "condomid" => "68"
          // "unidadid" => "79" , 0
          // "folio" => "0000000000000000000000000110"0" , null
    $dfrom      = $request->dfrom;
    $dto        = $request->dto;
    $condomid   = $request->condomid;
    $unidid     = $request->unidadid;    
    $folio      = $request->folio; 

    // *********** si seleccionan algun concepto  ***********
    if (is_null( $request->conceptserv_id))
    {
    $conceptservid = 0;
    }
    else
    {
     $conceptservid = $request->conceptserv_id ;
    }


    // *********** si se capturo algun folio  ***********
    if (!is_null($folio) ) {
      // identifica si es inmucharge o inmumovto
      $tipo = substr($folio, strlen($folio)-1, 1);   
      // obtiene el id del folio capturado
      $flong = strlen($folio);
      if ($flong == 28) {
          $chrid = intval(substr($folio, 22, 5)); 
      }
      else{
          $chrid = $folio;
      }
      // si es folio de inmumovto consulta registro y obtiene id de inmucharge
     if ($tipo == 2){
      $inmumovto = $this->inmumovtoRepository->findWithoutFail($chrid);
       $chrid = $inmumovto->inmucharg_id;
      }

        // *********** consulta edo cta de ese id de inmucharge
        return redirect(route('edoscta.indexd',[$chrid,$dfrom,$dto,$conceptservid]));        

    } elseif ($unidid != 0) {
        // *********** consulta cargos de una unidad          
        return redirect(route('edoscta.indexb',[$unidid,$dfrom,$dto,$conceptservid]));
    } else {        
        // ***********  consulta totales de todas las unidades
        return redirect(route('edoscta.index',[$condomid,$dfrom,$dto,$conceptservid]));
    } 
}



/**
 * Lista de cargos, pagos y saldos aplicados 
 * a condomnio por unidad en un periodo
 *
 * @param   condomid - inmueble_id - Condominio
 * @param   dfrom   - Fecha inicio de periodo
 * @param   dot     - Fecha fin de periodo
 * @return  Response
 */
    public function index($condomid,$dfrom,$dto,$cservid)
    {    
       $condoname = Session('condonomexp');             
       //$edoscta = $this->inmuchargeRepository->gNCondomiCargos($condomid);
       $edoscta = $this->inmuchargeRepository->
       gChargePayBalance($condomid,$dfrom,$dto,$cservid);

       $cservi = 'TOTALES - '.$condoname;
       if ($cservid>0) {
        $cserv = $this->conceptserviceRepository->gconcbyid($cservid);
        $cservi .= ' - '.$cserv->cve.'-'.$cserv->name;
       }
       $cservi .= ' - Periodo: '.$dfrom.' a '.$dto;

       if ($edoscta->isEmpty()) {
            Flash::error('No se localizaron movimientos.');
            return redirect(route('edoscta.selperiod',[$condomid]));
        }

       //dd($edoscta);        
       return view('expededocta.index')
            ->with('condomid',$condomid)
            ->with('edoscta', $edoscta)
            ->with('condoname', $condoname)
            ->with('dfrom',$dfrom)
            ->with('dto',$dto)
            ->with('cservid',$cservid)
            ->with('cservi',$cservi)
            ;
    }

 /**
 * Lista de cargos, pagos y saldos aplicados 
 * a una unidad por concepto en un periodo
 *
 * @param   unidid  - inmueble_id - Unidad
 * @param   dfrom   - Fecha inicio de periodo
 * @param   dot     - Fecha fin de periodo
 * @return  Response
 */

    public function indexb($unidid,$dfrom,$dto,$cservid)
    {
        $condomid = Session('condominioexpid'); 
        
        $edoscta = $this->inmuchargeRepository->
            gChargePayBalConcept($condomid,$unidid,$dfrom,$dto,$cservid);

        if ($edoscta->isEmpty()) {
            Flash::error('No se localizaron movimientos para esa unidad.');
            return redirect(route('edoscta.selperiod',[$condomid]));
        }
        
        $unidadn = $edoscta[0]->unidcve.' - '.$edoscta[0]->unidnom ;


       $cservi = 'TOTALES - '.$unidadn;
       if ($cservid>0) {
        $cserv = $this->conceptserviceRepository->gconcbyid($cservid);
        $cservi .= ' - '.$cserv->cve.'-'.$cserv->name;
       }
       $cservi .= ' - Periodo: '.$dfrom.' a '.$dto;

      return view('expededocta.indexb')
            ->with('edoscta', $edoscta)
            ->with('unidadn', $unidadn)
            ->with('condomid',$condomid)        
            ->with('dfrom',$dfrom)  
            ->with('dto',$dto)              
            ->with('cservid',$cservid) 
            ->with('cservi',$cservi)             
            ;
    }

/**
 * Lista de cargos, pagos y saldos aplicados 
 * a un concepto/servicio especifico de una unidad 
 * por id de cargo
 *
 * @param   chrid   - inmucharges.id - id de cargo
 * @param   unidid  - inmueble_id - Unidad
 * @return  Response
 */
  public function indexd($chrid,$dfrom,$dto,$cservid)
    {
    $condomid = Session('condominioexpid');      
    $charges = $this->inmuchargeRepository->gMovtoCH($chrid);     
    
    if ($charges->isEmpty()) {
        Flash::error('No se localizo informacion para ese folio o no es folio de concepto/servicio.');
        return redirect(route('edoscta.selperiod',[$condomid]));
    }  

    $charge = $charges[0];

    $cargos = $this->inmumovtoRepository->GetMovtos($chrid,'C');
    $pagos  = $this->inmumovtoRepository->GetMovtos($chrid,'A'); 
//dd($pagos);
    $totpagos = $this->inmumovtoRepository->GetPays($chrid,'A');        
    $tpagos = $totpagos->tpagos;

       return view('expededocta.indexd')
            ->with('charge',$charge)
            ->with('cargos', $cargos)
            ->with('pagos', $pagos)  
            ->with('tpagos',$tpagos) 
            ->with('dfrom',$dfrom)
            ->with('dto',$dto)   
            ->with('cservid',$cservid)          
            ;
    }


    /**
     * Muestra Estado de cuenta en HTML
     *
     * @param   $hmoveid - inmucharge.id  
     * @return  Response
     */
    public function indexc($chrid)
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

        // Consulta Todos los Movimientos aplicados de un cargo 
        $details = $this->inmumovtoRepository->GetMovtos($chrid,'T'); 
        //$details = $this->inmumovtoRepository->GetMovtosb($chrid); 
        

        // Obtiene a la persona que esta relacionada como propietario
        $personas = $this->personaRepository->gpropietario($unidid);        
        $propietario = $personas[0];                

        // Obtiene nom condominio
        //$condomi = $this->movtoheadRepository->gCondomiName($unidid);        
        $condomi = $this->inmuchargeRepository->gChCondomiName($unidid);                      
        $ncondomi =  $condomi[0]->ident." ".$condomi[0]->descripcion;// arma nombre condominio  
        $condomid = $condomi[0]->id;    // id del condominio

        $filename =  $charge->chrfolio.'.pdf';
        $filepath =  'movscond1/';
        $exists = Storage::disk('pdftemp')->exists($filename); 
        

        // Obtiene datos de la cuenta relacionada a un concepto / servicio $conceptocve);
        $arr_propaccount = 
        $this->conceptservpropaccountRepository->gCtaConcept($conceptocve);
        
        $propaccount = $arr_propaccount[0];  
       
        $totpagos = $this->inmumovtoRepository->GetPays($chrid,'A');        
        $tpagos = $totpagos->tpagos;

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
       return view('expededocta.movtob')
            ->with('charge', $charge)
            ->with('details',$details)
            ->with('propietario',$propietario)
            ->with('ncondomi',$ncondomi)
            ->with('filename',$filename)
            ->with('filepath',$filepath)
            ->with('exists',$exists)
            ->with('unidid',$unidid)
            ->with('propaccount',$propaccount)  
            ->with('tpagos',$tpagos)          
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
      $pdfile = $this->pdfedoctaids($chrid) ;      
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
      
//==============================================================================
//******************************************************************************
    public function mailpdf($hmoveid)   {
    
    $mailhead = $this->creamailhead();

    return view('expededocta.emailsend')
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
        $result = $this->sendmailbychargeid($chrid,$mailhead);

        Flash::success('Correo enviado.');                  // menaje Flash

        return redirect(route('edoscta.indexc',$chrid));  
        }

public function egresos($condomid)
{
    $dfrom  = '2015-01-01';//carbon::now()->startOfYear()->toDateString();
    $dto    = carbon::now()->endOfMonth()->toDateString();

    //dd($dto);
    
    $egresos = $this->inmuebleRepository->getegresos($condomid,$dfrom,$dto);

      // dd($egresos);

       // if ($egresos->isEmpty()) {
       //      Flash::error('No se localizaron egresos.');
       //      return redirect(route('edoscta.selperiod',[$condomid]));
       //  }
        
       return view('expededocta.indexe')
            ->with('egresos', $egresos)
           ;
}

}

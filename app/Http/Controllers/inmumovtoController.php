<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CreateinmumovtoRequest;
use App\Http\Requests\UpdateinmumovtoRequest;
use App\Repositories\inmuchargeRepository;      // cargos aplicados
use App\Repositories\unidadmovtoRepository;     // contratos
use App\Repositories\inmumovtoRepository;       // movimientos aplicados 
use App\Repositories\personaRepository;         // personas rel a inmueble
use App\Repositories\conceptservpropaccountRepository; // Cuentas rel Concepto/serv
use App\Repositories\measurunitRepository;
use Prettus\Repository\Criteria\RequestCriteria;

use App\Http\Controllers\AppBaseController;
use Flash;
use Response;

use Illuminate\Support\Facades\Storage;     // para subir archivos
 use \Carbon\Carbon;                        // Para formateo de fechas

// use \Milon\Barcode\DNS1D;              // Para generar codigo de barras
// use \Milon\Barcode\DNS2D;              // Para generar codigo de barras
// use Barryvdh\DomPDF\Facade as PDF;     // Para generar PDF
// use Illuminate\Support\Facades\Mail;   // Fachada Mail
// use App\Mail\EmailRecipSend;           // clase para enviar correo

use App\Traits\SendMailEdoCta;         // Gen PDF y Envio de mail Estado de Cuenta

class inmumovtoController extends AppBaseController
{
    /** @var  inmumovtoRepository */
    private $inmumovtoRepository;

    public function __construct(
        inmumovtoRepository $inmumovtoRepo,
        inmuchargeRepository $inmuchargeRepo,
        unidadmovtoRepository $unidadmovtoRepo,
        personaRepository $personaRepo,
        conceptservpropaccountRepository $conceptservpropaccountRepo,
        measurunitRepository $measurunitRepo
    )
    {
        $this->inmumovtoRepository = $inmumovtoRepo;
        $this->inmuchargeRepository = $inmuchargeRepo;
        $this->unidadmovtoRepository = $unidadmovtoRepo; 
        $this->personaRepository = $personaRepo; 
        $this->conceptservpropaccountRepository = $conceptservpropaccountRepo; 
        $this->measurunitRepository = $measurunitRepo;    
    }
//============================================================================
use SendMailEdoCta;
//============================================================================

    /**
     * Muestra Vista para agregar un pago
     * @param   $chargeid - inmucharge.id , $orig - quien llama esta funcion y vista
     * @return Response
     */
    public function createpay($chargeid)
    {        
        // Consulta registro de Cargo (Cabecera)      
        $mheads = $this->inmuchargeRepository->gMovtoCH($chargeid); 
        $mhead = $mheads[0];            // obtener el primer registro y solo ese        
        //dd($mhead);
        $mheadid = $mhead->chrid;       // obtener el id de la cabecera
        $unidid = $mhead->unidid;       // obtener el id de la unidad (immuebles.id) 
        $conceptocve = $mhead->chrcve;  // obtener cve del concepto / serv 
        // Define que se buscaran movimientos 
        // tipo "A" -  abono / pago,"C" -  cargo / adeudo  o "%" - Todos
        $tipomov = 'A'; 
        // Obtiene para select los movimientos de tipo 'A' Abono / Pago 
        // relacionados en el contrato de esa unidad que pueden ser aplicados a este concepto/serv
        //$movtos  = $this->unidadmovtoRepository->gmovtoscontrato($unidid,$tipomov); 
        $movtos  = $this->unidadmovtoRepository->gmovtoscontratob(
        $mhead->unidid, $tipomov , $mhead->conceptservid);        
        // Consulta los movimientos aplicados a este cargo              
        //$details = $this->inmumovtoRepository->gMovtos($mheadid);
        $cargos = $this->inmumovtoRepository->GetMovtos($mheadid,'C');
        $pagos  = $this->inmumovtoRepository->GetMovtos($mheadid,'A');

        // Obtiene a la persona que esta relacionada como propietario
        $personas = $this->personaRepository->gpropietario($unidid);        
        $propietario = $personas[0];    
        // Obtiene nom condominio               
        $condomi = $this->inmuchargeRepository->gChCondomiName($unidid);            
        // arma nombre condominio  
        $ncondomi =  $condomi[0]->ident." ".$condomi[0]->descripcion;
        // id del condominio
        $condomid = $condomi[0]->id;    
        // Obtiene datos de la cuenta relacionada a un concepto / servicio
        $arr_propaccount = 
        $this->conceptservpropaccountRepository->gCtaConcept($conceptocve);
        $propaccount = $arr_propaccount[0];   
        
        //dd($mhead);
        //dd($movtos);
        //dd($propietario);
        //dd($condomi);
        //dd($ncondomi);
        //dd($propaccount);
        
       
        return view('inmumovtos.createpay')
            ->with('mhead', $mhead)           
            ->with('propietario',$propietario)
            ->with('cargos',$cargos)
            ->with('pagos',$pagos)
            ->with('ncondomi',$ncondomi)
            ->with('unidid',$unidid)
            ->with('propaccount',$propaccount)            
            ->with('movtos',$movtos)            
            ; 
    }

    /**
     * Store a newly created inmumovto in storage.
     *
     * @param CreateinmumovtoRequest $request
     *
     * @return Response
     */
    public function storepay(CreateinmumovtoRequest $request)
    {
        $req = $request->all();
        $inmchargeid    = $req['inmucharg_id'];// id de cabecera tabla inmucharges
        $movtodate      = $req['date'];     // fecha de registro de  inmumovto
        $status         = $req['status'];   // estatus de inmumovto
        $apmode         = $req['apmode'];   // apmode
        $flink          = $req['filelink']; // filelink
        $unidmovtoid    = $req['unidmovto_id'];//id de unidmovto
        // Obtiene datos de catmovto        
        $movtos  = $this->unidadmovtoRepository->gcatmovto($unidmovtoid);                
        $catmovtocve = $movtos[0]->cve;
        $catmovtodesc = $movtos[0]->description;
        $unidid = $movtos[0]->inmu_id;

        // Obtiene id de unidad de medida = 'pago'
        $unidmed = $this->measurunitRepository->gunidmed('pago');
        $unidmedid = $unidmed->id;   
        // Obtiene el usuario que registra el pago
        $observ = 'user:'.auth()->user()->id.'-'.auth()->user()->name;
        //Formatea monto    
        $cuanto = number_format($req['balance'], 2, '.', '');        
        //Array para insert
        $input = array(  
            'inmucharg_id'  => $inmchargeid,
            'unidmovto_id'  => $unidmovtoid,            
            'catmovto_cve'  => $catmovtocve,
            'date'          => $movtodate,
            'folio'         => '0000000000000000000000000000',
            'quantity'      => 1,
            'measurunit_id' => $unidmedid,
            'amount'        => $cuanto,
            'balance'       => $cuanto,
            'status'        => $status,
            'apmode'        => $apmode,
            'description'   => $catmovtodesc,
            'observ'        => $observ,
            'filelink'      => $flink 
        );  
        
        //************************************ Inserta Movimiento **************
        $inmumovto = $this->inmumovtoRepository->create($input);
        //************************************ Genera Folio ********************
        //Arma fecha de movto
        $tfecha = Carbon::parse($movtodate);
        $mfecha = $tfecha->month;
        $dfecha = $tfecha->day;
        $afecha = $tfecha->year;
        $afecha = substr($afecha,2,2);   
        //Quta punto a monto  
        $fcuanto= str_replace('.', '', $cuanto);

        // Arma Folio 28 caracteres
        // 3 inmuebleid     1-3
        // 6 fecha          4-9
        // 7 monto          10-16
        // 2 decmales       17-18
        // 4 movtocve       19-22
        // 5 movtoid        23-27
        // 1 1/2            28
        // 069 191010 000330200 1111 00001 2
        //   3      6         9    4     5 1    Tot: 28 
        //0691910100003302001111000012
        //123 456789 0123456 78 9012 34567 8
       
        // 3 inmuebleid
        $folio = str_pad($unidid, 3, "0", STR_PAD_LEFT);        
        // 6 fecha
        $folio = $folio.str_pad($afecha, 2, "0", STR_PAD_LEFT);
        $folio = $folio.str_pad($mfecha, 2, "0", STR_PAD_LEFT);
        $folio = $folio.str_pad($dfecha, 2, "0", STR_PAD_LEFT);
        // 9 monto 
        $folio = $folio.str_pad($fcuanto, 9, "0", STR_PAD_LEFT);        
        // 4 movtocve
        $folio = $folio.str_pad($catmovtocve, 4, "0", STR_PAD_LEFT);
        // 5 inmuchargeid o inmumovtoid
        $folio = $folio.str_pad($inmumovto->id, 5, "0", STR_PAD_LEFT);
        // 1  digito identifica si es cargo 1 o movto 2                
        $folio = $folio.'2';        
        //dd($folio);
        
        //************************************ Actualiza Folio ********************
        $inpmovto = array('folio' => $folio);          
        $inmvtoupd = $this->inmumovtoRepository->update($inpmovto, $inmumovto->id);

        // Actualiza Saldo y estatus        
        $chrfolio  = $this->inmuchargeRepository->gDecpay($inmchargeid,$cuanto); 
        //dd($chrfolio);  
            
        //Elimina PDF de estado de cuenta pues 
        //al actualizar saldos y registrar pago ya no es valido          
        $filename =  $chrfolio.'.pdf';
        $filepath =  'movscond1/';
        $exists = Storage::disk('pdftemp')->exists($filename);  
 
        if ($exists){ // Si existe                    
            Storage::disk('pdftemp')->delete($filename);  
        }
         
        //**********   Genera EdoCta y envia correo  **********        
        $result = $this->sendmailbychargeid($inmchargeid, null);
        //*****************************************************

        Flash::success('Pago registrado y correo enviado, Folio: '.$folio);// .'File:'.$filepath.$filename);

        return redirect(route('cpay.receip',[$inmchargeid,$inmumovto->id]));
    }



    /**
     * Display a listing of the inmumovto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmumovtoRepository->pushCriteria(new RequestCriteria($request));
        $inmumovtos = $this->inmumovtoRepository->paginate(10);

        return view('inmumovtos.index')
            ->with('inmumovtos', $inmumovtos);
    }

    /**
     * Show the form for creating a new inmumovto.
     *
     * @return Response
     */
    public function create()
    {
        return view('inmumovtos.create');
    }

    /**
     * Store a newly created inmumovto in storage.
     *
     * @param CreateinmumovtoRequest $request
     *
     * @return Response
     */
    public function store(CreateinmumovtoRequest $request)
    {
        $input = $request->all();        

        $inmumovto = $this->inmumovtoRepository->create($input);

        Flash::success('Inmumovto saved successfully.');

        return redirect(route('inmumovtos.index'));
    }

    /**
     * Display the specified inmumovto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inmumovto = $this->inmumovtoRepository->findWithoutFail($id);

        if (empty($inmumovto)) {
            Flash::error('Inmumovto not found');

            return redirect(route('inmumovtos.index'));
        }

        return view('inmumovtos.show')->with('inmumovto', $inmumovto);
    }

    /**
     * Show the form for editing the specified inmumovto.
     *
     * @param  int $id
     *
     * @return Response
     */ 
    public function edit($id)
    {
        $inmumovto = $this->inmumovtoRepository->findWithoutFail($id);

        if (empty($inmumovto)) {
            Flash::error('Inmumovto not found');

            return redirect(route('inmumovtos.index'));
        }

        return view('inmumovtos.edit')->with('inmumovto', $inmumovto);
    }

    /**
     * Update the specified inmumovto in storage.
     *
     * @param  int              $id
     * @param UpdateinmumovtoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinmumovtoRequest $request)
    {
        $inmumovto = $this->inmumovtoRepository->findWithoutFail($id);

        if (empty($inmumovto)) {
            Flash::error('Inmumovto not found');

            return redirect(route('inmumovtos.index'));
        }
        

        $inmumovto = $this->inmumovtoRepository->update($request->all(), $id);

        Flash::success('Inmumovto updated successfully.');

        return redirect(route('inmumovtos.index'));
    }

    /**
     * Remove the specified inmumovto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inmumovto = $this->inmumovtoRepository->findWithoutFail($id);

        if (empty($inmumovto)) {
            Flash::error('Inmumovto not found');

            return redirect(route('inmumovtos.index'));
        }

        $this->inmumovtoRepository->delete($id);

        Flash::success('Inmumovto deleted successfully.');

        return redirect(route('inmumovtos.index'));
    }

  /**
     * Funcion que se llama desde el jScript aplimovtos.js 
     * al pulsar boton de cancelacion
     */
    public function getapmovtosed(Request $request,$movtoid)
    {
        // identifica si es una llamada ajax
    if ($request->ajax()){           
        //Obtener datos de conceptservice
        $conceptserv = $this->inmuchargeRepository->getconceptserv($movtoid);       
        // Obtiene datos del catalogo de movimientos aplicables para ese movto y concepto
        $movtos  = $this->unidadmovtoRepository->gmovtoscontratob(
        $conceptserv->inmu_id, $conceptserv->tipo, $conceptserv->id);              
    } // fin de si es llamada ajax
    else
    {
        //Obtener datos de conceptservice
        $conceptserv = $this->inmuchargeRepository->getconceptserv($movtoid);       
        // Obtiene datos del catalogo de movimientos aplicables para ese movto y concepto
        $movtos  = $this->unidadmovtoRepository->gmovtoscontratob(
        $conceptserv->inmu_id, $conceptserv->tipo, $conceptserv->id);  
        dd($movtos);
    }
        // los devuelve para llenar select y datos de pantalla
        return response()->json($movtos);      
        
    }




    /**
     * Funcion que se llama desde el jScript aplimovtos.js 
     * al pulsar boton de cancelacion
     */
    public function getapmovtos(Request $request,$movtoid)
    {
        // identifica si es una llamada ajax
    if ($request->ajax()){           
        //Obtener datos de conceptservice
        $conceptserv = $this->inmuchargeRepository->getconceptserv($movtoid);       
        // "inmu_id" => 120
        // "id" => 1
        // "tipo" => "A"
        //----  Como es una cancelacion inbierte el tipo de movimientos a mostrar
         if ($conceptserv->tipo == 'A'){ $tipo = 'C'; }
         else { $tipo = 'A'; }  
        // Obtiene datos del catalogo de movimientos aplicables para ese movto y concepto
        $movtos  = $this->unidadmovtoRepository->gmovtoscontratob(
        $conceptserv->inmu_id, $tipo, $conceptserv->id);  
            // "id" => 6
            // "conceptserv_id" => 1
            // "cve" => 1111
            // "tipo" => "A"
            // "description" => "Abono Pago Cuota mantenimiento"
    } // fin de si es llamada ajax
        // los devuelve para llenar select y datos de pantalla
        return response()->json($movtos); 
        // para proebas
        // Obtiene datos del catalogo de movimientos aplicables para ese movto y concepto
        //$movtos  = $this->unidadmovtoRepository->gmovtoscontratob(120, 'C', 1); 
        //return response()->json($movtos); 

    }

  /**
     * Guarda el movimiento.
     *
     * @param CreateinmumovtoRequest $request
     *
     * @return Response
     */
    public function storemovc(Request $request)
    {

  // "date" => "2022-04-03"
  // "smovto" => "1128"
  // "monto" => "3302.11"
  // "tobserv" => "N/A"
  // "concepserv_id" => "0"
  // "cinmuch_id" => "377"
  // "inmovto_id" => "744"
  // "cdfrom" => "2018-04-01"
  // "cdto" => "2022-04-30"

      //dd($request->all());
        $req= $request->all();

        $cservid    = $req['concepserv_id'];  //id de concept/service para filtro
        $inmumovid  = $req['inmovto_id'];     //id del movimiento cancelado
        //cortar las observaciones a 240 caracteres y concatena folio del movimiento cancelado
        $cobserv    = substr($req['tobserv'],0, 240).'|M:'.$inmumovid;
        // arma array para insertar movde cancelacion
         $inputx = array(  
            'inmucharg_id'  => $req['cinmuch_id'],
            'unidmovtoid'   => $req['smovto'],
            'movtodate'     => $req['date'],
            'monto'         => $req['monto'],            
            'status'        => 'Creado',    
            'apmode'        => 'Usuario',
            'observ'        =>  $cobserv  
        );
        // ***************** Inserta el movto de cancelacion  *********************************
        // $inmchargeid,$unidmovtoid,$movtodate,$monto,$status,$apmode,$observ
         $result = $this->storexmovto($inputx);

        //******** Actualiza Status y observaciones de movimiento cancelado ********************
        $movtocancelado = $this->inmumovtoRepository->findWithoutFail($inmumovid);
        $movtoobserv    = $movtocancelado->observ ; 
        $mobserv    = $movtoobserv.'|C:'.$result['cmovid'];    //concatena id del mov de cancelacion
        $movupdate  = array('status' => 'Cancelado','observ' => $mobserv );          
        $inmvtoupd  = $this->inmumovtoRepository->update($movupdate, $inmumovid);

        
        //dd($inmvtoupd);

        $inmchargeid    = $req['cinmuch_id'];        
        $dfrom          = $req['cdfrom']; ;
        $dto            = $req['cdto']; ;

      Flash::success('Moimiento registrado, Id: '.$result['cmovid']);// .'File:'.$filepath.$filename);

        return redirect(route('edoscta.indexd',[$inmchargeid,$dfrom,$dto,$cservid]));
    }


    /**
     * Inserta movimiento X (cualquiera)
     *
     * 
     *
     * @return Response
     */
    public function storexmovto($inputxc) {

  // "inmucharg_id" => "377"
  // "unidmovtoid" => "1128"
  // "movtodate" => "2022-03-20"
  // "monto" => "3302.11"
  // "status" => "Creado"
  // "apmode" => "Usuario"
  // "observ" => "N/A"
                // dd($inputxc['unidmovtoid']);
    $unidmovtoid    = $inputxc['unidmovtoid'];
    $cobserv        = $inputxc['observ'];
    $montoc         = $inputxc['monto'];
    $inmchargeid    = $inputxc['inmucharg_id'];
    $movtodate      = $inputxc['movtodate'];
    $status         = $inputxc['status'];
    $apmode         = $inputxc['apmode'];

    // Obtiene datos de catmovto         
        $movtos  = $this->unidadmovtoRepository->gcatmovto($unidmovtoid);        

        $catmovtocve    = $movtos[0]->cve;
        $catmovtodesc   = $movtos[0]->description;
        $unidid         = $movtos[0]->inmu_id;
        $catmovtipo     = $movtos[0]->tipo;


        // Obtiene id de unidad de medida = 'movimiento'
        $unidmed = $this->measurunitRepository->gunidmed('movimiento');
        $unidmedid = $unidmed->id;   
        // Obtiene el usuario que registra el pago
        $observ =  'user:'.auth()->user()->id.'-'.auth()->user()->name.'|'.$cobserv;
        //Formatea monto    
        $cuanto = number_format($montoc, 2, '.', '');        
        //Array para insert
        $input = array(  
            'inmucharg_id'  => $inmchargeid,
            'unidmovto_id'  => $unidmovtoid,            
            'catmovto_cve'  => $catmovtocve,
            'date'          => $movtodate,
            'folio'         => '0000000000000000000000000000',
            'quantity'      => 1,
            'measurunit_id' => $unidmedid,
            'amount'        => $cuanto,
            'balance'       => $cuanto,
            'status'        => $status,
            'apmode'        => $apmode,
            'description'   => $catmovtodesc,
            'observ'        => $observ,
            'filelink'      => 'N/A'
        );  
        
        //************************************ Inserta Movimiento **************
        $inmumovto = $this->inmumovtoRepository->create($input);
        //************************************ Genera Folio ********************
        //Arma fecha de movto
        $tfecha = Carbon::parse($movtodate);
        $mfecha = $tfecha->month;
        $dfecha = $tfecha->day;
        $afecha = $tfecha->year;
        $afecha = substr($afecha,2,2);   
        //Quta punto a monto  
        $fcuanto= str_replace('.', '', $cuanto);

        // Arma Folio 28 caracteres
        // 3 inmuebleid     1-3
        // 6 fecha          4-9
        // 7 monto          10-16
        // 2 decmales       17-18
        // 4 movtocve       19-22
        // 5 movtoid        23-27
        // 1 1/2            28
        // 069 191010 000330200 1111 00001 2
        //   3      6         9    4     5 1    Tot: 28 
        //0691910100003302001111000012
        //123 456789 0123456 78 9012 34567 8
       
        // 3 inmuebleid
        $folio = str_pad($unidid, 3, "0", STR_PAD_LEFT);        
        // 6 fecha
        $folio = $folio.str_pad($afecha, 2, "0", STR_PAD_LEFT);
        $folio = $folio.str_pad($mfecha, 2, "0", STR_PAD_LEFT);
        $folio = $folio.str_pad($dfecha, 2, "0", STR_PAD_LEFT);
        // 9 monto 
        $folio = $folio.str_pad($fcuanto, 9, "0", STR_PAD_LEFT);        
        // 4 movtocve
        $folio = $folio.str_pad($catmovtocve, 4, "0", STR_PAD_LEFT);
        // 5 inmuchargeid o inmumovtoid
        $folio = $folio.str_pad($inmumovto->id, 5, "0", STR_PAD_LEFT);
        // 1  digito identifica si es cargo 1 o movto 2                
        $folio = $folio.'2';        
        //dd($folio);
        
        //************************************ Actualiza Folio ********************
        $inpmovto = array('folio' => $folio);          
        $inmvtoupd = $this->inmumovtoRepository->update($inpmovto, $inmumovto->id);

        if ( $catmovtipo  == 'C') { $cuanto = $cuanto * -1; }; // Si es cargo debe aumentar saldo
        // Actualiza Saldo y estatus        
        $chrfolio  = $this->inmuchargeRepository->gDecpay($inmchargeid,$cuanto); 
        //dd($chrfolio);  

        // //Elimina PDF de estado de cuenta pues 
        // //al actualizar saldos y registrar pago ya no es valido          
        // $filename =  $chrfolio.'.pdf';
        // $filepath =  'movscond1/';
        // $exists = Storage::disk('pdftemp')->exists($filename);  
 
        // if ($exists){ // Si existe                    
        //     Storage::disk('pdftemp')->delete($filename);  
        // }
         
        // //**********   Genera EdoCta y envia correo  **********        
        // $result = $this->sendmailbychargeid($inmchargeid, null);
        // //*****************************************************

        return array('folio'  => $chrfolio,'cmovid'  => $inmumovto->id) ;
    } //fin de funcion reg movto X



  /**
     * consulta desde aplimovtos.js  
     * para ventana popup expededocta.rollbackpop
     * para reversar una cancelacion
     *
     * @return Response,
     */
    public function rbackc(Request $request,$movcancelid) {

      // identifica si es una llamada ajax
    if ($request->ajax()){      
    // 1.- Tomar el id de la cancelacion(can) y buscar el registro
    $movcan   = $this->inmumovtoRepository->findWithoutFail($movcancelid);
    // 2.- Del campo observ tomar el id del movimiento cancelado(pago) 
    $cobserv  = $movcan->observ;           //obtenemos el valor del campo observ
    $movtoid  = strstr($cobserv , '|M:');     //toma solo la seccion de |M:999
    $movtoid  = str_replace ( '|M:', '', $movtoid );  //elimina |M: y deja solo el id       
    // 3.- Buscar el movimiento cancelado (pagp)
    $movpay   = $this->inmumovtoRepository->findWithoutFail($movtoid);
    }
    // 4.- devuelve registro de movimiento (pago)
      return response()->json($movpay); 

    }


  /**
     * Realiza Roll back de cancelacion 
     * desde ventana popup expededocta.rollbackpop
     *
     * @param  $request
     *
     * @return Response
     */
    public function aplirback(Request $request)
    {

  // "roncepserv_id" => "0"
  // "rinmuch_id" => "377"
  // "rmovcancel_id" => "1988"
  // "rmovto_id" => "0"
  // "rdfrom" => "2018-04-01"
  // "rdto" => "2022-04-30"
      //dd($request->all());
    $req            = $request->all();
    $movtoid        = $req['rmovto_id'];       //id del movimiento cancelado (pago)
    $movcancelid    = $req['rmovcancel_id'];   //id del movimiento de cancelacion
    $chrid          = $req['rinmuch_id'];     //id de inmucharge
    $dfrom          = $req['rdfrom'];         //Filtro fecha desde
    $dto            = $req['rdto'];           //Filtro fecha hasta
    $conceptservid  = $req['roncepserv_id'];  //id del concepto/servicio


    // 1.- Buscar el movimiento cancelado (pagp)
    $movpay = $this->inmumovtoRepository->findWithoutFail($movtoid);

    // 2.- Eliminar el id del campo de observ en el movimiento cancelado(pago)
    $pobserv  = $movpay->observ;              //obtenemos el valor del campo observ
    $pos = strpos($pobserv, '|C:');           //obtenemos la posicion de seccion de id
    $pobserv = substr ($pobserv, 0 , $pos);   //obtenemos las observaciones sin la seccion de id
    $mupdate = array('status'  => 'Generado', 'observ'   => $pobserv );// arma array de campos  
    // 3.- Actualiza status y observacion de registro de movimiento (pago)
    $movpay = $this->inmumovtoRepository->update($mupdate, $movtoid); // ejecuta update

    // 3.- Restar el monto del movimiento cancelado(pago) del registro de inmucharge
    $cuanto       = $movpay->amount;
    $inmchargeid  = $movpay->inmucharg_id;
    
    // 4.- Actualiza Saldo y estatus        
    $chrfolio  = $this->inmuchargeRepository->gDecpay($inmchargeid,$cuanto);

    // 5.- Actualiza status de movimiento de cancelacion a reversado
    $mupdate = array('status'  => 'Reversado');// arma array de campos 
    $movcan = $this->inmumovtoRepository->update($mupdate, $movcancelid); // ejecuta update

    // 6.- Eliminar el movimiento de cancelacion (can)
     $this->inmumovtoRepository->Delete($movcancelid);

      Flash::success('Se reverso la cancelacion con Id: '.$movcan->id);

     // Devolver a vista de consulta indexd 
    return redirect(route('edoscta.indexd',[$chrid,$dfrom,$dto,$conceptservid]));     
    }




  /**
     * Para realizar un rollback de cancelacion por el id
     * desde menu dev 
     * 
     *
     * @return Response,
     */
    public function rbackcancel($movcancelid) {

    // 1.- Tomar el id de la cancelacion(can) y buscar el registro
    $movcancel = $this->inmumovtoRepository->findWithoutFail($movcancelid);
    // "id" => 1988
    // "inmucharg_id" => 377
    // "unidmovto_id" => 1128
    // "catmovto_cve" => 1106
    // "date" => "2022-04-04"
    // "folio" => "1202204040003302111106019882"
    // "quantity" => "1.0000"
    // "measurunit_id" => 26
    // "amount" => "3302.1100"
    // "balance" => "3302.1100"
    // "status" => "Creado"
    // "apmode" => "Usuario"
    // "description" => "Cargo por Devolucion de pago Mtto"
    // "observ" => "user:1-Julio buendia|N/A|M:744"
    // "filelink" => "N/A"
    // "created_at" => "2022-04-04 02:52:14"
    // "updated_at" => "2022-04-04 02:52:14"
    // "deleted_at" => null
  
    // 2.- Del campo observ tomar el id del movimiento cancelado(pago) 
    $cobserv  = $movcancel->observ;           //obtenemos el valor del campo observ
    $movtoid  = strstr($cobserv , '|M:');     //toma solo la seccion de |M:999
    $movtoid  = str_replace ( '|M:', '', $movtoid );  //elimina |M: y deja solo el id       

     // 3.- Buscar el movimiento cancelado (pagp)
     $movpay = $this->inmumovtoRepository->findWithoutFail($movtoid);
    // "id" => 744
    // "inmucharg_id" => 377
    // "unidmovto_id" => 6
    // "catmovto_cve" => 1111
    // "date" => "2019-04-30"
    // "folio" => "1201904300003302111111007442"
    // "quantity" => "1.0000"
    // "measurunit_id" => 25
    // "amount" => "3302.1100"
    // "balance" => "3302.1100"
    // "status" => "Cancelado"
    // "apmode" => "Automatico"
    // "description" => "Abono Pago Cuota mantenimiento"
    // "observ" => "Pagado por Julio|C:1988"
    // "filelink" => "N/A"
    // "created_at" => "2019-11-22 18:29:32"
    // "updated_at" => "2022-04-04 02:52:14"
    // "deleted_at" => null
    //dd( $movpay);
              
    // 4.- Cambiar el estatus del movimiento cancelado(pago) a 'Generado'
    // 5.- Eliminar el id del campo de observ en el movimiento cancelado(pago)
    $pobserv  = $movpay->observ;              //obtenemos el valor del campo observ
    $pos = strpos($pobserv, '|C:');           //obtenemos la posicion de seccion de id
    $pobserv = substr ($pobserv, 0 , $pos);   //obtenemos las observaciones sin la seccion de id
    $mupdate = array('status'  => 'Generado', 'observ'   => $pobserv );// arma array de campos  

    $movpay = $this->inmumovtoRepository->update($mupdate, $movtoid); // ejecuta update

    // 6.- Restar el monto del movimiento cancelado(pago) del registro de inmucharge
    $cuanto       = $movpay->amount;
    $inmchargeid  = $movpay->inmucharg_id;
    
    // Actualiza Saldo y estatus        
    $chrfolio  = $this->inmuchargeRepository->gDecpay($inmchargeid,$cuanto); 
   
    // 7.- Eliminar el movimiento de cancelacion (can)
     $this->inmumovtoRepository->forceDelete($movcancelid);

    // 9.- Si es en ambiente de desarrollo establecer el auto increment

        return 'Se realizo roll back de cancelacion';

    }

 /**
     * Realiza actualizacion
     * desde ventana popup expededocta.editmovpop
     *
     * @param  $request
     *
     * @return Response
     */
    public function apliupdate(Request $request)
    {

  // "moddate" => "2019-04-30"
  // "modconcep" => "6"
  // "modmonto" => "3302.11"
  // "modconcepserv_id" => "0"
  // "modinmuch_id" => "377"
  // "modmovto_id" => "744"
  // "origmonto" => "3302.11"
  // "moddfrom" => "2018-04-01"
  // "moddto" => "2022-04-30"

      //dd($request->all());
    $req            = $request->all();
    $movtoid        = $req['modmovto_id'];      //id del movimiento 
    $chrid          = $req['modinmuch_id'];     //id de inmucharge
    $dfrom          = $req['moddfrom'];         //Filtro fecha desde
    $dto            = $req['moddto'];           //Filtro fecha hasta
    $conceptservid  = $req['modconcepserv_id']; //id del concepto/servicio
    $montoriginal   = $req['origmonto']*-1;        //monto original

    $moddate      = $req['moddate'];    //fecha 
    $modmonto     = $req['modmonto'];   //monto
    $unidmovtoid  = $req['modconcep'];  //unidmovto_id

        // Obtiene datos de catmovto         
        $movtos  = $this->unidadmovtoRepository->gcatmovto($unidmovtoid);        

        $catmovtocve    = $movtos[0]->cve;
        $catmovtodesc   = $movtos[0]->description;
        $unidid         = $movtos[0]->inmu_id;
        $catmovtipo     = $movtos[0]->tipo;

        // Obtiene id de unidad de medida = 'movimiento'
        $unidmed = $this->measurunitRepository->gunidmed('movimiento');
        $unidmedid = $unidmed->id;   
        // Obtiene el usuario que registra el pago
        $observ =  'user:'.auth()->user()->id.'-'.auth()->user()->name;
        //Formatea monto    
        $cuanto = number_format($modmonto, 2, '.', '');  

    //  generar el array para update
    $mupdate  = array(
    'unidmovto_id'  => $unidmovtoid ,
    'catmovto_cve'  => $catmovtocve,   
    'date'          => $moddate ,
    'folio'         => '0000000000000000000000000000',
    'quantity'      => 1,
    'measurunit_id' => $unidmedid,   
    'amount'        => $cuanto , 
    'balance'       => $cuanto ,
    'description'   => $catmovtodesc,
    'observ'        => $observ  
    );// arma array de campos  

    // 2.- Actualiza registro de movimiento 
    $movedit = $this->inmumovtoRepository->update($mupdate, $movtoid); // ejecuta update

    // 3.- resta mmonto original        
    $chrfolio  = $this->inmuchargeRepository->gDecpay($chrid,$montoriginal);

    // 5.- Actualiza momnto nuevo
    $chrfolio  = $this->inmuchargeRepository->gDecpay($chrid,$modmonto);

   
        //************************************ Genera Folio ********************
        //Arma fecha de movto
        $tfecha = Carbon::parse($moddate);
        $mfecha = $tfecha->month;
        $dfecha = $tfecha->day;
        $afecha = $tfecha->year;
        $afecha = substr($afecha,2,2);   
        //Quta punto a monto  
        $fcuanto= str_replace('.', '', $cuanto);

        // Arma Folio 28 caracteres
        // 3 inmuebleid     1-3
        // 6 fecha          4-9
        // 7 monto          10-16
        // 2 decmales       17-18
        // 4 movtocve       19-22
        // 5 movtoid        23-27
        // 1 1/2            28
        // 069 191010 000330200 1111 00001 2
        //   3      6         9    4     5 1    Tot: 28 
        //0691910100003302001111000012
        //123 456789 0123456 78 9012 34567 8
       
        // 3 inmuebleid
        $folio = str_pad($unidid, 3, "0", STR_PAD_LEFT);        
        // 6 fecha
        $folio = $folio.str_pad($afecha, 2, "0", STR_PAD_LEFT);
        $folio = $folio.str_pad($mfecha, 2, "0", STR_PAD_LEFT);
        $folio = $folio.str_pad($dfecha, 2, "0", STR_PAD_LEFT);
        // 9 monto 
        $folio = $folio.str_pad($fcuanto, 9, "0", STR_PAD_LEFT);        
        // 4 movtocve
        $folio = $folio.str_pad($catmovtocve, 4, "0", STR_PAD_LEFT);
        // 5 inmuchargeid o inmumovtoid
        $folio = $folio.str_pad($movedit->id, 5, "0", STR_PAD_LEFT);
        // 1  digito identifica si es cargo 1 o movto 2                
        $folio = $folio.'2';        
        //dd($folio);
        
        //************************************ Actualiza Folio ********************
        $inpmovto = array('folio' => $folio);          
        $inmvtoupd = $this->inmumovtoRepository->update($inpmovto, $movtoid);


      Flash::success('Se modificoel movimiento Id: '.$inmvtoupd->id);

     // Devolver a vista de consulta indexd 
    return redirect(route('edoscta.indexd',[$chrid,$dfrom,$dto,$conceptservid]));     
    }




}

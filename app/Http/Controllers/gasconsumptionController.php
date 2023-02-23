<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreategasconsumptionRequest;
use App\Http\Requests\UpdategasconsumptionRequest;
use App\Repositories\gasconsumptionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use \Carbon\Carbon;                                     // Para formateo de fechas
use App\Repositories\inmuebleRepository;                // Concultas a inmuebles
use App\Repositories\propertyparameterRepository;       // Consultas a paremetros
use App\Repositories\inmuchargeRepository;              // Charges
use App\Repositories\inmumovtoRepository;               // Movtos  
use App\Repositories\propertyareasRepository;           // Areas
use App\Repositories\providersRepository;               // Providers
use App\Repositories\unidadmovtoRepository;             // UnidadMovtos
use App\Repositories\measurunitRepository;              // Measureunits

use App\Repositories\personaRepository;                 // Personas
use App\Repositories\conceptservpropaccountRepository;  // Cuentas rel Concepto/serv
use App\Repositories\maillistRepository;                // Maillists

use App\Traits\GenFolio;                                // Genera folio
use App\Traits\SendMailEdoCta;                          // Envio de mail edocta

class gasconsumptionController extends AppBaseController
{
    /** @var  gasconsumptionRepository */
    private $gasconsumptionRepository;

    public function __construct(
        gasconsumptionRepository $gasconsumptionRepo,
        inmuebleRepository $inmuebleRepo,
        propertyparameterRepository $propertyparameterRepo,
        inmuchargeRepository $inmuchargeRepo,
        inmumovtoRepository $inmumovtoRepo,
        propertyareasRepository $propertyareasRepo,
        providersRepository $providersRepo,
        unidadmovtoRepository $unidadmovtoRepo,
        measurunitRepository $measurunitRepo,
        maillistRepository $maillistRepo,
        personaRepository $personaRepo,
        conceptservpropaccountRepository $conceptservpropaccountRepo

    )

    {
        $this->gasconsumptionRepository = $gasconsumptionRepo;
        $this->inmuebleRepository = $inmuebleRepo;
        $this->propertyparameterRepository = $propertyparameterRepo;
        $this->inmuchargeRepository = $inmuchargeRepo;
        $this->inmumovtoRepository = $inmumovtoRepo;
        $this->propertyareasRepository = $propertyareasRepo;
        $this->providersRepository = $providersRepo;
        $this->unidadmovtoRepository = $unidadmovtoRepo;
        $this->measurunitRepository = $measurunitRepo;
        $this->maillistRepository = $maillistRepo;
        $this->personaRepository = $personaRepo;
        $this->conceptservpropaccountRepository = $conceptservpropaccountRepo;
    }

use GenFolio;
use SendMailEdoCta;

public function showgas($condomid,$vmonth,$vyear)
{
    
    $condomid = Session('condominioexpid'); 
    // Obtener precio del gas
    $gasprice = $this->propertyparameterRepository->gValParam($condomid, 'gasprice') ;
    // Obtener fecha de actualizacion de precio del gas
    $dategasprice = $this->propertyparameterRepository->gValParam($condomid, 'fpricegas') ; 
    
    //Si el mes es menor a 1 o mayor a 12
    if ($vmonth < 1 || $vmonth > 12 ) {
       $vdate = carbon::now();
       $vmonth = $vdate->format('m');
   }    

      $meses = array(
         "1" => 'Enero',
         "2"  => 'Febrero',
         "3"   => 'Marzo',
         "4"  => 'Abril',
         "5"  => 'Mayo',
         "6"  => 'Junio',
         "7"  => 'Julio',
         "8"  => 'Agosto',
         "9"  => 'Septiembre',
         "10"  => 'Octubre',
         "11"  => 'Noviembre',
         "12"  => 'Diciembre',
     );  

    //Si el mes es menor a 1 o mayor a 12
    if ($vyear < 2000 || $vyear > 2030  || $vyear <=0 ) {
       $vdate = carbon::now();
       $vyear = $vdate->format('Y');
    }  
   

      $iniyear = 2000;
      $finyear = 2030;
      $años = array();

      for ($i=$iniyear; $i < $finyear; $i++) { 
          //array_push($años,$i);
           $años[$i] = $i;
      }  
  
   
   // Obtiene las lecturas
   $gasconsums = $this->gasconsumptionRepository->getgasconsum($condomid,$vmonth,$vyear);
   //dd($gasconsums);

   return view('gasconsumptions.indexc')
        ->with('gasconsums', $gasconsums)
        ->with('meses', $meses)
        ->with('años',$años)
        ->with('vmonth',$vmonth)
         ->with('vyear',$vyear)
            ;
}

public function gmonth(Request $request)
{
   $condomid = Session('condominioexpid'); 
   $vmonth = $request->gmonth ;
   $vyear =  $request->gyear ;          
   return redirect(route('gasconsum.showgas',[$condomid,$vmonth,$vyear]));
}

   /**
     * Show the form for creating a new gasconsumption.
     *
     * @return Response
     */
    public function gcreate($unidid)
    {
        $condomid = Session('condominioexpid'); 
        $vdate = carbon::now();
        //obtener nombre de inmueble        
        $inmueble = $this->inmuebleRepository->findWithoutFail($unidid);
        $unidname =  $inmueble->ident.' - '.$inmueble->descripcion ;
        // obtener ultima lectura
        $lectant = $this->gasconsumptionRepository->glastlect($unidid);                 
        // Obtener precio del gas
        $gasprice = $this->propertyparameterRepository->gValParam($condomid, 'gasprice') ;
        // Obtener fecha de actualizacion de precio del gas
        $dategasprice = $this->propertyparameterRepository->gValParam($condomid, 'fpricegas') ; 
                
        return view('gasconsumptions.gcreate')
        ->with('unidid',$unidid)
        ->with('vdate',$vdate)
        ->with('unidname',$unidname)
        ->with('lectant',$lectant)
        ->with('gasprice',$gasprice)
        ->with('dategasprice',$dategasprice)
        ;
    }

  /**
     * Store a newly created gasconsumption in storage.
     *
     * @param CreategasconsumptionRequest $request
     *
     * @return Response
     */
    public function gstore(CreategasconsumptionRequest $request)
    {
        $timini = carbon::now();

        $input = $request->all();               //obtiene datos de vista
        
        $condomid = Session('condominioexpid'); //obiene id de condominio
            // "_token" => "A2iMPKgUGem4hSVMvmdfN9bHGjUUXyVCvO8VSnyR"
            // "current_reading" => "10"
            // "quantity" => "10"
            // "amount" => "192"
            // "application_date" => "2019-11-01 22:25:55"
            // "inmueble_id" => "70"
            // "reading_date" => "2019-11-01 22:25:55"
            // "last_reading" => "0"
            // "gas_price" => "19.20"
        
         
        $conceptservid = 3; //conceptserv_id int - 3 1140 ConsumoGas Consumo de GAS  
        //$conceptservcve = '1140'; //

        //Inserta Consumo de gas
        $gasconsumption = $this->gasconsumptionRepository->create($input);
        $gasconsumid = $gasconsumption->id; //obtiene id de registro 
        
        //Obtiene el id de Area de administración
        $charea = $this->propertyareasRepository->gareabyname($condomid,'Admin');
        
        //########## Arma y genera cargo de gas  y movimiento   ###########
        //Obtiene fecha actual
        $vcdate = carbon::now();
        $chvdate = $vcdate->format('Y-m-d'); //Formatea fecha 2019-10-05
        //Obtiene el id de proveedor
        $chprovider = $this->providersRepository->gprovbyname('ADP');        
        //Genera descripcion para concepto con lecturas y cantidad
        $chdesc =  'Lectura de Gas |Id: '. $gasconsumid.'| Anterior: '.
                number_format($input['last_reading'], 4, '.', '').'| Actual: '.
                number_format($input['current_reading'], 4, '.', '').'| Consumo: '.
                number_format($input['quantity'], 2, '.', '').'| Precio Gas: '.
                number_format($input['gas_price'], 2, '.', '');
        //Genera campo observaciones
        $chobserv = 'Generado por lectura de gas id: '.$gasconsumid;
        //auth()->user()->id.'-'.auth()->user()->name;         
        
        //Crea variables de unidadid, cantidad, monto, y precio de gas
        $inmuid     = $input['inmueble_id'];
        $quantity   = $input['quantity'];
        $amount     = $input['amount'];
        $gasprice   = $input['gas_price'];

        //Arma Cargo - Array para insert 
        $chinput = array(  
            'inmu_id'           => $inmuid,  // inmu_id int
            'conceptserv_id'    => $conceptservid, // int - 3 1140 ConsumoGas Consumo de GAS  
            'proparea_id'       => $charea->id,         // proparea_id int
            'provider_id'       => $chprovider->id,   // provider_id int
            'date'              => $chvdate,          // date    date
            'folio'             => '0000000000000000000000000000', // folio   varchar
            'stotal'            => $amount,// stotal  decimal
            'iva'               => 0,               // iva decimal
            'balance'           => $amount,// balance decimal
            'status'            => 'Generado',      // status  varchar     
            'description'       => $chdesc,         // description varchar 
            'observ'            => $chobserv,       // observ  varchar
            'filelink'          => 'N/A'            // filelink    varchar
        );   
            //dd($chinput);
            // array:13 [▼
            // "inmu_id" => "71"
            // "conceptserv_id" => "3"
            // "proparea_id" => 2
            // "provider_id" => 27
            // "date" => "2019-11-04"
            // "folio" => "0000000000000000000000000000"
            // "stotal" => "10"
            // "iva" => 0
            // "balance" => "10"
            // "status" => "Generado"
            // "description" => "Consumo de Gas 1700.0000|12|10"
            // "observ" => "Registrado por: 1-Julio buendia"
            // "filelink" => "N/A"
            // ]
        //Inserta cargo
        $inmucharge = $this->inmuchargeRepository->create($chinput);
        $chid = $inmucharge->id ; //obtiene el id del registro

        //Actualiza consumo de gas con id de inmucharge
        $inpchid = array('inmucharge_id' => $chid);          
        $gasconsumupd = $this->gasconsumptionRepository->update($inpchid,$gasconsumid);    
        
        //obtiene la clave del cargo para el folio
        $cargo = $this->inmuchargeRepository->gconceptocve($chid);
        $chcve = $cargo->chrcve;
        $chdesc =  $cargo->chrdesc;
        // ************** Genera el folio *********************
        $chfolio = $this->gfolio($inmuid, $chvdate,$amount,$chcve,$chid,1);
        // Actualiza el folio de cargo
        $inchf = array('folio' => $chfolio);          
        $icharupd = $this->inmuchargeRepository->update($inchf,$chid);        

        //Obtiene id de (contrato) Unidadmovto para Consumo de gas
        $unidadmovto = $this->unidadmovtoRepository->gunidmovbyname($inmuid,'ConsumoGas');
        $unidmovid   =  $unidadmovto->id ;
        $unidmovcve  =  $unidadmovto->cve ;
        $unidmovdesc =  $unidadmovto->description;
        //dd($unidadmovto);
            // "id" => 105
            // "inmu_id" => 71
            // "cve" => 1141
            // "shortname" => "ConsumoGas"
        //obtiene id de unidad de medida
        $measureunit = $this->measurunitRepository->gunidmed('litro');
        $measunitid = $measureunit->id;
        //################# Arma inmuMovto - Array para insert ###################
        //########################################################################
        $movinput = array(  
            'inmucharg_id'  => $chid,        // inmucharg_id     int 10
            'unidmovto_id'  => $unidmovid,   // unidmovto_id     int 10
            'catmovto_cve'  => $unidmovcve,  // catmovto_cve     smallint6
            'date'          => $chvdate,     // date             date  0
            'folio'         => '0000000000000000000000000000',// folio varchar 35
            'quantity'      => $quantity,    // quantity         decimal 19
            'measurunit_id' => $measunitid,   // measurunit_id    int 10
            'amount'        => $gasprice,     // amount           decimal 19
            'balance'       => $amount,       // balance          decimal 19
            'status'        => 'Generado',    // status           varchar 15
            'apmode'        => 'Automatica',   // apmode           varchar 35
            'description'   => $unidmovdesc,  // description      varchar 150
            'observ'        => 'Generado por lectura de Gas id: '.$gasconsumid, // observ  varchar 250
            'filelink'      => 'N/A'          // filelink         varchar 250
        );   
        
        //Inserta movimiento
        $inmumovto = $this->inmumovtoRepository->create($movinput);
        $imovid = $inmumovto->id; //otiene el id del registro
        //Genera folio para movimiento
        $movfolio = $this->gfolio($inmuid, $chvdate,$amount,$unidmovcve,$imovid,2);
        //dd($movfolio);
        //Actualiza folio de movto
        $inmovf = array('folio' => $movfolio);          
        $imovupd = $this->inmumovtoRepository->update($inmovf,$imovid);

        //############## Arma datmail para envio de correo ###############################
        //Crea el objeto o clase que se usara para la informacion y envio de correo    
         $mailhead = new \stdClass();
         $mailhead->tfrom = env('MAIL_ERFROM', 'julio.buendia@infocret.com');  // email remitente
         $mailhead->tname = env('MAIL_ENAME', 'Adprocon');  // Nombre remitente
         $mailhead->tto   = env('MAIL_ETO', 'julio.buendia@infocret.com');  // email destinatario
         $mailhead->tsub  = env('MAIL_ESUB', 'Recibo de pago');  // asunto
         $mailhead->tmsg  = env('MAIL_EMSG', 'Recibo de pago');  // mensage

        // // Obtiene nom condominio            
        // $condomi = $this->inmuchargeRepository->gChCondomiName($inmuid);
        // $ncondomi =  $condomi[0]->ident." ".$condomi[0]->descripcion;   // arma nombre 
        // //Arma nombre y ruta de archivo PDF
        // $filename =  $chfolio.'.pdf';
        // $filepath =  'movscond1/';        

        // //Obtiene datos de la unidade        
        // $unidad = $this->inmuebleRepository->findWithoutFail($inmuid);
        // $unidname =  $unidad->ident.' - '.$unidad->descripcion ;  
        // //Obtiene nombre del propietario
        // $personas = $this->personaRepository->gpropietario($inmuid);   
        // $propietario = $personas[0];     
        // $npropietario = $propietario->name." ".$propietario->appat.
        // " ".$propietario->apmat;  
        // //Obtiene datos de la cuenta relacionada a un concepto / servicio
        // $arr_propaccount = 
        // $this->conceptservpropaccountRepository->gCtaConcept($chcve);
        // $propaccount = $arr_propaccount[0];   


    
        //**********   Genera EdoCta y envia correo  ********** 
        $res = $this->sendmailbychargeid($icharupd->id,$mailhead);
     
        $timfin = carbon::now();
        //->toTimeString()
        $segundos = $timini->diffInSeconds($timfin);
        
        Flash::success('Lectura de gas guardada, cargo aplicado, email enviado.'
            .'('.$segundos.' segundos)');

        //return redirect(route('edoscta.indexc',$chid));
        return redirect(route('gasconsum.showgas',[$condomid,0,0]));
    }



    /**
     * Display a listing of the gasconsumption.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->gasconsumptionRepository->pushCriteria(new RequestCriteria($request));
        $gasconsumptions = $this->gasconsumptionRepository->all();

        return view('gasconsumptions.index')
            ->with('gasconsumptions', $gasconsumptions);
    }

    /**
     * Show the form for creating a new gasconsumption.
     *
     * @return Response
     */
    public function create()
    {
        return view('gasconsumptions.create');
    }

    /**
     * Store a newly created gasconsumption in storage.
     *
     * @param CreategasconsumptionRequest $request
     *
     * @return Response
     */
    public function store(CreategasconsumptionRequest $request)
    {
        $input = $request->all();

        $gasconsumption = $this->gasconsumptionRepository->create($input);

        Flash::success('Gasconsumption saved successfully.');

        return redirect(route('gasconsumptions.index'));
    }

    /**
     * Display the specified gasconsumption.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gasconsumption = $this->gasconsumptionRepository->findWithoutFail($id);

        if (empty($gasconsumption)) {
            Flash::error('Gasconsumption not found');

            return redirect(route('gasconsumptions.index'));
        }

        return view('gasconsumptions.show')->with('gasconsumption', $gasconsumption);
    }

    /**
     * Show the form for editing the specified gasconsumption.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gasconsumption = $this->gasconsumptionRepository->findWithoutFail($id);

        if (empty($gasconsumption)) {
            Flash::error('Gasconsumption not found');

            return redirect(route('gasconsumptions.index'));
        }

        return view('gasconsumptions.edit')->with('gasconsumption', $gasconsumption);
    }

    /**
     * Update the specified gasconsumption in storage.
     *
     * @param  int              $id
     * @param UpdategasconsumptionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategasconsumptionRequest $request)
    {
        $gasconsumption = $this->gasconsumptionRepository->findWithoutFail($id);

        if (empty($gasconsumption)) {
            Flash::error('Gasconsumption not found');

            return redirect(route('gasconsumptions.index'));
        }

        $gasconsumption = $this->gasconsumptionRepository->update($request->all(), $id);

        Flash::success('Gasconsumption updated successfully.');

        return redirect(route('gasconsumptions.index'));
    }

    /**
     * Remove the specified gasconsumption from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gasconsumption = $this->gasconsumptionRepository->findWithoutFail($id);

        if (empty($gasconsumption)) {
            Flash::error('Gasconsumption not found');

            return redirect(route('gasconsumptions.index'));
        }

        $this->gasconsumptionRepository->delete($id);

        Flash::success('Gasconsumption deleted successfully.');

        return redirect(route('gasconsumptions.index'));
    }
}

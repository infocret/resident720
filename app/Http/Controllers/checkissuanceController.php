<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecheckissuanceRequest;
use App\Http\Requests\UpdatecheckissuanceRequest;
use App\Repositories\checkissuanceRepository;

// se agregaron para listas desplegables
use App\Repositories\checkbooktrackingRepository;
use App\Repositories\propaccountRepository;
//use App\Repositories\bankRepository;
//use App\Repositories\bankaccountRepository;
//use App\Repositories\checkbookRepository;
use App\Repositories\inmuchargeRepository;
use App\Repositories\inmumovtoRepository;   //agregado para edo cta prueba y reg de pago
use App\Repositories\providersRepository;   //para captura de datos del cheque 
use App\Repositories\unidadmovtoRepository; //agregado para el insert de pago
use App\Repositories\measurunitRepository;  //agregado para el insert de pago

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Carbon\Carbon;
use App\Traits\NumToLeters;     // Numeros a letras
use App\Traits\PdfPrintCheque;  // Gen PDF para imprimir cheque
use App\Traits\GenFolio;        // Genera folio
use Illuminate\Support\Facades\Storage;     // para subir archivos

class checkissuanceController extends AppBaseController
{
    /** @var  checkissuanceRepository */
    private $checkissuanceRepository;

    public function __construct(
        checkissuanceRepository $checkissuanceRepo,           
        checkbooktrackingRepository $checkbooktrackingRepo,
        propaccountRepository $propaccountRepo,
        //bankRepository $bankRepo,
        //bankaccountRepository $bankaccountRepo,
        //checkbookRepository $checkbookRepo,
        inmuchargeRepository $inmuchargeRepo,
        inmumovtoRepository $inmumovtoRepo,     
        providersRepository $providersRepo,
        unidadmovtoRepository $unidadmovtoRepo,
        measurunitRepository $measurunitRepo
    )
    {
        $this->checkissuanceRepository = $checkissuanceRepo;
        $this->checkbooktrackingRepository = $checkbooktrackingRepo;
        $this->propaccountRepository = $propaccountRepo;
        //$this->bankRepository = $bankRepo;
        //$this->bankaccountRepository = $bankaccountRepo;
        //$this->checkbookRepository = $checkbookRepo;
        $this->inmuchargeRepository = $inmuchargeRepo;
        $this->inmumovtoRepository = $inmumovtoRepo;
        $this->providersRepository = $providersRepo;
        $this->unidadmovtoRepository = $unidadmovtoRepo;
        $this->measurunitRepository = $measurunitRepo;
    }

use NumToLeters;
use PdfPrintCheque;
use GenFolio;
//*************************************************************************************

//*************************************************************************************
    /**
     * Display a listing of the checkissuance.
     *
     * @param Request $request
     * @return Response
     */
    public function Emit(Request $request,$inmuchargeid)
    {
        
        //$fecha = carbon::now()->toDateString();

        //$bancos = $this->bankRepository->gBancos();  
        $inmucharge = $this->inmuchargeRepository->findWithoutFail($inmuchargeid);           
        $providers = $this->providersRepository->findWithoutFail($inmucharge->provider_id);
        $chequeras = $this->propaccountRepository->gcheckbooks($inmucharge->inmu_id);
        //dd($fecha);

     return view('checkissuances.emit')      
      ->with('inmucharge', $inmucharge)
      ->with('providers', $providers)
      ->with('chequeras',$chequeras)
      //->with('bancos',$bancos)
      //->with('fecha',$fecha)
      ;
        
    }



    /**
     * Display a listing of the checkissuance.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->checkissuanceRepository->pushCriteria(new RequestCriteria($request));
        $checkissuances = $this->checkissuanceRepository->gapchecks();
        //dd($checkissuances);

        return view('checkissuances.index')
            ->with('checkissuances', $checkissuances);
        
        // $cant = 852.50;
        // $cantlet = $this->numerosALetras($cant);        
        // dd($cantlet);        
       // return view('checkissuances.testprint');
    }

    /**
     * Show the form for creating a new checkissuance.
     *
     * @return Response
     */
    public function create()
    {
        return view('checkissuances.create');
    }

    /**
     * Store a newly created checkissuance in storage.
     *
     * @param CreatecheckissuanceRequest $request
     *
     * @return Response
     */
    public function store(CreatecheckissuanceRequest $request)
    {
        $input = $request->all();
        $checkissuance = $this->checkissuanceRepository->create($input);
        //dd($checkissuance);
            $sobserb =   $checkissuance->inmucharge_id
                    ."|".$checkissuance->amounttext
                    ."|".$checkissuance->propaccount_id
                    ."|".$checkissuance->checkbook_id
                    ."|".$checkissuance->checknum
                    ."|".$checkissuance->cancelchargeid;
        //Array para insert de checkbooktracking
        $intrack = array( 
        'checkissuance_id' => $checkissuance->id,
        'user_id' => auth()->user()->id,
        'datereg' => $checkissuance->created_at,
        'status' => $checkissuance->status,
        'observ' => $sobserb        
        );          
        //************************************ Inserta rastreo **************
        $checkbooktrack = $this->checkbooktrackingRepository->create($intrack);

        Flash::success('Checkissuance saved successfully.');

        return redirect(route('checkissuances.index'));
    }

    /**
     * Display the specified checkissuance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        //$checkissuance = $this->checkissuanceRepository->findWithoutFail($id);
        $checkissuances = $this->checkissuanceRepository->gapcheck($id);
        $checkissuance = $checkissuances[0];
        $charges = $this->inmuchargeRepository->gMovtoCH($checkissuance->egreso_id);
        $charge = $charges[0];

        if (empty($checkissuance)) {
            Flash::error('Checkissuance not found');

            return redirect(route('checkissuances.index'));
        }

        return view('checkissuances.show')
        ->with('checkissuance', $checkissuance)
        ->with('charge', $charge)
        ;
    }

    /**
     * Show the form for editing the specified checkissuance.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
    //$checkissuance = $this->checkissuanceRepository->findWithoutFail($id);
    //Datos de aplicacion de cheques
    $checkissuances = $this->checkissuanceRepository->gapcheck($id);
    $checkissuance = $checkissuances[0];          
    //Datos de Cargo
    $inmucharge = $this->inmuchargeRepository->findWithoutFail($checkissuance->egreso_id);    
    //Datos de proveedor
    $providers = $this->providersRepository->findWithoutFail($inmucharge->provider_id);    
    //Lista de chequeras     
    $chequeraid = $checkissuance->checkbook_id ; //Id de chequera
    $chequeras = $this->propaccountRepository->gcheckbooks($inmucharge->inmu_id);

    //Lista de estados
    $statuslist = array(
        'Registrado' => 'Registrado',
        'Autorizado' => 'Autorizado',
        'Impreso' => 'Impreso',
        'Cancelado' => 'Cancelado',
        );
    

        if (empty($checkissuance)) {
            Flash::error('Checkissuance not found');

            return redirect(route('checkissuances.index'));
        }

        return view('checkissuances.edit')
        ->with('checkissuance', $checkissuance)
        ->with('inmucharge', $inmucharge)
        ->with('providers', $providers)
        ->with('chequeras',$chequeras)
        ->with('chequeraid',$chequeraid)
        ->with('statuslist',$statuslist)
        ;
    }

    /**
     * Update the specified checkissuance in storage.
     *
     * @param  int              $id
     * @param UpdatecheckissuanceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecheckissuanceRequest $request)
    {
        //*************************** Identifica si existe el registro **************
        $checkissuance = $this->checkissuanceRepository->findWithoutFail($id);
        if (empty($checkissuance)) {
            Flash::error('Checkissuance not found');
            return redirect(route('checkissuances.index'));
        }
        //*************************** Actualiza el registro **************************
        $checkissuance = $this->checkissuanceRepository->update($request->all(), $id);
        //*************************** Inserta checkbooktracking  **********************
        // genera cadena para campo observaciones de checkbooktracking
        $sobserb =  $checkissuance->inmucharge_id
                    ."|".$checkissuance->id
                    ."|".$checkissuance->propaccount_id
                    ."|".$checkissuance->checkbook_id
                    ."|".$checkissuance->checknum
                    ."|".$checkissuance->cancelchargeid;
        //Array para insert de checkbooktracking
        $intrack = array( 
        'checkissuance_id' => $checkissuance->id,
        'user_id' => auth()->user()->id,
        'datereg' => $checkissuance->created_at,
        'status' => $checkissuance->status,
        'observ' => $sobserb        
        );          
        //****************** Inserta rastreo **************************************
        //$checkbooktrack = $this->checkbooktrackingRepository->create($intrack);

        //*********** Valida si insertar movto de pago ****************************
        $chstatus = $checkissuance->status;
        //dd($chstatus);
        if ($chstatus == 'Impreso'){ // Si se imprime registra inmumovto de pago 
          $chargid =  $checkissuance->inmucharge_id;
          $chamount = floatval($checkissuance->amounttext);
          $fechreg = now()->toDateString();    

          // Obtenemos la cve del mov de cargo
          $movtocve = $this->unidadmovtoRepository->gcatmovcvebychargeid($chargid);              
          // Le agregamos un 2 a cve pues los movs de pago tienen ese 2 al inicio
          $movtocvep = '2'.$movtocve->cve;
          // obtenemos el id de la relaacio del mov de pago
          $unimov = $this->unidadmovtoRepository->gunidmovbycatmovcve($movtocvep);          
          //dd($unimov->id.'-'.$unimov->observ.'-'.$unimov->inmu_id);
          $unidmovid = $unimov->id;
          $unidmovobserv = $unimov->observ;
          $inmuid = $unimov->inmu_id;      
          // Obtiene id de unidad de medida = 'pago'
          $unidmed = $this->measurunitRepository->gunidmed('pago');
          $unidmedid = $unidmed->id; 
          // Obtiene el usuario que registra el pago
          $observ = 'user:'.auth()->user()->id.'-'.auth()->user()->name;
          //Formatea monto    
          $cuanto = number_format($chamount, 2, '.', '');    
          //Array para insert de inmumovto
          $input = array(  
            'inmucharg_id'  => $chargid,
            'unidmovto_id'  => $unidmovid,            
            'catmovto_cve'  => $movtocvep,
            'date'          => $fechreg,
            'folio'         => '0000000000000000000000000000',
            'quantity'      => 1,
            'measurunit_id' => $unidmedid,
            'amount'        => $cuanto,
            'balance'       => $cuanto,
            'status'        => 'Generado',
            'apmode'        => 'Imp.Cheque',
            'description'   => $unidmovobserv,
            'observ'        => $sobserb,            
            'filelink'      => 'N/A' //checar esto
          );     
          //************************************ Inserta Movimiento **************
          $inmumovto = $this->inmumovtoRepository->create($input);
          //************************************ Genera Folio ********************
          $folio = $this->gfolio($inmuid,$fechreg,$cuanto,$movtocvep,$inmumovto->id,'2');
          //************************************ Actualiza Folio ********************
          $inpmovto = array('folio' => $folio);          
          $inmvtoupd = $this->inmumovtoRepository->update($inpmovto, $inmumovto->id);
          // Actualiza Saldo y estatus de inmucharge      
          $chrfolio  = $this->inmuchargeRepository->gDecpay($checkissuance->inmucharge_id,$cuanto); 
          //Elimina PDF de estado de cuenta pues 
          //al actualizar saldos y registrar pago ya no es valido          
          $filename =  $chrfolio.'.pdf';
          $filepath =  'movscond1/';
          $exists = Storage::disk('pdftemp')->exists($filename);   
          if ($exists){ // Si existe                    
            Storage::disk('pdftemp')->delete($filename);  
          }
        
          //**********   Genera EdoCta y envia correo  **********        
          //$result = $this->sendmailbychargeid($inmchargeid, null);
          //*****************************************************
          //
        } //Fin de si el estatus es impreso
        
        // Si se cancela registra inmumovto de cargo
        
//*********************************************************************************

        Flash::success('Checkissuance updated successfully.');

        return redirect(route('checkissuances.index'));
    }

//***********************************************************************************


//***********************************************************************************




    /**
     * Remove the specified checkissuance from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $checkissuance = $this->checkissuanceRepository->findWithoutFail($id);

        if (empty($checkissuance)) {
            Flash::error('Checkissuance not found');

            return redirect(route('checkissuances.index'));
        }

        $this->checkissuanceRepository->delete($id);

        Flash::success('Checkissuance deleted successfully.');

        return redirect(route('checkissuances.index'));
    }

    public function chprint($id)
    {
      //consulta datos de aplicación de cheque    
      $checkissuance = $this->checkissuanceRepository->findWithoutFail($id);
      //Crea PDF en trait
      $pdfile = $this->PrintCheque( $checkissuance) ;  
      // Mostrar PDF existente en explorador      
      return Redirect(url($pdfile->pathfile));        
    } 





}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\inmuchargeRepository;  //Nueva aplicacion de cargos 2019
use App\Repositories\inmumovtoRepository;   //Nueva aplicacion de cargos 2019
use App\Repositories\personaRepository;
use App\Repositories\conceptservpropaccountRepository; // Cuentas rel Concepto/serv
use App\Repositories\propertyparameterRepository;
use App\Repositories\maillistRepository;             // mailists

use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;    // para subir archivos
// use \Milon\Barcode\DNS1D;              // Para generar codigo de barras
// use \Milon\Barcode\DNS2D;              // Para generar codigo de barras
// use \Carbon\Carbon;                    // Para formateo de fechas
// use Barryvdh\DomPDF\Facade as PDF;     // Para generar PDF
// use Illuminate\Support\Facades\Mail;   // Fachada Mail
//use App\Mail\EmailReceipPaySend;       // clase para enviar correo

use App\Traits\SendMailPayReceip;      // Gen PDF y Envio de mail recibo de pago

class condomcpagosController extends AppBaseController
{
    /** @var  movtoheadRepository */
    private $movtoheadRepository;

    public function __construct(
        inmuchargeRepository $inmuchargeRepo,
        inmumovtoRepository $inmumovtoRepo,
        // movtoheadRepository $movtoheadRepo,
        // movtodetailRepository $movtodetailRepo,
        personaRepository $personaRepo,
        //propaccountRepository $propaccountRepo,
        conceptservpropaccountRepository $conceptservpropaccountRepo,
        propertyparameterRepository $propertyparameterRepo
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
    }
//============================================================================
use SendMailPayReceip;
//============================================================================

    /**
     * Muestra recibo de pago
     *
     * @param   inmueble_id = Unidad
     * @return  Response
     */
    public function receip($chrid,$movid)
    {
        $condomid = Session('condominioexpid');      
        $charges = $this->inmuchargeRepository->gMovtoCH($chrid);        
        if ($charges->isEmpty()) {
           Flash::error('Movimiento no localizado.');
           return redirect(route('edoscta.selperiod',[$condomid]));
        }
        $charge = $charges[0];
        
        $movto  = $this->inmumovtoRepository->findWithoutFail($movid);

        $personas = $this->personaRepository->gpropietario($charge->unidid); 
        $propietario = $personas[0];

        // Obtiene nom condominio        
        $condomi = $this->inmuchargeRepository->gChCondomiName($charge->unidid);
        $ncondomi =  $condomi[0]->ident." ".$condomi[0]->descripcion;// arma nombre condominio  

        $filename =  $charge->folio.'.pdf';
        $filepath =  'movscond1/';
        $exists = Storage::disk('pdftemp')->exists($filename);  

       return view('expedpay.showreceip')            
            ->with('charge',$charge)
            ->with('movto',$movto)
            ->with('propietario',$propietario)            
            ->with('ncondomi',$ncondomi) 
            ->with('exists',$exists) 
            ->with('filepath',$filepath) 
            ->with('filename',$filename) 
            ;
    }


    /**
     * Exporta recibo de pago a un archivo PDF
     * Mostrarlo o descargarlo
     * @param  int $chrid  inmucharges.id
     * @param  int $movid  inmumovtos.id
     * @return Response
     */
    public function showpdf($chrid,$movid,$action)
    {
      //Crea PDF en trait
      $pdfile = $this->pdfpayreceipids($chrid,$movid) ;      
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
//***************************************************************************************
    public function mailpdf($chrid,$movtoid)   {
        
    $mailhead = $this->creamailhead();

    return view('expedpay.emailsend')
    ->with('chrid',$chrid)
    ->with('movtoid',$movtoid)
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

        $chrid  = $request->thid;   // recupera id de cabecera de movimiento
        $movid  = $request->tmid;   // recupera id de movimiento
        //*****************   Envia Mail   ******************************
        $result = $this->sendmailbychargeid($chrid,$movid,$mailhead);

        Flash::success('Correo enviado.');                  // menaje Flash

        return redirect(route('cpay.receip',[$chrid,$movid]));  
        
        }

}

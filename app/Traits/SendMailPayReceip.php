<?php 
namespace App\Traits;
// use App\Repositories\inmuchargeRepository;      //Nueva aplicacion de cargos 2019
// use App\Repositories\inmumovtoRepository;       //Nueva aplicacion de cargos 2019
// use App\Repositories\inmuebleRepository;        //Inmuebles
// use App\Repositories\personaRepository;         //Personas
// use App\Repositories\conceptservpropaccountRepository;//Cuentas rel Concepto/serv
// use App\Repositories\propertyparameterRepository;    //propertyparameters
// use App\Repositories\maillistRepository;             // mailists
// use \Carbon\Carbon;                                  // Para formateo de fechas
// 
// public function __construct(
//         inmumovtoRepository $inmumovtoRepo,
//         inmuchargeRepository $inmuchargeRepo,
//         unidadmovtoRepository $unidadmovtoRepo,
//         personaRepository $personaRepo,
//         conceptservpropaccountRepository $conceptservpropaccountRepo,
//         measurunitRepository $measurunitRepo
//     )
//     {
//         $this->inmumovtoRepository = $inmumovtoRepo;
//         $this->inmuchargeRepository = $inmuchargeRepo;
//         $this->unidadmovtoRepository = $unidadmovtoRepo; 
//         $this->personaRepository = $personaRepo; 
//         $this->conceptservpropaccountRepository = $conceptservpropaccountRepo; 
//         $this->measurunitRepository = $measurunitRepo;    
//     }
//     
//     
 
use Illuminate\Support\Facades\Storage;// para subir archivos
use \Milon\Barcode\DNS1D;              // Para generar codigo de barras
use \Milon\Barcode\DNS2D;              // Para generar codigo de barras
use Barryvdh\DomPDF\Facade as PDF;     // Para generar PDF
use Illuminate\Support\Facades\Mail;   // Fachada Mail
use App\Mail\EmailReceipPaySend;       // clase para enviar correo de recibo depago


// Para generar PDF de Recibo de Pago y enviar mail
trait SendMailPayReceip
{

//################################# MAIL ###########################################
//******************** Envia correo a partir de ids  ***************************
public function sendmailbychargeid($chrid,$movid,$mailhead) 
{
    //Obtiene registro de Cargo       
    $charges = $this->inmuchargeRepository->gMovtoCH($chrid);
    $charge = $charges[0];        
    //obtiene movimiento
    $movto  = $this->inmumovtoRepository->findWithoutFail($movid);       
    //obtiene propietario
    $personas = $this->personaRepository->gpropietario($charge->unidid);        
    $propietario = $personas[0];    
    //$npropietario = $propietario->name." ".$propietario->appat." ".$propietario->apmat;
    //obtiene nom condominio        
    $condomi = $this->inmuchargeRepository->gChCondomiName($charge->unidid);
    $ncondomi =  $condomi[0]->ident." ".$condomi[0]->descripcion;// arma nombre

    $res = $this->sendmailrecipobj($charge,$movto,$mailhead,$ncondomi,$propietario);
   
    return $res;
}

//******************** Envia correo a partir de Objetos  ***************************
public function sendmailrecipobj($charge,$movto,$mailhead,$ncondomi,$propietario)
{
    //Valida mailhead
    if (is_null($mailhead)){
        $mailhead = $this->creamailhead();
    }    
    //Generar PDF                                    
    $fpdf = $this->
    pdfpayreceipobj($charge,$movto,$ncondomi,$propietario, null);
    //********************************************************************
    // Crea el objeto o clase que se usara para la informacion y envio de correo 
    $datmail = $this->armaclasedatmail(
    $charge,$mailhead,$ncondomi,$propietario,$fpdf);
    //************************* Envia correo *****************************
    Mail::to($datmail->sto)     
        //->cc('julio_buendia@yahoo.com.mx')
        //->bcc('OtrocorreoQcorreo.com')
        ->send(new EmailReceipPaySend($datmail,$movto)); 

    return 'ok';
}

//#######################  Arma la clase datmail  ##################################
public function armaclasedatmail($charge,$mailhead,$ncondomi,$propietario,$fpdf)
{
     //Armae nombre de propietario
    $npropietario = $propietario->name." ".$propietario->appat." ".$propietario->apmat;
     //Crea el objeto o clase que se usara para la informacion y envio de correo 
    $datmail = new \stdClass();
        $datmail->sfrom = $mailhead->tfrom;                 // email remitente
        $datmail->sname = $mailhead->tname;                 // Nombre remitente
        $datmail->sto   = $mailhead->tto;                   // email destinatario
        $datmail->subj  = $mailhead->tsub;                  // asunto
        $datmail->smsg  = $mailhead->tmsg;                  // mensage  

        $datmail->ncondomi  = $ncondomi;                    // condominio
        $datmail->satach    = $fpdf->pathfile;              // archivo a anexar
        $datmail->sfilename = $fpdf->filename;              // nombre archivo a anexar
        $datmail->smimetype ='application/pdf';             // Mime type de archivo

        $datmail->uid    =  $charge->unidid;                // unidad id
        $datmail->ucve   =  $charge->unidcve;               // unidad cve
        $datmail->uname  =  $charge->unidname;              // unidad name
        $datmail->udesc  =  $charge->uniddesc;              // unidad descripcion

        $datmail->hid    =  $charge->chrid;                 // cabecera id            
        $datmail->ccve   =  $charge->chrcve;                // cab cve de concepto
        $datmail->cname  =  $charge->cdesc;                 // cab nombre de concepto
        $datmail->ffact  =  $charge->chrdate;               // cab fecha aplicacion
        $datmail->folio  =  $charge->chrfolio;              // cab folio
        $datmail->area   =  $charge->area;                  // cab area
        $datmail->nomcorto     =  $charge->providnom;       // cab nombre proveedor
        $datmail->razonsocial  =  $charge->rovidrazsoc;     // cab razon social      
        $datmail->rfcmoral     =  $charge->providrfc;       // cab rfc            
        $datmail->stotal       =  $charge->chrtotal;        // cab subtotal
        $datmail->iva       =  $charge->chriva;             // cab iva
        $datmail->balance   =  $charge->chrbalance;         // cab gran total
        $datmail->status    =  $charge->chrstatus;          // cab estatus
        $datmail->filelink  =  $charge->chrflink;           // cab link de cocument

        $datmail->npropietario = $npropietario;             // Nombre de propietario
        $datmail->titprop = $propietario->nombre;           // Titulo de propietario
        //$datmail->bname = $propaccount->bname;              // Banco
        //$datmail->bcta = $propaccount->bcta;                // Numero de cuenta
        //$datmail->bclabe = $propaccount->bclabe;            // CLABE
        //$datmail->bconv = $propaccount->bconv;              // convenio
        //$datmail->bref = $propaccount->bref;                // referencia
        //$datmail->snotapie = $propaccount->rtext;
        $datmail->snotapie  = $charge->chrname;             // descripcion de concepto
        $datmail->snotapie2 = '';

        return $datmail;
}

// ************ Genera pdf a partir de objetos ya creados ******************
public function pdfpayreceipobj($charge,$movto,$ncondomi,$propietario,$exist)
{
    if (is_null($exist)){
    $exist = $this->pdfexist( $movto->folio);
    }

    $filename =  $movto->folio.'.pdf';
    $filepath =  'movscond1/';

    if (!$exist){     // si NO existe      // Genera PDF 
    $pdf = PDF::loadView('expedpay.payrecippdf',
    compact('charge','propietario','ncondomi','movto'))
    ->setPaper('letter', 'portrait');   
    $pdf->save($filepath.$filename);        // Guarda PDF 
    //$pdf->stream(); 
    }
    $pdfile = new \stdClass();
    $pdfile->path      = $filepath;           // Ruta del archivo
    $pdfile->filename  = $filename;           // Nombre del archivo
    $pdfile->pathfile  = $filepath.$filename; // Nombre del archivo
    $pdfile->exist     = true;                // Existe archivo true / false     

    return $pdfile;
}

// ************ Genera pdf a partir de Ids  ********************************
public function pdfpayreceipids($chrid,$movid)
{
  //Obtiene movimiento
  $movto  = $this->inmumovtoRepository->findWithoutFail($movid);  
  //verifica existencia
  $exist = $this->pdfexist($movto->folio);
  //##############################################################################
  if (!$exist){                             // si NO existe    
    //Obtiene Cargo
    $charges = $this->inmuchargeRepository->gMovtoCH($chrid);
    $charge = $charges[0];     
    //Obtiene propietario 
    $personas = $this->personaRepository->gpropietario($charge->unidid);        
    $propietario = $personas[0];
    //Obtiene nom condominio        
    $condomi = $this->inmuchargeRepository->gChCondomiName($charge->unidid);
    $ncondomi =  $condomi[0]->ident." ".$condomi[0]->descripcion;   // arma nombre
    }   
    else{                                   // si existe
    $charge      = null;
    //$movto       = null;    
    $ncondomi    = '';
    $propietario = null;
    }
    //#########################   Generar PDF  ###################################
    $pdfile = $this->pdfpayreceipobj($charge,$movto,$ncondomi,$propietario,$exist); 
    return $pdfile ;             
  }

public function pdfexist($folio)
{
    $filename =  $folio.'.pdf';
    $filepath =  'movscond1/';
    $exist = Storage::disk('pdftemp')->exists($filename); 
    return $exist;
}

public function creamailhead()
{
 $mailhead = new \stdClass();
     $mailhead->tfrom = env('MAIL_RFROM', 'julio.buendia@infocret.com');  // email remitente
     $mailhead->tname = env('MAIL_RNAME', 'Adprocon');  // Nombre remitente
     $mailhead->tto   = env('MAIL_RTO', 'julio.buendia@infocret.com');  // email destinatario
     $mailhead->tsub  = env('MAIL_RSUB', 'Recibo de pago');  // asunto
     $mailhead->tmsg  = env('MAIL_RMSG', 'Recibo de pago');  // mensage
 return $mailhead;
}



}

 ?>
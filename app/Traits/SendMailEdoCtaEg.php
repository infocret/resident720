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
// use App\Mail\EmailRecipSend;           // clase para enviar correo edo cta
use App\Mail\EmailEgRecipSend;          // clase para enviar correo edo cta de egresos      


// Para generar PDF y enviar mail
trait SendMailEdoCtaEg
{

//################################# MAIL #######################################
//******************** Envia correo a partir de ids  ***************************
// public function sendmailbychargeid($chrid,$mailhead) 
// {
//     //Valida mailhead
//     if (is_null($mailhead)){
//         $mailhead = $this->creamailhead();
//     }
//     //Obtiene registro de Cargo       
//     $charges = $this->inmuchargeRepository->gMovtoCH($chrid);
//     $charge = $charges[0];  
//     $unidid     = $charge->unidid;   // obtener el id de la unidad (immuebles.id)  
//     $conceptocve = $charge->chrcve;  // obtener cve del concepto / serv
//     // Consulta Movimientos de un cargo             
//     $details = $this->inmumovtoRepository->GetMovtos($chrid,'T'); 
//     //Obtiene propietario
//     $personas = $this->personaRepository->gpropietario($charge->unidid);        
//     $propietario = $personas[0];       //dd($propietario);
//     //$npropietario = $propietario->name." ".$propietario->appat." ".$propietario->apmat;
//     // Obtiene nom condominio        
//     $condomi = $this->inmuchargeRepository->gChCondomiName($charge->unidid);
//     $ncondomi = $condomi[0]->ident." ".$condomi[0]->descripcion;// arma nombre
//     //$condomid = $condomi[0]->id;    // id del condominio
//     // Obtiene datos de la cuenta relacionada a un concepto / servicio
//     $arr_propaccount = 
//     $this->conceptservpropaccountRepository->gCtaConcept($conceptocve);
//     $propaccount = $arr_propaccount[0];   
//     //obtiene total de pagos
//     $totpagos = $this->inmumovtoRepository->GetPays($chrid,'A');        
//     $tpagos = $totpagos->tpagos;
//     //llama envio de mail con objetos
//     $res = $this->sendmailedoctaobj(
//     $charge,$details,$mailhead, $ncondomi,$propietario,$propaccount,$tpagos);

//     return $res;
// }


//******************** Envia correo a partir de Objetos  ***************************
// public function sendmailedoctaobj(
//     $charge,$details,$mailhead, $ncondomi,$propietario, $propaccount, $tpagos)
// {
//     //dd($charge);
//     //dd($details);
//     //Valida mailhead
//     if (is_null($mailhead)){
//         $mailhead = $this->creamailhead();
//     }
//     //Generar PDF      
//     $fpdf = $this->pdfedoctaobj($charge,$details,$propietario,$ncondomi,
//     $propaccount, $tpagos, null);
//     //********************************************************************
//     // Crea el objeto o clase que se usara para la informacion y envio de correo 
//     $datmail = $this->armaclasedatmail(
//         $mailhead,$ncondomi,$fpdf,$charge,$propietario,$propaccount,$tpagos);
//     //************************* Envia correo *****************************
//     Mail::to($datmail->sto)                             // Envia correo
//         //->cc('julio_buendia@yahoo.com.mx')
//         //->bcc('OtrocorreoQcorreo.com')
//         ->send(new EmailRecipSend($datmail,$details));

//     return 'ok';
// }

//#######################  Arma la clase datmail  ##################################
public function armaclasedatmail($mailhead,$ncondomi,$fpdf,
        $charge,$proveedor,$tpagos)
{

     //Armae nombre de propietario
    // $npropietario = $propietario->name." ".$propietario->appat." ".$propietario->apmat;    
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
        $datmail->tpagos    =  $tpagos;                     // total de pagos

        $datmail->nproveedor  = $proveedor;            // Nombre de propietario
        // $datmail->titprop       = $propietario->nombre;     // Titulo de propietario

        // $datmail->bname         = $propaccount->bname;      // Banco
        // $datmail->bcta          = $propaccount->bcta;       // Numero de cuenta
        // $datmail->bclabe        = $propaccount->bclabe;     // CLABE
        // $datmail->bconv         = $propaccount->bconv;      // convenio
        // $datmail->bref          = $propaccount->bref;       // referencia

        $datmail->snotapie      = $charge->chrname;         // descripcion de concepto
        $datmail->snotapie2     = 'Sin Obsrvaciones';       // nota a pie1
        
        return $datmail;

}



// ************ Genera pdf a partir de objetos ya creados ******************
// public function pdfedoctaobj($charge,$details,$propietario,$ncondomi,
//     $propaccount, $tpagos, $exist)
// {  
//     if (is_null($exist)){
//     $exist = $this->pdfexist($charge->chrfolio);        
//     }

//     $filename =  $charge->chrfolio.'.pdf';
//     $filepath =  'movscond1/';

//     if (!$exist){     // si NO existe      // Genera PDF 
//     $pdf = PDF::loadView('expededocta.movtopdf',
//     compact('charge','details','propietario','ncondomi',
//                 'propaccount','tpagos'))
//     ->setPaper('letter', 'portrait');    
//     $pdf->save($filepath.$filename);        // Guarda PDF 
//     //$pdf->stream(); 
//     }
//     $pdfile = new \stdClass();
//     $pdfile->path      = $filepath;           // Ruta del archivo
//     $pdfile->filename  = $filename;           // Nombre del archivo
//     $pdfile->pathfile  = $filepath.$filename; // Nombre del archivo
//     $pdfile->exist     = true;                // Existe archivo true / false     

//     return $pdfile;
// }



// ************ Genera pdf a partir de Ids  ********************************
// public function pdfedoctaids($chrid)
//     {
//     // Consulta registro de Cargo (Cabecera)            
//     $charges = $this->inmuchargeRepository->gMovtoCH($chrid);          
//     $charge = $charges[0];        // obtener el primer registro y solo ese

//     //verifica existencia
//     $exist = $this->pdfexist($charge->chrfolio);
              
//     //#######################################################################
//     if (!$exist){                // si NO existe
    
//     $unidid     = $charge->unidid;  // obtener el id de la unidad (immuebles.id)  
//     $conceptocve = $charge->chrcve; // obtener cve del concepto / serv

//     // Consulta Movimientos de un cargo 
//     $details = $this->inmumovtoRepository->GetMovtos($chrid,'T'); 
 
//     $personas = $this->personaRepository->gpropietario($unidid);
//     $propietario = $personas[0];     

//     // Obtiene nom condominio            
//     $condomi = $this->inmuchargeRepository->gChCondomiName($unidid);

//     $ncondomi =  $condomi[0]->ident." ".$condomi[0]->descripcion;// arma nombre condominio  
//     $condomid = $condomi[0]->id; // id del condominio

//     // Obtiene datos de la cuenta relacionada a un concepto / servicio
//     $arr_propaccount = 
//     $this->conceptservpropaccountRepository->gCtaConcept($conceptocve);
//     $propaccount = $arr_propaccount[0];   

//     $totpagos = $this->inmumovtoRepository->GetPays($chrid,'A');        
//     $tpagos = $totpagos->tpagos;
                       
//     $referencia = 'N/A'; 
    
//     }          
//     else{                       // si existe
//     //$charge      = null;
//     $details     = null;
//     $propietario = null;
//     $ncondomi    = '';
//     $propaccount = null;
//     $tpagos      = 0;
    
//     }
//     //############################# Generar PDF ###############################
//     $pdfile = $this->pdfedoctaobj($charge,$details,$propietario,$ncondomi,
//     $propaccount, $tpagos,$exist);  

//     return $pdfile;
// }

 
public function pdfexist($folio)
{
    $filename =  $folio.'.pdf';
    $filepath =  'movscond1/';
    $exist = Storage::disk('pdftemp')->exists($filename); 
    return $exist;
}

public function creamailheadeg()
{
 $mailhead = new \stdClass();
     $mailhead->tfrom = env('MAIL_ERFROME', 'julio.buendia@infocret.com');  // email remitente
     $mailhead->tname = env('MAIL_ENAMEE', 'Adprocon');  // Nombre remitente
     $mailhead->tto   = env('MAIL_ETOE', 'julio.buendia@infocret.com');  // email destinatario
     $mailhead->tsub  = env('MAIL_ESUBE', 'Edo. Cta. Proveedor');  // asunto
     $mailhead->tmsg  = env('MAIL_EMSGE', 'Edo. Cta. Proveedor');  // mensage
 return $mailhead;
}

//*********************   Funciones para edos cuenta de Egresos   ********************

// ************ Genera pdf a partir de Ids  ********************************
public function pdfedoctaegresosids($chrid)
    {

    // Consulta registro de Cargo (Cabecera)            
    $charges = $this->inmuchargeRepository->gMovtoCH($chrid);          
    $charge = $charges[0];        // obtener el primer registro y solo ese

    //verifica existencia
    $exist = $this->pdfexist($charge->chrfolio);
      
    //#######################################################################
    if (!$exist){                // si NO existe
     
    $unidid     = $charge->unidid;  // obtener el id de la unidad (immuebles.id)  
    $conceptocve = $charge->chrcve; // obtener cve del concepto / serv

    // Consulta Movimientos de un cargo 
    $details = $this->inmumovtoRepository->GetMovtos($chrid,'T'); 

    // $personas = $this->personaRepository->gpropietario($unidid);
    // $propietario = $personas[0];     
    
    //Obtiene razon social de provvedor
    $proveedor = $charge->providrazsoc;     
     
    // Obtiene nom condominio            
    //$condomi = $this->inmuchargeRepository->gChCondomiName($unidid);
    $condomi = $this->inmuebleRepository->findWithoutFail($unidid);  

    $ncondomi =  $condomi->ident." ".$condomi->descripcion;// arma nombre condominio  
    $condomid = $condomi->id; // id del condominio

    // Obtiene datos de la cuenta relacionada a un concepto / servicio
    // $arr_propaccount = 
    // $this->conceptservpropaccountRepository->gCtaConcept($conceptocve);
    // $propaccount = $arr_propaccount[0];   

     $totpagos = $this->inmumovtoRepository->GetPays($chrid,'P');        
     $tpagos = $totpagos->tpagos;

    //Obtiene cheques emitidos
    $checkissuances = $this->checkissuanceRepository->gapchecks();
 
    $referencia = 'N/A'; 
    
    }          
    else{                       // si existe
    //$charge      = null;
    $details     = null;
    //$propietario = null;
    $proveedor = null;
    $ncondomi    = '';
    // $propaccount = null;    
    $tpagos      = 0;
    $checkissuances = null;
    
    }

    //############################# Generar PDF ###############################
    $pdfile = $this->pdfedoctaegresosobj($charge,$details,$proveedor,$ncondomi,
    $tpagos, $checkissuances, $exist);  

    return $pdfile;
}

// ************ Genera pdf a partir de objetos ya creados ******************
public function pdfedoctaegresosobj($charge,$details,$proveedor,$ncondomi,
     $tpagos, $checkissuances,$exist)
{  
    if (is_null($exist)){
    $exist = $this->pdfexist($charge->chrfolio);        
    }

    $filename =  $charge->chrfolio.'.pdf';
    $filepath =  'movscond1/';

    if (!$exist){     // si NO existe      // Genera PDF 
    $pdf = PDF::loadView('egresos.movtopdf',
    compact('charge','details','proveedor','ncondomi', 'tpagos', 'checkissuances'))
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

//******************** Envia correo a partir de ids  ***************************
public function egsendmailbychargeid($chrid,$mailhead) 
{
    //Valida mailhead
    if (is_null($mailhead)){
        $mailhead = $this->creamailhead();
    }
    //Obtiene registro de Cargo       
    $charges = $this->inmuchargeRepository->gMovtoCH($chrid);
    $charge = $charges[0];  
    $unidid     = $charge->unidid;   // obtener el id de la unidad (immuebles.id)  
    $conceptocve = $charge->chrcve;  // obtener cve del concepto / serv
    // Consulta Movimientos de un cargo             
    $details = $this->inmumovtoRepository->GetMovtos($chrid,'T'); 
    //Obtiene propietario
    // $personas = $this->personaRepository->gpropietario($charge->unidid);        
    // $propietario = $personas[0];       //dd($propietario);
    //$npropietario = $propietario->name." ".$propietario->appat." ".$propietario->apmat;
     
    //Obtiene razon social de provvedor
    $proveedor = $charge->providrazsoc;   
    
    // Obtiene nom condominio        
    //$condomi = $this->inmuchargeRepository->gChCondomiName($charge->unidid);
    $condomi = $this->inmuebleRepository->findWithoutFail($unidid);  
    $ncondomi = $condomi->ident." ".$condomi->descripcion;// arma nombre
    //$condomid = $condomi[0]->id;    // id del condominio
    // Obtiene datos de la cuenta relacionada a un concepto / servicio
    // $arr_propaccount = 
    // $this->conceptservpropaccountRepository->gCtaConcept($conceptocve);
    // $propaccount = $arr_propaccount[0];   
    
    //obtiene total de pagos
    $totpagos = $this->inmumovtoRepository->GetPays($chrid,'P');        
    $tpagos = $totpagos->tpagos;
    //Obtiene cheques emitidos
    $checkissuances = $this->checkissuanceRepository->gapchecks();
   
    //llama envio de mail con objetos
    $res = $this->sendmailegresosedoctaobj(
    $charge,$details,$mailhead, $ncondomi,$proveedor,$checkissuances,$tpagos);

    return $res;
}


//******************** Envia correo a partir de Objetos  ***************************
public function sendmailegresosedoctaobj(
    $charge,$details,$mailhead, $ncondomi,$proveedor,$checkissuances, $tpagos)
{
    //dd($charge);
    //dd($details);
    //Valida mailhead
    if (is_null($mailhead)){
        $mailhead = $this->creamailhead();
    }

    //Generar PDF     
    $fpdf = $this->pdfedoctaegresosobj($charge,$details,$proveedor,$ncondomi,
     $tpagos,$checkissuances,null);

    //********************************************************************
    // Crea el objeto o clase que se usara para la informacion y envio de correo 
    $datmail = $this->armaclasedatmail(
        $mailhead,$ncondomi,$fpdf,$charge,$proveedor,$tpagos);
    //************************* Envia correo *****************************
    Mail::to($datmail->sto)                             // Envia correo
        //->cc('julio_buendia@yahoo.com.mx')
        //->bcc('OtrocorreoQcorreo.com')
        ->send(new EmailEgRecipSend($datmail,$details,$checkissuances));

    return 'ok';
}



//*********************   Fin edos cuenta de Egresos  ********************************







}

 ?>
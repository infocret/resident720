<?php 
namespace App\Traits;

use Illuminate\Support\Facades\Storage;// para subir archivos
use \Milon\Barcode\DNS1D;              // Para generar codigo de barras
use \Milon\Barcode\DNS2D;              // Para generar codigo de barras
use Barryvdh\DomPDF\Facade as PDF;     // Para generar PDF
use Illuminate\Support\Facades\Mail;   // Fachada Mail
use App\Mail\EmailRecipSend;           // clase para enviar correo edo cta

//use App\Traits\SendMailEdoCta;         // Gen PDF y Envio de mail Estado de Cuenta

// Para generar PDF para imprimir cheque
trait PdfPrintCheque
{


// ************ Genera pdf a partir de objetos ya creados ******************
public function PrintCheque($tcheque)
{  
    
    //$exist = $this->pdfexist($tcheque->id);        
    
    $filename =  $tcheque->id.'.pdf';
    $filepath =  'movscond1/';

    //if (!$exist){     // si NO existe      // Genera PDF 
    $pdf = PDF::loadView('checkissuances.print',
    compact('tcheque'))
    ->setPaper('letter', 'portrait');    
    $pdf->save($filepath.$filename);        // Guarda PDF 
    //$pdf->stream();                            //mostrar PDF
    //}

    $pdfile = new \stdClass();
    $pdfile->path      = $filepath;           // Ruta del archivo
    $pdfile->filename  = $filename;           // Nombre del archivo
    $pdfile->pathfile  = $filepath.$filename; // Nombre del archivo
    $pdfile->exist     = true;                // Existe archivo true / false     

    return $pdfile;
}
public function pdfexist($nam)
{
    $filename =  $nam.'.pdf';
    $filepath =  'movscond1/';
    $exist = Storage::disk('pdftemp')->exists($filename); 
    return $exist;
}

}
<?php 
namespace App\Traits;
use \Carbon\Carbon;    // Para formateo de fechas
// Para generar folios
trait GenFolio
{
        /**
         * Genera Folio
         * @param  [int]    $unidid [unidid]
         * @param  [date]   $fdate  [fdate]
         * @param  [long]   $amount [amount]
         * @param  [string] $movcve [movcve]
         * @param  [int]    $movid  [movid]
         * @param  [int]    $dig    [dig]
         * @return [string]         [Cadena de folio]
         */
	public function gfolio($unidid,$fdate,$amount,$movcve,$movid,$dig)
	{
		  //Arma fecha de movto
        $tfecha = Carbon::parse($fdate);
        $mfecha = $tfecha->month;
        $dfecha = $tfecha->day;
        $afecha = $tfecha->year;
        $afecha = substr($afecha,2,2);   
        //Formatea a dos decimales y Quta punto a monto  
        $xamount = number_format($amount, 2, '.', '');
        $fcuanto = str_replace('.', '', $xamount);

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
        $folio = $folio.str_pad($movcve, 4, "0", STR_PAD_LEFT);
        // 5 inmuchargeid o inmumovtoid
        $folio = $folio.str_pad($movid, 5, "0", STR_PAD_LEFT);
        // 1  digito identifica si es cargo 1 o movto 2                
        $folio = $folio.$dig;        
        //dd($folio);
        
		return $folio;
	}
}

 ?>
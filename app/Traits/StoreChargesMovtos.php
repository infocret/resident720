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
// use Illuminate\Support\Facades\Storage;// para subir archivos
// use \Milon\Barcode\DNS1D;              // Para generar codigo de barras
// use \Milon\Barcode\DNS2D;              // Para generar codigo de barras
// use Barryvdh\DomPDF\Facade as PDF;     // Para generar PDF
// use Illuminate\Support\Facades\Mail;   // Fachada Mail
// use App\Mail\EmailReceipPaySend;       // clase para enviar correo de recibo depago

use App\Traits\GenFolio;         // Genera folio

// Para generar PDF de Recibo de Pago y enviar mail
trait StoreChargesMovtos
{
//============================================================================
use GenFolio;
//============================================================================

//############################################################################
//******************** Inserta Cargos  ***************************************
/**
 * [storecharges description]
 * @param  [type] $unidcve    [description]
 * @param  [type] $unidnom    [description]
 * @param  [type] $condomid   [description]
 * @param  [type] &$charges   [description]
 * @param  [type] &$movtos    [description]
 * @param  [type] $conceptid  [description]
 * @param  [type] $areaid     [description]
 * @param  [type] $providerid [description]
 * @param  [type] $cmovtoid   [description]
 * @param  [type] $cunidmedid [description]
 * @param  [type] $aunidmedid [description]
 * @return [type]             [description]
 */
public function storecharges( 
    $unidcve, $unidnom, $condomid,
    &$charges, &$movtos, $conceptid, $areaid, $providerid, 
    $cmovtoid, $amovtoid, $csdoimovid, $asdoimovid, $ncmovtoid, 
    $cunidmedid, $aunidmedid )
{   
    //obtiene datos de la unidad
    //$unidad = $this->inmuebleRepository->ginmubyident($condmid,$unidcve)
    $unidads = $this->inmuebleRepository->ginmubynom($condomid,$unidnom); 
    $unidad = $unidads[0];    
    //obtiene concepto / servicio
    $conceptserv = $this->conceptserviceRepository->gconcbyid($conceptid);
    // dd($conceptserv);
    // ########## Busca los datos de movimientos Posibles######################
    //obtiene el id de unidadmovto de cargo / id de movimiento del contrato
    $cunimov = $this->unidadmovtoRepository->gunidmovchrmov(
                        $unidad->id, $conceptserv->id, $cmovtoid);    
    //obtiene el id de unidadmovto de abono / id de movimiento del contrato
    $aunimov = $this->unidadmovtoRepository->gunidmovchrmov(
                        $unidad->id, $conceptserv->id, $amovtoid);

    //obtiene el id de unidadmovto de nota de credito / id de movimiento del contrato
    $ncunimov = $this->unidadmovtoRepository->gunidmovchrmov(
                        $unidad->id, $conceptserv->id, $ncmovtoid);

    //obtiene los ids de unidadmovto de saldo inicial / id de movimiento del contrato
    $csdoimov = $this->unidadmovtoRepository->gunidmovchrmov(
                        $unidad->id, $conceptserv->id, $csdoimovid);
    $asdoimov = $this->unidadmovtoRepository->gunidmovchrmov(
                        $unidad->id, $conceptserv->id, $asdoimovid);

    // Obtiene id de unidad de medida 
        // $unidmed = $this->measurunitRepository->gunidmed('servicio');        
        // $cunidmedid = $unidmed->id;   
        // $unidmed = $this->measurunitRepository->gunidmed('pago');        
        // $aunidmedid = $unidmed->id;   
    
    //$inputs = array(); //arreglo para guardar multimples registros
    //######     Barre array de cargos obtenidos de excell  #############
    $i = 0;
    foreach ($charges as $charge) {
         unset($cinput);  //Elimina array para reiniciar valores

        //genera array de datos de registri inmucharge
         $cinput = array(
          "inmu_id"         => $unidad->id,
          "conceptserv_id"  => $conceptid,
          "proparea_id"     => $areaid,
          "provider_id"     => $providerid,
          "date"            => $charge['cdate'], //csdate
          "folio"           => "0000000000000000000000000000",
          "stotal"          => $charge['ccargo'],
          "iva"             => 0,
          "balance"         => $charge['ccargo'],
          "status"          => "Generado",
          //$charge['cconcep'],
          "description"     => $conceptserv->name.' ['.$charge['cmonth'].']', 
          "observ"          => 'Recib.'.$charge['crecib'],
          "filelink"        => "N/A"
         );         
         //array_push($inputs, $cinput); //se agrega a array multiples registros
        $valstatus = $this->checkdatacharge($cinput);
        if($valstatus == 'OK') {//===================================        
         //***** Guardar Charge *****
         $inmucharge = $this->inmuchargeRepository->create($cinput);         
         //calcular  folio de charge
         $cfolio = $this->gfolio($unidad->id,$charge['csdate'],$charge['ccargo'],
            $conceptserv->cve,$inmucharge->id,1);        
         //actualizar folio em charge
         $inpchargeupd = array('folio' => $cfolio); 
         $inmuchargeup = $this->inmuchargeRepository->update($inpchargeupd, $inmucharge->id);
         //actualiza id de cargo registrado
         $charges[$i]['chargeid'] = $inmucharge->id ;                             
         $charges[$i]['cstatus'] = 'OK' ;  
         $lastchargestatus = 'OK' ;
         }
         else{
         $charges[$i]['cstatus'] = 'ErrChar:'.$valstatus ;     
         $lastchargestatus = 'Fail' ;
         //dd($charges); //valida errores
         }         

        //################   Genera inmumovtos de cargo  #######################       
        //===== valida si no hay error en el ultimo cargo y ======================
        //===== Si no hay error en input de movto de cargo ================      
      if( $lastchargestatus == 'OK') {
         //Array para insert
        unset($minput);
        // ######### valida si el carcgo tiene como concepto saldo inicial #############    
        $pos = strpos(strtoupper($charge['cconcep']), 'SALDO');    
        if ($pos !== false) {               //si el concepto es saldo 
          if ($charge['ccargo']>0){         //si es positivo es cargo 
          $unidmovtoid    = $csdoimov->id;
          $unidmovtocve   = $csdoimov->cve;
          $unidmovtodesc  = $csdoimov->description;
          $movmonto       = $charge['ccargo'];
          $munidmed       = $cunidmedid;
          }
          else{                             //si es negativo es abono 
          $unidmovtoid    = $asdoimov->id;
          $unidmovtocve   = $asdoimov->cve;
          $unidmovtodesc  = $asdoimov->description; 
          $movmonto       = $charge['ccargo'] * -1;
          $munidmed       = $aunidmedid ;
          }
        }                                   //si no es saldo 
        else{
          $unidmovtoid    = $cunimov->id;
          $unidmovtocve   = $cunimov->cve;
          $unidmovtodesc  = $cunimov->description;
          $movmonto       = $charge['ccargo'];
          $munidmed       = $cunidmedid;
        }        

        $minput = array(  
            'inmucharg_id'  => $inmucharge->id,
            'unidmovto_id'  => $unidmovtoid ,            
            'catmovto_cve'  => $unidmovtocve,
            'date'          => $charge['cdate'], //csdate
            'folio'         => '0000000000000000000000000000',
            'quantity'      => 1,
            'measurunit_id' => $munidmed,
            'amount'        => $movmonto,
            'balance'       => $movmonto,
            'status'        => 'Generado',
            'apmode'        => 'Automatico',
            'description'   => $unidmovtodesc,
            'observ'        => 'Importado de Excell',            
            'filelink'      => 'N/A' 
        );  
        $valstatus = $this->checkdatamovto($minput);
        if ($valstatus == 'OK' ) {
        //***** Guarda movimiento de cargo 
        $inmumovto = $this->inmumovtoRepository->create($minput);        
        // calcular y folio de movto
        $mfolio = $this->gfolio($unidad->id,$charge['csdate'],$charge['ccargo'],
            $cunimov->cve,$inmumovto->id,2);    
        //actualizar folio de movto
        $inpmovupd = array('folio' => $mfolio);
        $inmvtoupd = $this->inmumovtoRepository->update($inpmovupd, $inmumovto->id);
        $charges[$i]['cmovid'] = $inmumovto->id ;         
        $charges[$i]['cmstatus'] = 'OK' ;     
        }
        else{          
         $charges[$i]['cmstatus'] = 'ErrcMov:'.$valstatus ;     
        }           
      } //fin si no hay error en input de cargo
      $i += 1;
      }//fin de for each de cargos




    //################################################################################
    // //######     Barre array de movimientos obtenidos de excell  #############
    $i = 0;
    foreach ($movtos as $movto) {
    unset($minput);  //Elimina array para reiniciar valores

    $crecib   = str_replace("ABONO RECIBO # ","",$movto['mconcep']);
    $crecib   = intval($crecib);

    $mchargeid = $this->identchargeid($charges,$crecib);

    $pos = strpos($movto['mconcep'], 'NOTA DE CREDITO');
    //si se encuentra la cadena asigna id de nota de credito
    if ($pos !== false) {
      $unidmovtoid    = $ncunimov->id;
      $unidmovtocve   = $ncunimov->cve;
      $unidmovtodesc  = $ncunimov->description;
      $mchargeid      = $lastchargeid; //se aplica al ultimo cargo valido
      //dd($movto['mconcep']);
    }
    else{// si no se encuentra asigna id de abono
      $unidmovtoid    = $aunimov->id;
      $unidmovtocve   = $aunimov->cve;
      $unidmovtodesc  = $aunimov->description;
    }


    $minput = array(
        'inmucharg_id'  => $mchargeid,
        'unidmovto_id'  => $unidmovtoid,            
        'catmovto_cve'  => $unidmovtocve,
        'date'          => $movto['mdate'], //csdate
        'folio'         => '0000000000000000000000000000',
        'quantity'      => 1,
        'measurunit_id' => $aunidmedid,
        'amount'        => $movto['mabono'],
        'balance'       => $movto['mabono'],
        'status'        => 'Generado',
        'apmode'        => 'Automatico',
        'description'   => $unidmovtodesc,
        'observ'        => $movto['mobserv'].'| Fol.'.$movto['mfolio'],
        'filelink'      => 'N/A' 
    );  
    $valstatus = $this->checkdatamovto($minput);
    if($valstatus == 'OK') {//=================================== 
    //inserta registro de movimiento de cargo
    $inmumovto = $this->inmumovtoRepository->create($minput);        
    // calcular y folio de movto
    $mfolio = $this->gfolio($unidad->id,$movto['msdate'],$movto['mabono'],
        $aunimov->cve,$inmumovto->id,2);    
    //actualizar folio de movto
    $inpmovupd = array('folio' => $mfolio);
    $inmvtoupd = $this->inmumovtoRepository->update($inpmovupd, $inmumovto->id);  

    //===============   Actualiza Saldo y estatus   ==============  
    $chrfolio  = $this->inmuchargeRepository->gDecpay($mchargeid,$movto['mabono']); 
    //actualiza id de cargo registrado
    $movtos[$i]['movid'] = $inmumovto->id ; 
    $movtos[$i]['mchargeid'] = $mchargeid ; 
    $movtos[$i]['mstatus'] = 'OK' ;     
    }
    else{
    $movtos[$i]['mstatus'] = 'ErrMov:'.$valstatus ;     
    }  
     $i += 1;
     $lastchargeid = $mchargeid;
    }

    return 'OK';
}

/**
 * [identchargeid description]
 * @param  [type] $charges [description]
 * @param  [type] $recib   [description]
 * @return [type]          [description]
 */
public function identchargeid($charges,$recib)
{  
    $chrid = 0;
    foreach ($charges as $charge) {
      if ($charge['crecib'] == $recib){
          $chrid = $charge['chargeid'];           
          break 1;
      }
    }    
    return $chrid;
}

public function checkdatacharge($inpcharge)
{
    $result ='OK';
    if ($inpcharge['inmu_id'] < 1) { return 'inmu_id'; }
    if ($inpcharge['conceptserv_id'] < 1) { return 'conceptserv_id'; }
    if ($inpcharge['proparea_id'] < 1) { return 'proparea_id'; }
    if ($inpcharge['provider_id'] < 1) { return 'provider_id'; }
    if ($inpcharge['stotal'] = 0 || is_null($inpcharge['stotal'])) { return 'stotal'; }
    if ($inpcharge['balance'] = 0 || is_null($inpcharge['balance'])) { return 'balance'; }
    return $result;
}

public function checkdatamovto($inpmovto)
{
    $result ='OK';
    if ($inpmovto['inmucharg_id'] < 1) { return 'inmucharg_id'; }
    if ($inpmovto['unidmovto_id'] < 1) { return 'unidmovto_id'; }
    if (strlen($inpmovto['catmovto_cve']) < 1) { return 'catmovto_cve'; }    
    if ($inpmovto['measurunit_id'] < 1) { return 'measurunit_id'; }
    if ($inpmovto['amount'] <= 0 || is_null($inpmovto['amount'])) { return 'amount'; }
    if ($inpmovto['balance'] <= 0 || is_null($inpmovto['balance'])) { return 'balance'; }    
    return $result;
}


function getfilelist($directorio){

  // Array en el que obtendremos los resultados
  $res = array();
  $finfo = finfo_open(FILEINFO_MIME_TYPE); // devuelve el tipo mime de su extensión
  // Agregamos la barra invertida al final en caso de que no exista
  if(substr($directorio, -1) != "/") $directorio .= "/";

  // Creamos un puntero al directorio y obtenemos el listado de archivos
  $dir = @dir($directorio) or 
      die("getFileList: Error abriendo el directorio $directorio para  leerlo");

  while(($archivo = $dir->read()) !== false) {
      // Obviamos los archivos ocultos
      if($archivo[0] == ".") continue;
      if (is_readable($directorio . $archivo)) {
        $ext = pathinfo($directorio . $archivo, PATHINFO_EXTENSION);
        if( $ext == 'xls' || $ext == 'xlsx'){   
          $res[] = array(
            "Ruta" => $directorio,
            "Nombre" => $archivo,
            "RutNom" => $directorio . $archivo, // . "/",
            "Extencion" => pathinfo($directorio . $archivo, PATHINFO_EXTENSION),
            "Tamaño" => filesize($directorio . $archivo),
            "Modificado" => filemtime($directorio . $archivo),            
            "Mime" => finfo_file($finfo,$directorio . $archivo)
          );
       }// tiene extencion xls o xlsx
      } // es archivo
  } // endwhile

  $dir->close();
  return $res;
}




}

 ?>
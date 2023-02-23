<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateinmumovtoRequest;
use App\Http\Requests\UpdateinmumovtoRequest;
use App\Repositories\inmuchargeRepository;      // cargos aplicados
use App\Repositories\unidadmovtoRepository;     // contratos
use App\Repositories\inmumovtoRepository;       // movimientos aplicados 
//use App\Repositories\personaRepository;         // personas rel a inmueble
use App\Repositories\conceptservpropaccountRepository; // Cuentas rel Concepto/serv
use App\Repositories\measurunitRepository;
use App\Repositories\inmuebleRepository;
use App\Repositories\propertyareasRepository;
use App\Repositories\conceptserviceRepository;
use App\Repositories\providersRepository;
use App\Repositories\catmovtoRepository;

use Prettus\Repository\Criteria\RequestCriteria;
use App\Http\Controllers\AppBaseController;
use Flash;
use Response;
use Illuminate\Support\Facades\Storage;     // para subir archivos
use \Carbon\Carbon;                        // Para formateo de fechas
//iportar archivos y libreria de excell
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

use App\Traits\StoreChargesMovtos;         // Gen PDF y Envio de mail Estado de Cuenta


class movtosimportController extends AppBaseController
{
    /** @var  condominioRepository */
    //private $condominioRepository;

  public function __construct(
        inmumovtoRepository $inmumovtoRepo,
        inmuchargeRepository $inmuchargeRepo,
        unidadmovtoRepository $unidadmovtoRepo,
        //personaRepository $personaRepo,
        conceptservpropaccountRepository $conceptservpropaccountRepo,
        measurunitRepository $measurunitRepo,
        inmuebleRepository $inmuebleRepo,
        propertyareasRepository $propertyareasRepo,
        conceptserviceRepository $conceptserviceRepo,
        providersRepository $providersRepo,
        catmovtoRepository $catmovtoRepo
    )
    {
        $this->inmumovtoRepository = $inmumovtoRepo;
        $this->inmuchargeRepository = $inmuchargeRepo;
        $this->unidadmovtoRepository = $unidadmovtoRepo; 
        //$this->personaRepository = $personaRepo; 
        $this->conceptservpropaccountRepository = $conceptservpropaccountRepo; 
        $this->measurunitRepository = $measurunitRepo;    
        $this->inmuebleRepository = $inmuebleRepo; 
        $this->propertyareasRepository = $propertyareasRepo;
        $this->conceptserviceRepository = $conceptserviceRepo; 
        $this->providersRepository = $providersRepo; 
        $this->catmovtoRepository = $catmovtoRepo; 
    }

//============================================================================
use StoreChargesMovtos;
//============================================================================

    public function selfile(Request $request)
     {
        $condomid    = Session('condominioexpid');       
        //$area        = $this->propertyareasRepository->gareabyname($condomid,'Admin');
        $areas       = $this->propertyareasRepository->gAreas($condomid);
        $concepservs = $this->conceptserviceRepository->all();
        $providers   = $this->providersRepository->all(); //gprovbyname('ADP'); 
        $cmovtos  = $this->catmovtoRepository->gbytipo('C');
        $amovtos  = $this->catmovtoRepository->gbytipo('A');
        $medidas  = $this->measurunitRepository->all();

        //dd(GetPeriod::GetP()); // Prueba de consumo de helper:  app/Helpers/GetPeriodo.php
         return view('inmumovtos.selfile')
         ->with('areas',$areas)
         ->with('concepservs',$concepservs)
         ->with('providers',$providers)
         ->with('cmovtos',$cmovtos)
         ->with('amovtos',$amovtos)
         ->with('medidas',$medidas)
         ;            
     }

//******************************************************************************
 public function upload(Request $request)  {
    
    $input = $request->all();  
    $condomid = Session('condominioexpid');  
    //dd($input);
    
    //Cronometro
    $carbon = new \Carbon\Carbon();
    $dini = $carbon->now();
    $path = 'box/import/';
    
 try {
     

    //si se selecciono funo - solo uno.
    if ($input['opfile'] == "funo" ) {       
    // si NO trae archivo TRUE, manda a pedir archivo
    if (!$request->hasfile('Archivo')) {
     Flash::error('Marco importar un archivo pero, No se selecciono ninguno.'); 
     return redirect(route('movsimport.selfile' ));;
    } 
    else{                       // si trae archivo
        $file = $request->file('Archivo');              //otiene archivo del request      
        $mime = $file->getClientMimeType();             //obtiene el mimetype
        $size = $file->getSize();                       //obtiene el tamaño del archivo
        $ext  = $file->getClientOriginalExtension();    //obtiene extencion original       
        
        //si el mimetype NO es de excell
        if  ( !($mime == "application/vnd.ms-excel") &&
              !($mime == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
        ){                      
          $filename = $file->getClientOriginalName();  
          Flash::error('El archivo: '.$filename.' NO es un archivo de Excell.');
          return redirect(route('movsimport.selfile' )); 
        }
        else{                   // se el archivo es de excell          
          $filename = $file->getClientOriginalName(); //obtiene el nombre del archivo
          // lo guarda en carpeta pubic/box                              
          $pathsave = $file->storeAs('/import/',$filename,'publicbox'); 
          
          // $ps =strpos($filename, '.'); 
          // $slen = strlen ($filename);
          // $ext = substr($filename, $ps,$slen - $ps);

          $files = array();
          $files[] = array(
            "Ruta" => $path,
            "Nombre" => $filename,
            "RutNom" => $path.$filename,
            "Extencion" => $ext,
            "Tamaño" => $size,
            "Modificado" => 0,
            "Mime" => $mime
            );
          
        }   // fin de si el archivo es de excell
    }       // fin de si trae archivo
    }       // Fin de si se selecciono funo -solo uno

    //  si se selecciono ftodo -Todos los archvos
    if ($input['opfile'] == "ftodo" ) { 
      //llena array de archivos  tipo excell en el dir box/import
      $files = $this->getfilelist('box/import');     
    }
      //dd($files);
    //***************************************************************************
    //  Carga y barre array de archivos/ lee / parsea el archivo de excell
    
    // configura localizacion para fechas en español
    Carbon::setLocale('es');
    setlocale(LC_ALL, 'es_MX', 'es', 'ES') ;
    // recupera datos de request   
    $conceptid  = $input['conceptserv_id'];  
    $areaid     = $input['proparea_id'];  
    $providerid = $input['provider_id']; 
    $cmovtoid   = $input['cmovto_id']; 
    $amovtoid   = $input['amovto_id']; 
    $ncmovtoid  = $input['ncmovto_id']; 
    $cunidmedid = $input['cmedida_id']; 
    $aunidmedid = $input['amedida_id'];
    $csdoimovid = $input['csdoimovto_id'];   
    $asdoimovid = $input['asdoimovto_id'];   



    $nfiles     = 0; //numero de archivos procesados

    $flog = fopen($path."Log".$dini->format('Ymdhms').".txt", "w"); //Abre Log

    fwrite($flog,'Inicio:'.$dini->format('l jS \\of F Y h:i:s A').PHP_EOL);
    fwrite($flog,'Conceptid:'.$conceptid.'|Areaid:'.$areaid.'|Proveedorid:'.$providerid.
        '|CargoUniMovid:'.$cmovtoid.'|AbonoUniMovid:'.$amovtoid.'|NotaCredUniMovid:'.$ncmovtoid.
        '|CargoUmed:'.$cunidmedid.'|AbonoUmed:'.$aunidmedid.PHP_EOL);

foreach ($files as $file) {

    $charges    = array(); //array para cargos
    $movtos     = array(); //array para movimientos
    // https://phpspreadsheet.readthedocs.io/en/develop/topics/accessing-cells/
    $fname = $file['Nombre'];
    $inputFileName = $file['RutNom']; //'box/import/'.$filename; // asigna ruta y nombre de archivo
    fwrite($flog,'Archivo:'.$nfiles.'-'.$fname.PHP_EOL);
    //dd($inputFileName);
    $spreadsheet = IOFactory::load($inputFileName); // lee el archivo
    // manda todo el contenido a un array
    //$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    // obtiene el valor de la celda  B5 por coordenadas numericas
    //$cellValue = $spreadsheet->getActiveSheet()->getCellByColumnAndRow(2, 5)->getValue();
    // obtiene el valor de la celda A3 por referencia
    //$cellValue = $WorkSheet->getCell('A3')->getValue();

    // obtiene el nombre del las hojas del libro en un array
    //$sheetnames=$spreadsheet->getSheetNames();
    //dd($sheetnames);
     //$sheetname=$sheetnames[0];
    // obtiene hoja de trabajo activo
    //$worksheet = $spreadsheet->getActiveSheet();
    $WorkSheet = $spreadsheet->getSheetByName('04 - Auxiliar de Condomino'); // lee hoja de trabajo
    //$WorkSheet = $sheetname=$sheetnames[0];
    $unidcve = 'n/a' ;
    $unidnom = 'n/a' ;
    //$unidcve = $WorkSheet->getCell('E8')->getValue(); //clave de unidad 
    $unidnom = $WorkSheet->getCell('J8')->getValue();   //nom de unidad     
    
    $unidnom = str_replace("DEPTO. ","",$unidnom);      //si es arch cta mantto
    $unidnom = str_replace("C.E DEPTO. ","",$unidnom);  //si es arch cuota extr
    $unidnom = str_replace("GS  ","",$unidnom);         //si es arch consumo gas    
    $unidnom = str_replace("GS ","",$unidnom);  //si es arch cuota extr
    $unidnom = str_replace("C.E ","",$unidnom);         //si es arch cuota extr
    $unidnom = trim($unidnom," ");                      //si elimina espacios

    //#############  ciclo que barre hoja de excell  y genera array #########
    $i = 18;
    do {
        $movdate = $WorkSheet->getCell('A'.$i)->getValue();     //convierte serie excell a fecha
        $date   = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($movdate);
        $sdate  = $date->format('Y-m-d H:i:s');                 //cadena de fecha
        $fecha  = Carbon::parse($sdate);                        //crea objeto carbon 
        $mes    = $fecha->formatLocalized('%B');                //mes en idioma español

        $recib      = $WorkSheet->getCell('C'.$i)->getValue();  //C recibo
        $recib      = intval($recib);
        $cargo      = $WorkSheet->getCell('G'.$i)->getValue();  //G cargo
        $abono      = $WorkSheet->getCell('K'.$i)->getValue();  //K abono
        $saldo      = $WorkSheet->getCell('L'.$i)->getValue();  //L saldo
        $concept    = $WorkSheet->getCell('N'.$i)->getValue();  //N concepto
        $observ     = $WorkSheet->getCell('S'.$i)->getValue();  //S observ
        $folio      = $WorkSheet->getCell('W'.$i)->getValue();  //W folio      
        //$test =  $movdate.'|'.$date->format('Y-m-d H:i:s').'|'. $recib.'|'.$cargo.'|'.
        //         $abono.'|'.$saldo.'|'.$concept.'|'.$observ.'|'.$folio;
        //dd($test);
        
        //Ajusta notas de credito, saldos anteriores busca en concepto 
        // (El operador !== también puede ser usado. Puesto que != no funcionará como se espera
        // porque la posición de 'a' es 0. La declaración (0 != false) se evalúa a 
        // false.)
        $pos = strpos(strtoupper($concept), 'NOTA DE CREDITO');
        //si se encuentra la cadena
        if ($pos !== false) {
            $abono = $cargo * -1;
            $cargo = null;
        }
       // $pos = strpos(strtoupper($concept), 'SALDO');
       //  //si se encuentra la cadena
       //  if ($pos !== false) {
       //      if ($cargo<0) { // si el cargo es negativo genera un abono
       //          $abono = $cargo * -1;
       //          $cargo = null;
       //      }
       //  }


        if (!is_null($cargo)){
        $charge = array(
            'cdate'   => $date,
            'csdate'  => $sdate,
            'cmonth'  => $mes,
            'crecib'  => $recib,
            'ccargo'  => $cargo,
            'cabono'  => $abono,        
            'csaldo'  => $saldo,
            'cconcep' => $concept,
            'cobserv' => $observ,
            'cfolio'  => $folio,
            'chargeid' => 0,
            'cmovid'  => 0,
            'crow'     => $i,
            'cstatus'  => 'n/a',
            'cmstatus'  => 'n/a'

        );
        array_push($charges, $charge);
        }
        if (!is_null($abono)){
        $movto = array(
            'mdate'   => $date,
            'msdate'  => $sdate,
            'mmonth'  => $mes,
            'mrecib'  => $recib,
            'mcargo'  => $cargo,
            'mabono'  => $abono,        
            'msaldo'  => $saldo,
            'mconcep' => $concept,
            'mobserv' => $observ,
            'mfolio'  => $folio,
            'mchargeid' => 0,
            'movid'  => 0,
            'mrow'  => $i,
            'mstatus'  => 'n/a'
        );    
      
        array_push($movtos, $movto);
        }

        $i += 1;
    } while (!is_null( $movdate));
    //dd($charges);
    //dd($movtos);

    //############  Crea y registra inmucharges e inmumovtos  ##################
    $res = $this->storecharges(
        $unidcve, $unidnom, $condomid, $charges, $movtos,
        $conceptid, $areaid, $providerid, $cmovtoid,$amovtoid, 
        $csdoimovid, $asdoimovid, $ncmovtoid, $cunidmedid, $aunidmedid ); //<<<----- Guarda  !!  ****
    //#########################################################################
    //actualiza en hoja de excell 

    $cell  = $WorkSheet->setCellValue('Y17', 'Inmucharge.id');
    $cell  = $WorkSheet->setCellValue('Z17', 'Inmumovto.id');    
    $cell  = $WorkSheet->setCellValue('AA17', 'Status');  
    fwrite($flog,'Cargos:'.PHP_EOL);
    foreach ($charges as $charge) {           
    $cell  = $WorkSheet->setCellValue('Y'.$charge['crow'], $charge['chargeid']);
    $cell  = $WorkSheet->setCellValue('Z'.$charge['crow'], $charge['cmovid']);
    $cell  = $WorkSheet->setCellValue('AA'.$charge['crow'], $charge['cstatus']);
    $cell  = $WorkSheet->setCellValue('AB'.$charge['crow'], $charge['cmstatus']);
    fwrite($flog,$charge['crow'].'|'.$charge['cdate']->format('d-m-Y').'|'.
            $charge['ccargo'].'|'.$charge['chargeid'].'|'.$charge['cmovid'].'|'.
            $charge['cstatus'].'|'.$charge['cmstatus'].PHP_EOL);
    }  
    fwrite($flog,'Movimientos:'.PHP_EOL);
    foreach ($movtos as $movto) {    
    $cell  = $WorkSheet->setCellValue('Y'.$movto['mrow'], $movto['mchargeid']);       
    $cell  = $WorkSheet->setCellValue('Z'.$movto['mrow'], $movto['movid']);
    $cell  = $WorkSheet->setCellValue('AA'.$movto['mrow'], $movto['mstatus']);
    fwrite($flog,$movto['mrow'].'|'.$movto['mdate']->format('d-m-Y').'|'.
            $movto['mabono'].'|'.$movto['mchargeid'].'|'.$movto['movid'].'|'.
            $movto['mstatus'].PHP_EOL);
     $posb = strpos($movto['mconcep'], 'sin asignar');
     //si se encuentra la cadena 
     if ($posb !== false) {
        fwrite($flog,$movto['mrow'].'|'.'Ignorado :'.$movto['mconcep'].PHP_EOL);         
     }   
    }    
 
    //Guarda el archivo de excell actualizado 
    $nfile =  substr($fname, 0, -4);    
    $writer = IOFactory::createWriter($spreadsheet, 'Xls');
    $writer->save('box/import/finished/'.$nfile.'_IMP.xls');

//***************************************************************************
  $nfiles += 1;     // numero de archivos procesados
  unset($charges);  //Elimina array para reiniciar valores
  unset($movtos);   //Elimina array para reiniciar valores
} //Fin for each que barre array de archivos   
    $dfin = $carbon->now();  
    fwrite($flog,'Fin:'.$dfin->format('l jS \\of F Y h:i:s A').PHP_EOL);
    $tiempo = $dini->diffInSeconds($dfin);
    $msgfin ='En '. $tiempo .' Segundos. Se procesaron '.$nfiles.' archivo(s) de box/import/ ';
    fwrite($flog,$msgfin.PHP_EOL);
    Flash::success ($msgfin);  
    fclose($flog);          
    return redirect(route('movsimport.selfile' )); 

} catch (Exception $e) {  
    //Exception $e  //throw new Exception("Algún mensaje de error");    
    $errmsg  = $e->getMessage(); //mensaje de error
    $errcode = $e->getCode();    //codigo de  error     
    $errfile = $e->getfile();    //archivo que provoco el error      
    $errline = $e->getline();    //linea que provoco el error      
    $msgerrfin = 'Cod:'.$errcode.'| File:'.$errfile.'| Line:'.$errline.'| Msg:'.$errmsg;
    Flash::error ($msgerrfin);
    fwrite($flog,$msgerrfin.PHP_EOL);
    fclose($flog); 
    return redirect(route('movsimport.selfile' ));    
} //fin try catch       
    
}//fin funcion      


}//fin controlador

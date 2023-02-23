<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateinmuebleRequest;
use App\Http\Requests\UpdateinmuebleRequest;
use App\Repositories\inmuebleRepository;
//use App\Repositories\InmuebleTipoRepository;
use App\Http\Controllers\AppBaseController;

use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
//iportar archivos y libreria de excell
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class condomimportController extends AppBaseController
{
    /** @var  condominioRepository */
    private $condominioRepository;

    public function __construct(
        inmuebleRepository $inmuebleRepo
        //InmuebleTipoRepository $InmuebleTipoRepo
    )
    {
        $this->inmuebleRepository = $inmuebleRepo;
        //$this->InmuebleTipoRepository = $InmuebleTipoRepo;
    }

    public function selfile(Request $request)
     {
         //dd(GetPeriod::GetP()); // Prueba de consumo de helper:  app/Helpers/GetPeriodo.php
         return view('condominios.selfile');            
     }

//******************************************************************************
 public function upfile(Request $request)  {
// si el reques trae un archivo
 if ($request->hasfile('Archivo')){   
    $file=$request->file('Archivo');         // otiene archivo del request
    $mime = $file->getClientMimeType();
    //dd($mime); //application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
    
        // valida si es un archivo d excell
        if  ($mime == "application/vnd.ms-excel" ||
             $mime == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" )
        {
            $filename=$file->getClientOriginalName(); //obtiene el nombre del archivo
            // lo guarda en carpeta pubic/box                              
            $path = $file->storeAs('/codegen/',$filename,'publicbox');  

//***************************************************************************
//                Carga / lee / parsea el archivo de excell
// https://phpspreadsheet.readthedocs.io/en/develop/topics/accessing-cells/
$inputFileName ='box/codegen/'.$filename;       // asigna ruta y nombre de archivo
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
// $sheetname=$sheetnames[0];
// obtiene hoja de trabajo activo
//$worksheet = $spreadsheet->getActiveSheet();
$WorkSheet = $spreadsheet->getSheetByName('DatosCondominio'); // lee hoja de trabajo

// Crea stdClass Object
$condomi = new \stdClass();
 
//Datos condominio
$cve = $WorkSheet->getCell('B3')->getValue();
$condomi->cve = $cve;
$nom = $WorkSheet->getCell('B5')->getValue();
$condomi->nom = $nom;
$nunid = $WorkSheet->getCell('B7')->getValue();
$condomi->nunid = $nunid;
$rfc = $WorkSheet->getCell('B9')->getValue();
$condomi->rfc = $rfc;
$cp = $WorkSheet->getCell('B11')->getValue();
$condomi->cp = $cp;
$calle = $WorkSheet->getCell('B13')->getValue();
$condomi->calle = $calle;
$numext = $WorkSheet->getCell('B15')->getValue();
$condomi->numext = $numext;
//dd($cve.'|'.$nom.'|'.$nunid.'|'.$rfc.'|'.$cp.'|'.$calle.'|'.$numext);

//Datos Administrador
$adminom = $WorkSheet->getCell('B19')->getValue();
$condomi->adminom = $adminom;
$admiapp = $WorkSheet->getCell('B21')->getValue();
$condomi->admiapp = $admiapp;
$admiapm = $WorkSheet->getCell('B23')->getValue();
$condomi->admiapm = $admiapm;
$admiemail = $WorkSheet->getCell('B25')->getValue();
$condomi->admiemail = $admiemail;
$admitel =  $WorkSheet->getCell('B27')->getValue();
$condomi->admitel = $admitel;
//dd($adminom.'|'.$admiapp.'|'.$admiapm.'|'.$admiemail.'|'.$admitel);

//Generación de recibos
$diavencim =  $WorkSheet->getCell('B31')->getValue();
$condomi->diavencim = $diavencim;
$tzainter =  $WorkSheet->getCell('B33')->getValue();
$condomi->tzainter = $tzainter;
$gcent =  $WorkSheet->getCell('B35')->getValue();
$condomi->gcent = $gcent;
$descppag =  $WorkSheet->getCell('B37')->getValue();
$condomi->descppag = $descppag;
$diasvenc =  $WorkSheet->getCell('B40')->getValue();
$condomi->diasvenc = $diasvenc;
$tzainterv =  $WorkSheet->getCell('B42')->getValue();
$condomi->tzainterv = $tzainterv;
$numrecib =  $WorkSheet->getCell('B44')->getValue();
$condomi->numrecib = $numrecib;
//dd($diavencim.'|'.$tzainter.'|'.$gcent.'|'.$descppag.'|'.$diasvenc.'|'.$tzainterv.'|'.$numrecib );

// Cuntas bancarias
$banco =  $WorkSheet->getCell('B48')->getValue();
$condomi->banco = $banco;
$sucursal =  $WorkSheet->getCell('B50')->getValue();
$condomi->sucursal = $sucursal;
$cta =  $WorkSheet->getCell('B52')->getValue();
$condomi->cta = $cta;
$clabe =  $WorkSheet->getCell('B54')->getValue();
$condomi->clabe = $clabe;
$convenio =  $WorkSheet->getCell('B57')->getValue();
$condomi->convenio = $convenio;
$chequera =  $WorkSheet->getCell('B59')->getValue();
$condomi->chequera = $chequera;
//dd($banco.'|'.$sucursal.'|'.$cta.'|'.$clabe.'|'.$convenio.'|'.$chequera);
//dd($condomi);

//***************************************************************************
     
        
        //Flash::success('Carga de archivo correcta en: box/codegen/');            
            return view('condominios.create') 
            ->with('condomi',$condomi);
        }
        else{
        $filename=$file->getClientOriginalName();  
        Flash::error('El archivo: '.$filename.' NO es un archivo valido.');
            return view('condominios.selfile');
        }
     }
     else{        
        Flash::error('No se selecciono ningun archivo.'); 
               return view('condominios.selfile');
     }   
         return view('condominios.selfile');
     }     


   }

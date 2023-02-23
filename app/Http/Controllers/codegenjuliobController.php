<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

//use GetPeriod; // Prueba de consumo de helper: app/Helpers/GetPeriodo.php
class codegenjuliobController extends AppBaseController
{
   
 public function codindex(Request $request)
     {
         //dd(GetPeriod::GetP()); // Prueba de consumo de helper:  app/Helpers/GetPeriodo.php
         return view('codegen.index');            
     }
//******************************************************************************
 public function codupload(Request $request)  {
// si el reques trae un archivo
 if ($request->hasfile('Archivo')){   
    $file=$request->file('Archivo');         // otiene archivo del request
        // valida si es un archivo d excell
        if  ($file->getClientMimeType()=="application/vnd.ms-excel"){
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
//$cellValue = $spreadsheet->getActiveSheet()->getCell('A3')->getValue();

// obtiene el nombre del las hojas del libro en un array
$sheetnames=$spreadsheet->getSheetNames();
//dd($sheetnames[0]);
$sheetname=$sheetnames[0];
// obtiene libro de trabajo activo
$worksheet = $spreadsheet->getActiveSheet();

//***************************************************************************            
//                      Abre el archivo txt para escritura 
//   
    $filegentx='box/codegen/fields_'.$sheetname.'.json';                 
    $archivo = fopen($filegentx, "w");
    
        // eScribe en el archivo plano que sera el JSON 
        fputs($archivo, "["); 
        //fputs($archivo,chr(13).chr(10));    
 
//**************************************************************************              //          ciclo que barre las filas por medio de un iterator
$rowb=0;
$dval='n';
foreach ($worksheet->getRowIterator() as $row) {
   
    $cellIterator = $row->getCellIterator();   //crea iteracion de celdas de una fila
    // se busca solo hasta que ya no tenga valor una celda
    $cellIterator->setIterateOnlyExistingCells(FALSE); 
    //ciclo que barre las celdas de una fila de izq a derecha
    $rowb=$rowb+1;   
    // este es el cierre de campo lo imprime para el anterior
    // solo despues de que avanzo a la segunda fila
    if ($rowb>2 ){  
     fputs($archivo,"},");
     fputs($archivo,chr(13).chr(10));     
     }  
   
     //inicia bloque de campo
    if ($rowb>1){
    fputs($archivo,"{"); 
    fputs($archivo,chr(13).chr(10));   
    }
    $col=0;
    $fields=[]; // array que permite controlar lista final de definiciones    
    foreach ($cellIterator as $cell) {        
        $cellvalue=$cell->getValue();   // toma valor de la celda
        $col=$col+1;                    // Aumenta en uno el indice de la columna
        $linea="";                      // inicializa la linea de texto a imprimir
        // Decide como armar la linea de texto dependiendo de la columna
        if ($rowb>1){                        
            switch($col){
            case 1://  "name": "id",
            $dval="name"; break;
            case 2://  "dbType": "increments",
            $dval="dbType"; break;
            case 3://"htmlType": "",
            $dval="htmlType"; break;
            case 4://"validations": "",
            $dval="validations"; break;
            case 5://"searchable": false,
            $dval="searchable"; break;
            case 6://"fillable": false,
            $dval="fillable"; break;
            case 7://"primary": true,
            $dval="primary"; break;
            case 8://"inForm": false,
            $dval="inForm"; break;
            case 9://"inIndex": false            
            $dval="inIndex"; break;
            case 10:// "type": "relation",
            $dval="type"; break;
            case 11://"relation": "mt1,persona,persona_id,id"               
            $dval="relation"; break;            
            }                        
            $linea='"'.$dval.'":'; // arma la parte derecha de linea
            // decide si agregar comilas a la parte izquierda 
            if ($col<5 or $col>9){
               $linea=$linea.'"'.$cellvalue.'"';                   
            }
            else{
               $linea=$linea.$cellvalue;    
            }  
            // si el valor obtenido de la celda tiene valor (si no es vacio)
            if (!empty($cellvalue)){               
                $fields[]=$linea; // agrega la linea a un array
            }            
        }        
    }
    
// longitud del array final 
$longitud = count($fields);
// barre array final
for($i=0; $i<$longitud; $i++){
    if ($i>0){  // para colocar correctamente la "," al final de cada def de campo 
        fputs($archivo,",");
        fputs($archivo,chr(13).chr(10));            
    }
    fputs($archivo,$fields[$i]);   // se agrega linea     
}
// se agrega salto delinea al final  de esa def de campo      
fputs($archivo,chr(13).chr(10));   
    
}

//**************************************************************************
        // se agrega salto al final de la ultima fila de excell ultimo campo
        //fputs($archivo,chr(13).chr(10));
        fputs($archivo, "}");               // Cierre 
        fputs($archivo,chr(13).chr(10));    // salto de pagina para final de campos
        // Cierra  el archivo plano que sera el JSON
        fputs($archivo, "]");        
        fputs($archivo,chr(13).chr(10));    // salto de pagina para final de archivo 
        fclose($archivo);                   // cierra el archivo

 // ****************  genera archivo de ejecución *****************************
$filegentx='box/codegen/exec_'.$sheetname.'.txt';                 
$archivo = fopen($filegentx, "w");
fputs($archivo,'php artisan infyom:api_scaffold ');
fputs($archivo,$sheetname);
fputs($archivo,' --fieldsFile="C:\laragon\www\testc1\zgeneradores\fields_');
fputs($archivo,$sheetname);
fputs($archivo,'.json'.'"');
fputs($archivo,chr(13).chr(10));
fputs($archivo,'
============================================================================================');
fputs($archivo,chr(13).chr(10));
fputs($archivo,'
--skip=migration,model,views,menu');
fputs($archivo,chr(13).chr(10));
fputs($archivo,' --paginate=10 '); 
fputs($archivo,chr(13).chr(10));
fputs($archivo,' --datatables=true ');
fputs($archivo,chr(13).chr(10));
fputs($archivo,' --save ');
fputs($archivo,chr(13).chr(10));
fputs($archivo,'
=============================***** Roollbacks *****=========================================');
fputs($archivo,chr(13).chr(10));
fputs($archivo,'
============================================================================================');
fputs($archivo,chr(13).chr(10));
fputs($archivo,'
php artisan infyom:rollback '.$sheetname.' scaffold');
fputs($archivo,chr(13).chr(10));
fputs($archivo,'
php artisan infyom:rollback '.$sheetname.' api');
fputs($archivo,chr(13).chr(10));
fputs($archivo,'
php artisan infyom:rollback '.$sheetname.' api_scaffold');
fputs($archivo,chr(13).chr(10));
fputs($archivo,'
=============================***** Skip, options *****=========================================');
fputs($archivo,chr(13).chr(10));
fputs($archivo,' --skip=migration,model,controllers,api_controller,scaffold_controller,scaffold_requests,routes,api_routes,scaffold_routes,views,tests,menu,dump-autoload ');// 
fputs($archivo,chr(13).chr(10));
fclose($archivo); // cierra el archivo

//***************************************************************************
        $filexls=$filename;       
        $filejson='fields_'.$sheetname.'.json';       
        $filetxt='exec_'.$sheetname.'.txt';
        
        Flash::success('Carga de archivo correcta en: box/codegen/');            
            return view('codegen.index')
            ->with('filexls',$filexls)
            ->with('filejson',$filejson)
            ->with('filetxt',$filetxt);
        }
        else{
        $filename=$file->getClientOriginalName();  
        Flash::error('El archivo: '.$filename.' NO es un archivo valido.');
            return view('codegen.index');
        }
     }
     else{        
        Flash::error('No se selecciono ningun archivo.'); 
               return view('codegen.index');
     }   
         return view('codegen.index');
     }






     
}
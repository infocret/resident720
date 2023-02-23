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

class unidimportController extends AppBaseController
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
         return view('unidades.selfile');            
     }

//******************************************************************************
public function upfile(Request $request)  {

// si el reques trae un archivos              ==============================================
if ($request->hasfile('Archivo')){   
    $file=$request->file('Archivo');         // otiene archivo del request
    $mime = $file->getClientMimeType();
    
    // valida si es un archivo de excell      %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    if  ($mime == "application/vnd.ms-excel" || $mime == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ){

        //***********************************************************************************
        $filename=$file->getClientOriginalName(); //obtiene el nombre del archivo
        // lo guarda en carpeta pubic/box                              
        $path = $file->storeAs('/codegen/',$filename,'publicbox');  
        //***********************************************************************************
        //                Carga / lee / parsea el archivo de excell
        // https://phpspreadsheet.readthedocs.io/en/develop/topics/accessing-cells/
        //***********************************************************************************
        $inputFileName ='box/codegen/'.$filename;       // asigna ruta y nombre de archivo        
        $spreadsheet = IOFactory::load($inputFileName); // lee el archivo
        $WorkSheet = $spreadsheet->getSheetByName('ListaUnidades'); // lee hoja de trabajo
        //$col = 1; // 1 - 18 A - R
        $row = 2; // 2 - null
        $condominioexpid = Session('condominioexpid');  // inmuid tinyint,        
        $cve = "" ;     // clave del departamento
        $cveant = "";   // para controlar repetidos
        $unids = 0;
        // Create new stdClass Object
        $obja = new \stdClass();


        do {    
            // Ciclo FOR barre columnas de : 1 a 18 - A a R
            //for ($col = 1; $col <19; $col++) {// ################################################# 
            $paramarray = array();     // Declara un array para parametros de procedimiento
            $val = $WorkSheet->getCell('A'.$row)->getValue();   //cve    
            $cve =  $val;

            // si no es nulo y es diferente a la anterior
            if  ( ! is_null($cve) && $cve != $cveant ){

                $cveant = $cve ;                                    // control repetidos
                array_push($paramarray,$condominioexpid);           //id de condominio                
                array_push($paramarray,"2");                        //tipo - departamento
                array_push($paramarray,$val);                       //ident
                
                $val = $WorkSheet->getCell('B'.$row)->getValue();   //numero
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //nombre
                array_push($paramarray,$val);                       //descripcion

                $val = $WorkSheet->getCell('C'.$row)->getValue();   //referencia Bancaria
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //referencia Bancaria

                $val = $WorkSheet->getCell('F'.$row)->getValue();   //nombre propietario
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //nombre propietario

                $val = $WorkSheet->getCell('G'.$row)->getValue();   //appat propietario
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //appat propietario

                $val = $WorkSheet->getCell('H'.$row)->getValue();   //apmat propietario
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //apmat propietario

                $val = $WorkSheet->getCell('I'.$row)->getValue();   //email propietario
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //email propietario

                $val = $WorkSheet->getCell('J'.$row)->getValue();   //tel propietario
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //tel propietario

                $val = $WorkSheet->getCell('K'.$row)->getValue();   //enviar recibos propietario
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //enviar recibos propietario
                array_push($paramarray,$val);                       //enviar noticias propietario

                $val = $WorkSheet->getCell('L'.$row)->getValue();   //miembro comite
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //miembro comite

                $val = $WorkSheet->getCell('M'.$row)->getValue();   //nombre inquilino
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //nombre inquilino

                $val = $WorkSheet->getCell('N'.$row)->getValue();   //appat inquilino
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //appat inquilino

                $val = $WorkSheet->getCell('O'.$row)->getValue();   //apmat inquilino
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //apmat inquilino

                $val = $WorkSheet->getCell('P'.$row)->getValue();   //email inquilino
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //email inquilino

                $val = $WorkSheet->getCell('Q'.$row)->getValue();   //tel inquilino
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //tel inquilino

                $val = $WorkSheet->getCell('R'.$row)->getValue();   //enviar recibos inquilino
                $val = $this->verifica($val);                                
                array_push($paramarray,$val);                       //enviar recibos inquilino
                array_push($paramarray, $val);                      //enviar noticias inquilino

                $unids += 1;
                $obja->$unids = $paramarray;  //Agrega al objeto para validaciones
                
                // Inserta la unidad por medio de sp_iUnidad
                $unidadstatus = $this->inmuebleRepository->saveUnidad($paramarray);
                //dd($unidadstatus);        
            }
            //} // Fin de ciclo For que barre columnas ########################################## 
            unset( $paramarray);            
            $row += 1;
        } while ( ! is_null($cve) );
        //***************************************************************************
        //dd($obja);
        $row = $row - 2;
        //if ($unidadstats="OK"){
        Flash::success('Carga de '. $unids . ' unidades en '. $row . ' filas analizadas, revise sus datos');            

        return redirect(route('unidades.index', $condominioexpid ));
       
    // ELSE de si es un archivo de excell     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    } else {
        $filename=$file->getClientOriginalName();  
        Flash::error('El archivo: '.$filename.' NO es un archivo valido.');
        return view('unidades.selfile');
    } // Fin de si es un archivo de excell     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%    

// ELSE de si el reques trae un archivo       ==============================================
} else {        
    Flash::error('No se selecciono ningun archivo.'); 
    return view('unidades.selfile');
} // Fin // si el reques trae un archivo      ==============================================
    return view('unidades.selfile');

} // fin del metodo


public function verifica( $valor ) {
$valr = $valor;
$valor = strtoupper($valor);

if ($valor =='' 
    || is_null($valor) 
    || strlen(str_replace (" ","",$valor))<1     
    || $valor == "NO"
    || $valor == "0" ) {
    $valr = "N/A";
}

if (str_replace (" ","",$valr) == "n/a"){
     $valr = "N/A";
}

return $valr;
}



}//Fin de la clase

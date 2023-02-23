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

class personimportController extends AppBaseController
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
         $condominios = $this->inmuebleRepository->gCondominios();
         //dd($condominios);
         return view('personas.selfile')
         ->with('condominios',$condominios);            
     }

//******************************************************************************
public function upfile(Request $request)  {
$condid = $request->linmuebles;          // otiene id de condominio
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
        //$condominioexpid = Session('condominioexpid');  // inmuid tinyint,        
        $cve = "" ;     // clave del departamento
        $cveant = "";   // para controlar repetidos
        $npers = 0;
        // Create new stdClass Object
        $obja = new \stdClass();


        do {    
            // Ciclo FOR barre columnas de : 1 a 18 - A a R
            //for ($col = 1; $col <19; $col++) {// ################################################# 
            
            
            $val = $WorkSheet->getCell('A'.$row)->getValue();   //cve    
            $cve =  $val;

             $val = $WorkSheet->getCell('E'.$row)->getValue();   //Cuota
             $cuota = $this->verifica($val);   

            // dd($row.'-'.$cve.'-'.$cuota);

            // si no es nulo y tiene cuota
            if  ( ! is_null($cve) && $cuota == 'N/A' ){    
                $paramarray = array(); // Array para parametros de procedimiento                           
              
                $cveant = $cve ;                           // control repetidos
                array_push($paramarray,$condid);           //id de condominio                
                
                array_push($paramarray,$cve);                       //ident                
                
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

                array_push($paramarray,1);              //tiporel - propietario              

                $npers += 1;
                $obja->$npers = $paramarray;  //Agrega al objeto para validaciones
                //dd($paramarray);
                // Inserta persona como propietario solo si hay nombre
                if ($paramarray[2] != 'N/A') {
                  $unidadstatus = $this->inmuebleRepository->iPersonas($paramarray);
                }

                unset( $paramarray);  

                $paramarray = array(); // Array para parametros de procedimiento                           
                
                array_push($paramarray,$condid);      //id de condominio             
                array_push($paramarray,$cve);         //ident                    

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
                
                array_push($paramarray,'N/A');                       //miembro comite
                array_push($paramarray,2);                           //tiporel -Inquilino

                $npers += 1;
                $obja->$npers = $paramarray;  //Agrega al objeto para validaciones

                //dd($paramarray);
                // Inserta la unidad por medio de sp_iUnidad
                if ($paramarray[2] != 'N/A') {
                  $unidadstatus = $this->inmuebleRepository->iPersonas($paramarray);
                }              
                
                }            
            
            unset( $paramarray);            
            $row += 1;
        } while ( ! is_null($cve) );
        //***************************************************************************
        //dd($obja);
        $row = $row - 2;
        //if ($unidadstats="OK"){
        Flash::success('Carga de '. $npers . ' personas en '. $row . ' filas analizadas, revise sus datos');            

        return redirect(route('personas.index'));
       
    // ELSE de si es un archivo de excell     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    } else {
        $filename=$file->getClientOriginalName();  
        Flash::error('El archivo: '.$filename.' NO es un archivo valido.');
        return view('personas.selfile');
    } // Fin de si es un archivo de excell     %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%    

// ELSE de si el reques trae un archivo       ==============================================
} else {        
    Flash::error('No se selecciono ningun archivo.'); 
    return view('personas.selfile');
} // Fin // si el reques trae un archivo      ==============================================
    return view('personas.selfile');

} // fin del metodo



//******************************************************************************
//******************************************************************************
//******************************************************************************

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

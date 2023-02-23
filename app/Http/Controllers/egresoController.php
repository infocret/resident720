<?php

namespace App\Http\Controllers;

// use App\Http\Requests\CreateheadmovRequest;
// use App\Http\Requests\UpdateheadmovRequest;
use App\Http\Requests\CreateinmuchargeRequest;
use App\Http\Requests\UpdateinmuchargeRequest;
use App\Http\Requests\CreateinmumovtoRequest;
use App\Http\Requests\UpdateinmumovtoRequest;

use App\Repositories\inmuchargeRepository;      // cargos aplicados
use App\Repositories\inmumovtoRepository;       // movimientos aplicados 

use App\Repositories\inmuebleRepository;        // consulta inmuebles
use App\Repositories\conceptserviceRepository;  // consulta concepto/servicios
use App\Repositories\catmovtoRepository;        // consulta tipos de movimiento de egresos
use App\Repositories\propertyareasRepository;   // consulta areas
use App\Repositories\providersRepository;       // consulta proveedores
use App\Repositories\measurunitRepository;      // consulta unidades de medida
use App\Repositories\unidadmovtoRepository;     // consulta contratos


use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Carbon\Carbon;
use App\Traits\GenFolio;                        // Genera Folio

class egresoController extends AppBaseController
{
    /** @var  headmovRepository */
    private $headmovRepository;

    public function __construct(
        inmuchargeRepository $inmuchargeRepo,
        inmumovtoRepository $inmumovtoRepo,
        inmuebleRepository $inmuebleRepo,
        conceptserviceRepository $conceptserviceRepo,
        catmovtoRepository $catmovtoRepo,
        propertyareasRepository $propertyareasRepo,
        providersRepository $providersRepo,
        measurunitRepository $measurunitRepo,
        unidadmovtoRepository $unidadmovtoRepo
        )
    {
        $this->inmuchargeRepository = $inmuchargeRepo;
        $this->inmumovtoRepository = $inmumovtoRepo;
        $this->inmuebleRepository = $inmuebleRepo;
        $this->conceptserviceRepository = $conceptserviceRepo;
        $this->catmovtoRepository = $catmovtoRepo;
        $this->propertyareasRepository = $propertyareasRepo;
        $this->providersRepository = $providersRepo;
        $this->measurunitRepository = $measurunitRepo;
        $this->unidadmovtoRepository = $unidadmovtoRepo; 
    }
use GenFolio;
//******************************************************************************************
// /**
// *    Presenta vista para seleccionar fechas 
// *    de periodo de consulta de egresos.   
// *    @param  condomid -inmuebles.id - condominio id
// *    @return  Response
// */
//  public function selperiod($condomid)
//  {
//     $dfrom  = carbon::now()->startOfMonth()->toDateString();
//     $dto    = carbon::now()->endOfMonth()->toDateString();
//     //$unids = $this->inmuebleRepository->gInmuUnidades($condomid);
//     //$concepservs = $this->conceptserviceRepository->all();
   
//      return view('egresos.selperiod')
//     ->with('condomid',$condomid)
//     ->with('dfrom',$dfrom)
//     ->with('dto',$dto)   
//     ;
//  }
//******************************************************************************************
//  /**
// *    Recibe las fechas seleccionadas y llama a la consulta
// *    @return  Response
// */
// public function sendperiod(Request $request)
// {
//     //dd($request->all());   

//   // "_token" => "bsauMUVpiVMPieSn7bRMIXAxsYCr84T3gB54GQIG"
//   // "dfrom" => "2020-06-01"
//   // "dto" => "2020-06-30"
//   // "condomid" => "68"
//   // "folio" => null

//     $dfrom      = $request->dfrom;
//     $dto        = $request->dto;
//     $condomid   = $request->condomid;
//    // $unidid     = $request->unidadid;
//     $folio      = $request->folio;   
//    // $conceptservid = $request->conceptserv_id ;
//    //dd($flong);    
//   return redirect(route('egresos.indexb',[$condomid,$dfrom,$dto]));
    
// }
//******************************************************************************************
// /**
//  * Display a listing of the egresos.
//  *
//  * @param Request $request
//  * @return Response
//  */
//     public function indexb(Request $request,$condomid,$dfrom,$dto)
//     {

//     $egresos = $this->inmuebleRepository->getegresos($condomid,$dfrom,$dto);
        
//     return view('expededocta.indexe')
//            ->with('egresos', $egresos)
//            ;

//     }
//******************************************************************************************
    /**
     * Muestra formulario para crear registro de Egreso,un gasto del presupuesto del condominio.
     *
     * @return Response
     */
    public function create()    
    {   
       $condomid = Session('condominioexpid'); 
       $condomname = Session('condonomexp');         
       //consulta unidades y condominio para select        
       $inmuebles = $this->inmuebleRepository->gselUnidadesB($condomid);         
       //consulta area de propiedades para select       
       $PropertyAreas = $this->propertyareasRepository->gAreasB($condomid);        
       //consulta proveedores para select       
       $Providers = $this->providersRepository->gprovs();                       
       //consulta conceptos/servicios
       $Concepts = $this->conceptserviceRepository->gconcepts($condomid);        
       // Genera fecha del dia para campo created_at
       $fechareg=Carbon::now()->setTime(0,0)->format('Y-m-d');        
       //consulta unidades de medida
       $Unidades = $this->measurunitRepository->gunidmedb();    
       //consulta tipos de movimientos  para select       
       $tipomov   ='E'; // Define que se buscaran movimientos tipo "E" -  egreso 
       $conceptid = 6 ; // Define que los movtos esten relacionados a concepto 6 - egresos
       //$TiposMovtos = $this->catmovtoRepository->getmovegresos($condomid);             
       $TiposMovtos  = $this->unidadmovtoRepository->
       gmovtoscontratob($condomid,$tipomov,$conceptid);        
       
        return view('egresos.create')
        ->with('fechareg',$fechareg) 
        ->with('condomid',$condomid)
        ->with('condomname',$condomname)
        ->with('inmuebles',$inmuebles)
        ->with('PropertyAreas',$PropertyAreas)
        ->with('Providers',$Providers)       
        ->with('TiposMovtos',$TiposMovtos)
        ->with('Concepts',$Concepts)
        ->with('Unidades',$Unidades)
        ;
    }
 /**
     * Guarda registro de egresos o cargos
     *
     * @param CreateinmuchargeRequest $request
     *
     * @return Response
     */
    public function store(CreateinmuchargeRequest $request)
    {            
    $input = $request->all();   
    //dd($input['date']);
    
    //######  Crea array de input de inmucharge #######
    $inputch = array(  
     'inmu_id'          => $input['inmu_id'],
     'conceptserv_id'   => $input['conceptserv_id'],
     'proparea_id'      => $input['proparea_id'],
     'provider_id'      => $input['provider_id'],
     'date'             => $input['date'],
     'folio'            => $input['folio'],
     'stotal'           => $input['stotal'],
     'iva'              => $input['iva'],
     'balance'          => $input['balance'],
     'status'           => $input['status'],
     'description'      => $input['description'],
     'observ'           => $input['observ'],
     'filelink'         => $input['filelink']
             );      
    //dd($inputch);
    //###### Inserta en inmucharge #######        
    $chargereg = $this->inmuchargeRepository->create($inputch);
    $chargeid  = $chargereg->id;
    //dd($chargeid);    
    //###### Busca Cve de cargo/serv inmucharge  ######
    $Concept = $this->conceptserviceRepository->gconcbyid($inputch['conceptserv_id']); 

    //###### LLama a funcion que genera folio (gfolio) del trait GenFolio ######
    $newFolio = $this->gfolio(
        $inputch['inmu_id'],
        $inputch['date'],
        $inputch['balance'],
        $Concept->cve,
        $chargeid,
        1
    );
    // dd($newFolio);    
//************************************************************************************      
    // ###### Guarda archivo si se cargo alguno #######
    if ($request->hasfile('Archivo')){   
    $file=$request->file('Archivo');         // otiene archivo del request
        // valida si es un archivo PDF
        if  ($file->getClientMimeType()=="application/pdf"){
            //$filename=$file->getClientOriginalName(); //obtiene el nombre del archivo
            //Toma la parte entera del gran total para nombre de archivo            
            $filename=$newFolio.".pdf";
            // lo guarda en carpeta pubic/box                              
            $path = $file->storeAs('/egfiles/',$filename,'publicbox');
            $filelink = url('box/egfiles/'.$filename); ///Asigna link de archivo 
        }
        else{
            $filelink = 'N/A' ;     
        }        
    }
     else{       
       $filelink = 'N/A' ;
       // Flash::error('No se selecciono ningun archivo.'); 
       // return view('codegen.index');
     } 
//******************************************************************************************     
    //###### Actualiza Folio y Filelink #######
    $inpchupdf   = array('folio' => $newFolio,'filelink' => $filelink);          
    $chargeupdid = $this->inmuchargeRepository->update($inpchupdf, $chargeid);  
    //dd($chargeupdid);
//******************************************************************************************        
        //********** ######### Inserta detalles ########## **********
        // obtene array de cantidad
        $cantidades =  $request->cantidad;              //cantidad
        //dd($cantidades);
         if (!empty($cantidades)){                      //si no esta vacio
            //// Declara Array de elementos de detalles
            //$registrosdet = array();      // para fines de debug      
            // obtiene los arrays de detalles
            $unidades       =  $request->unidad;        //unidad
            $tmovtos        =  $request->tmovto;        //tipo de movimiento
            $descripciones  =  $request->descripcion;   //descripcion
            $precios        =  $request->precio;        //precio
            $subtotales     =   $request->subtotal;     //subtotal
            $claves         = $request->icve;           //cve (oculto)
            $clavesdescs    = $request->icvedesc;       //descripcion de cve (oculto)
            // Genera fecha del dia para campo created_at
            //$fecha = Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s');
            $fecha = $inputch['date'];                  //fecha
            $idx=0;                                     //contador      
        //###### Barre array de detalles ######
        foreach ($cantidades as $val) {
            $canti = $val;                              // asig Cantidad
            // crea array de registro
            $inputdet = array(  
                'inmucharg_id'  => $chargeid,  
                'unidmovto_id'  => $tmovtos[$idx],       
                'catmovto_cve'  => $claves[$idx],  
                'date'          => $fecha,  
                'folio'         => '0000000000000000000000000000',  
                'quantity'      => $canti,  
                'measurunit_id' => $unidades[$idx],  
                'amount'        => $precios[$idx],  
                'balance'       => $subtotales[$idx],  
                'status'        => 'Generado',
                'apmode'        => 'Manual',
                'description'   => $descripciones[$idx],
                'observ'        => $claves[$idx]."-".$clavesdescs[$idx],
                'filelink'      => 'N/A',
                 
             );  
            //dd($inputdet);
            // Anexa el registro a el arreglo de registros
            //array_push($registrosdet,$inputdet); // para fines de debug     
        // ###### Inserta  registro de inmumovto ######
        $inmumovto = $this->inmumovtoRepository->create($inputdet);
        $movtoid = $inmumovto->id;  //Toma id del inmumovto 
        // ###### LLama a funcion que genera folio (gfolio) del trait GenFolio ######
        $newmFolio = $this->gfolio(
            $inputch['inmu_id'],
            $inputdet['date'],
            $inputdet['balance'],
            $inputdet['catmovto_cve'],            
            $movtoid,
            2
        );
        //dd($newmFolio);
        //************************************************************     
        //###### Actualiza Folio y Filelink #######
        $inmumovtoupdf = array('folio' => $newmFolio);          
        $inmumovtoupid = $this->inmumovtoRepository->update($inmumovtoupdf, $movtoid);
        //dd($inmumovtoupid);                       
        $canti=NULL; // limpia vatieble cantidad
        $idx+=1; // incrementa indice
         }   // Fin for each 
         //dd($registrosdet) ; // para fines de debug     
         //// Inserta arreglo de arreglos de inmumovtos para insert multiple
         // $this->detailmovRepository->insertdetails($registrosdet);
         } // fin de si existe array de detalles
//******************************************************************************************     
        Flash::success('Registro guardado correctamente..');
        return redirect(route('egresos.selperiod',[$input['inmu_id']]));
    }
//******************************************************************************************





//******************************************************************************************
// ################ Procedimientos que son llamados desde inmuegresos.js ##################
 public function getareas(Request $request, $inmueble)
    {          
        if ($request->ajax()){            
            $areas = $this->propertyareasRepository->gAreasC($inmueble);
            return response()->json($areas); 
        } 
        else
        {
            $areas = $this->propertyareasRepository->gAreasC($inmueble);
            dd($areas);

        }    

    }    
 public function getconcepts(Request $request, $inmueble)
    {
        if ($request->ajax()){            
           $concepts = $this->conceptserviceRepository->gconcepts($inmueble);        
            return response()->json($concepts); 
        } 
        else
        {
            $concepts = $this->conceptserviceRepository->gconcepts($inmueble);
            dd($concepts);
        }           
    } 

public function getmovtos(Request $request, $inmuid, $conceptservid)
{
    $tinmu = $this->inmuebleRepository->gtipo($inmuid);    
    if ($tinmu == 1)
    { $tipmov = 'E';} 
    else
    { $tipmov = 'C';}


    if ($request->ajax()){    
    $movtos  = $this->unidadmovtoRepository->gmovtoscontratob($inmuid,$tipmov,$conceptservid);   
    return response()->json($movtos); 
    }
    else 
    {
    $movtos  = $this->unidadmovtoRepository->gmovtoscontratob($inmuid,$tipmov,$conceptservid);
    dd($movtos);
    }    

}


// public function genfolio($inmuid,$chdate,$amount,$concepcve,$chargeid,$digit)
// {


// //###### Arma fecha de cargo  ########
// $tfecha = Carbon::parse($chdate);
// $mfecha = $tfecha->month;
// $dfecha = $tfecha->day;
// $afecha = $tfecha->year;
// $afecha = substr($afecha,2,2);    
// //###### Quita punto a monto  #######
// $fcuanto = str_replace('.', '', $amount );   
// //###### Genera Folio de 28 caracteres #######        
//     // Arma Folio 28 caracteres
//     // 3 inmuebleid     1-3
//     // 6 fecha          4-9
//     // 7 monto          10-16
//     // 2 decmales       17-18
//     // 4 cargocve       19-22
//     // 5 inmuchargid    23-27
//     // 1 1/2            28
//     // 069 191010 000330200 1111 00001 2
//     //   3      6         9    4     5 1    Tot: 28 
//     //0691910100003302001111000012
//     //123 456789 0123456 78 9012 34567 8
//     $newFolio = str_pad($inmuid, 3, "0", STR_PAD_LEFT);                //inmu_id
//     $newFolio = $newFolio.str_pad($afecha, 2, "0", STR_PAD_LEFT);      //año
//     $newFolio = $newFolio.str_pad($mfecha, 2, "0", STR_PAD_LEFT);      //mes
//     $newFolio = $newFolio.str_pad($dfecha, 2, "0", STR_PAD_LEFT);      //dia
//     $newFolio = $newFolio.str_pad($fcuanto, 9, "0", STR_PAD_LEFT);     //monto-balance  
//     $newFolio = $newFolio.str_pad($concepcve, 4, "0", STR_PAD_LEFT);   //cargocve
//     $newFolio = $newFolio.str_pad($chargeid, 5, "0", STR_PAD_LEFT);    //inmuch_id - inmumovto_id
//     $newFolio = $newFolio.$digit;                                      //digito 
//     //dd($newFolio); 
//     return $newFolio;   
// }




} //cierre de clase controller
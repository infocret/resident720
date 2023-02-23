<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateheadmovRequest;
use App\Http\Requests\UpdateheadmovRequest;
use App\Repositories\headmovRepository;

use App\Repositories\inmuchargeRepository;      // cargos aplicados
use App\Repositories\inmumovtoRepository;       // movimientos aplicados 

use App\Http\Requests\CreatedetailmovRequest;
use App\Http\Requests\UpdatedetailmovRequest;
use App\Repositories\detailmovRepository;

use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use Carbon\Carbon;


class inmumovimientoController extends AppBaseController
{
    /** @var  headmovRepository */
    private $headmovRepository;

    public function __construct(
        headmovRepository $headmovRepo,
        detailmovRepository $detailmovRepo
        )
    {
        $this->headmovRepository = $headmovRepo;
        $this->detailmovRepository = $detailmovRepo;
    }
//******************************************************************************************
//******************************************************************************************
    /**
     * Display a listing of the headmov.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->headmovRepository->pushCriteria(new RequestCriteria($request));
        //$headmovs = $this->headmovRepository->paginate(15);
        
        // Visualizacion de Campos en Vista
        $ver = array(  
             'id' => 0,
             'cve' => 1,              
             'inmunombre' => 1,
             'area' => 1,
             'provider' => 1,
             'fechaplica' => 1,
             'fechafact' => 1,
             'folio' => 1,
             'subtotal' => 1,
             'iva' => 1,
             'gtotal' => 1,
             'doc' => 0
             );  
        
        //Parametros para filtrado en Store Procedure 
         $pinmuid = 0;
         $apfeini = "'20180101'"; 
         $apfefin = "'20991231'"; 
         $fcfeini = "'20180101'"; 
         $fcfin   = "'20991231'"; 
         $fol     = "' '";
         $provid  = 0;  

        $headmovs = $this->headmovRepository
        ->gMovimientos($pinmuid,$apfeini,$apfefin,$fcfeini,$fcfin,$fol,$provid);        

        return view('inmumovs.index')
            ->with('headmovs', $headmovs)
            ->with('ver', $ver)
            ;
    }
//******************************************************************************************
//******************************************************************************************
    /**
     * Show the form for creating a new headmov.
     *
     * @return Response
     */
    public function create()    
    {   
        //consulta inmuebles para select
        $Inmuebles = $this->headmovRepository->gInmuLista(1); 
        
        //consulta tipos de movimientos  para select
        $TiposMovtos = $this->headmovRepository->gTiposMovimiento("E");          
        //consulta area de propiedades para select
        //$PropertyAreas = $this->headmovRepository->gPropertyAreas(1,0);
        //consulta proveedores para select
        $Providers = $this->headmovRepository->gProviders(1);  
        //consulta unidades para select, parametro espacio devuelve todos los tipos
        $Unidades = $this->headmovRepository->gUnidades(""); 
       
        // Genera fecha del dia para campo created_at
        $fechareg=Carbon::now()->setTime(0,0)->format('Y-m-d'); 
       //  dd( $fechareg ) ;  

        return view('inmumovs.create')
        ->with('Inmuebles',$Inmuebles)
        ->with('TiposMovtos',$TiposMovtos)
        //->with('PropertyAreas',$PropertyAreas)
        ->with('Providers',$Providers)       
        ->with('Unidades',$Unidades) 
        ->with('fechareg',$fechareg) 
        ;
    }
//******************************************************************************************
//******************************************************************************************
    /**
     * Store a newly created headmov in storage.
     *
     * @param CreateheadmovRequest $request
     *
     * @return Response
     */
    public function store(CreateheadmovRequest $request)
    {            
    $input = $request->all();   

    //dd($input);
    
//******************************************************************************************      
     // si el reques trae un archivo
    if ($request->hasfile('Archivo')){   
    $file=$request->file('Archivo');         // otiene archivo del request
        // valida si es un archivo PDF
        if  ($file->getClientMimeType()=="application/pdf"){
            //$filename=$file->getClientOriginalName(); //obtiene el nombre del archivo
            //Toma la parte entera del gran total para nombre de archivo             
            $gtotentero = explode(".", $request->gtotal);
            $inmuidceros = str_pad($request->inmueble_id, 4, "0", STR_PAD_LEFT);
            $folioceros = str_pad($request->folio, 6, "0", STR_PAD_LEFT);
            $totalceros = str_pad($gtotentero[0], 8, "0", STR_PAD_LEFT);
            $fnfecha=Carbon::now()->format('YmdHis');               
            $filename=$inmuidceros.$folioceros.$totalceros.$fnfecha.".pdf";
            // lo guarda en carpeta pubic/box                              
            $path = $file->storeAs('/movsfiles/',$filename,'publicbox');
            $input["doc"] = url('box/movsfiles/'.$filename); ///Asigna link de archivo 
        }
    }
     else{       
       // Flash::error('No se selecciono ningun archivo.'); 
       // return view('codegen.index');
     } 
//******************************************************************************************     
        // Inserta la cabecera
        //$headmov = $this->headmovRepository->create($input);    
        $headmov = $this->inmuchargeRepository->create($input);    

//******************************************************************************************           
        // obtene array de cantidad
        $cantidades =  $request->cantidad; 
         if (!empty($cantidades)){
            // Declara Array de elementos de detalles
            $registrosdet = array();
            // obtiene el id del nuevo header
            $hid = $headmov->id;
            // obtiene los arrays de detalles
            $unidades =  $request->unidad; 
            $tmovto =  $request->tmovto; 
            $descripciones =  $request->descripcion; 
            $precios =  $request->precio; 
            $subtotales =  $request->subtotal;
            // Genera fecha del dia para campo created_at
            $fecha=Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s'); 
            $idx=0;
         // Barre array de detalles
         foreach ($cantidades as $val) {
            $canti = $val; // id de categoria
            // crea array de registro
            $inputdet = array(  
                 'headmov_id' => $hid,
                 'movimientoTipo_id' => $tmovto[$idx],              
                 'cantidad' => $canti,
                 'unidad' => $unidades[$idx],
                 'descripcion' =>  $descripciones[$idx],
                 'preciounit' =>  $precios[$idx],
                 'subtot' =>  $subtotales[$idx], 
                 'created_at' => $fecha,
             );  
            // Anexa el registro a el arreglo de registros
            array_push($registrosdet,$inputdet); 
            $canti=NULL; // limpia vatieble cantidad
            $idx+=1; // incrementa indice
         }         
          $this->detailmovRepository->insertdetails($registrosdet);
         }
//******************************************************************************************         
        Flash::success('mov saved successfully.');
        return redirect(route('inmovtos.index'));
    }
//******************************************************************************************
//******************************************************************************************
    /**
     * Display the specified headmov.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            Flash::error('Headmov not found');

            return redirect(route('inmovtos.index'));
        }

        return view('inmumovs.show')->with('headmov', $headmov);
    }
//******************************************************************************************
//******************************************************************************************
    /**
     * Show the form for editing the specified headmov.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $headmov = $this->headmovRepository->findWithoutFail($id);
        //$details = $this->detailmovRepository->findWithoutFail($id);        

        if (empty($headmov)) {
            Flash::error('Headmov not found');

            return redirect(route('inmovtos.index'));
        }
        $details = $this->detailmovRepository->get()->where('headmov_id', $id);        
        //consulta inmuebles para select
        $Inmuebles = $this->headmovRepository->gInmuLista(1);                       
        //consulta tipos de movimientos  para select
        $TiposMovtos = $this->headmovRepository->gTiposMovimiento("E");       
        //consulta area de propiedades para select
        $PropertyAreas = $this->headmovRepository->gPropertyAreas(1, $headmov->inmueble_id);        
        //consulta proveedores para select
        $Providers = $this->headmovRepository->gProviders(1);  
        //consulta unidades para select, parametro espacio devuelve todos los tipos
        $Unidades = $this->headmovRepository->gUnidades(""); 
        // Genera fecha del dia para campo created_at
        //$fechareg=Carbon::now()->setTime(0,0)->format('Y-m-d');       

        return view('inmumovs.edit')
        ->with('headmov', $headmov)
        ->with('details', $details)
        ->with('Inmuebles',$Inmuebles)
        ->with('TiposMovtos',$TiposMovtos)
        ->with('PropertyAreas',$PropertyAreas)
        ->with('Providers',$Providers)       
        ->with('Unidades',$Unidades)                 
        ;
    }
//******************************************************************************************
//******************************************************************************************
    /**
     * Update the specified headmov in storage.
     *
     * @param  int              $id
     * @param UpdateheadmovRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateheadmovRequest $request)
    {
        $headmov = $this->headmovRepository->findWithoutFail($id);
        //dd($request->all());               
        if (empty($headmov)) {
            Flash::error('Headmov not found');

            return redirect(route('inmovtos.index'));
        }
//******************************************************************************************
        // validar si trae archivo nuevo  
        if ($request->hasfile('Archivo') ){   
        $file=$request->file('Archivo');         // otiene archivo del request
        // valida si es un archivo PDF
        if  ($file->getClientMimeType()=="application/pdf"){
            //$filename=$file->getClientOriginalName(); //obtiene el nombre del archivo
            //Toma la parte entera del gran total para nombre de archivo             
            $gtotentero = explode(".", $request->gtotal);
            $inmuidceros = str_pad($request->inmueble_id, 4, "0", STR_PAD_LEFT);
            $folioceros = str_pad($request->folio, 6, "0", STR_PAD_LEFT);
            $totalceros = str_pad($gtotentero[0], 8, "0", STR_PAD_LEFT);
            $fnfecha=Carbon::now()->format('YmdHis');               
            $filename=$inmuidceros.$folioceros.$totalceros.$fnfecha.".pdf";
            // lo guarda en carpeta pubic/box                              
            $path = $file->storeAs('/movsfiles/',$filename,'publicbox');
            $input["doc"] = url('box/movsfiles/'.$filename); ///Asigna link de archivo 
            }
        }                 
//******************************************************************************************
        // validar si hay que borrar archivo y borrarlo
        $deletefile=$request->deldoc;
        if ($deletefile!="ninguno"){
            if (file_exists($deletefile)) {
                if (unlink($deletefile)) {
                    //Flash::success(
                    //'Se elimino el registro y el archivo de imagen.');
                }
            }

        }
//******************************************************************************************        
        // Busca los detalles relacionados a esta cabecera
        // por medio de la relacion hasmany, coloca en un array solo los ids
        $details=$headmov->detailmov()->pluck('id')->toarray();
        // Si encontro detalles
        if (!empty($details)){
        // llama al metodo de eliminacion de la tabla details  
         $this->detailmovRepository->deletedetails($details);
        }
//******************************************************************************************        
        // actualizar registro de cabecera
        $headmov = $this->headmovRepository->update($request->all(), $id);    
//******************************************************************************************            
        // obtene array de cantidad
        $cantidades =  $request->cantidad; 
         if (!empty($cantidades)){
            // Declara Array de elementos de detalles
            $registrosdet = array();
            // obtiene el id del  header
            $hid = $headmov->id;
            // obtiene los arrays de detalles
            $unidades =  $request->unidad; 
            $tmovto =  $request->tmovto; 
            $descripciones =  $request->descripcion; 
            $precios =  $request->precio; 
            $subtotales =  $request->subtotal;
            // Genera fecha del dia para campo created_at
            $fecha=Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s'); 
            $idx=0;
         // Barre array de detalles
         foreach ($cantidades as $val) {
            $canti = $val; // id de categoria
            // crea array de registro
            $inputdet = array(  
                 'headmov_id' => $hid,
                 'movimientoTipo_id' => $tmovto[$idx],              
                 'cantidad' => $canti,
                 'unidad' => $unidades[$idx],
                 'descripcion' =>  $descripciones[$idx],
                 'preciounit' =>  $precios[$idx],
                 'subtot' =>  $subtotales[$idx], 
                 'created_at' => $fecha,
             );  
            // Anexa el registro a el arreglo de registros
            array_push($registrosdet,$inputdet); 
            $canti=NULL; // limpia vatieble cantidad
            $idx+=1; // incrementa indice
         } 
          $this->detailmovRepository->insertdetails($registrosdet);
         }         
  //******************************************************************************************
        Flash::success('Headmov updated successfully.');

        return redirect(route('inmovtos.index'));
}
//******************************************************************************************
//******************************************************************************************
    /**
     * Remove the specified headmov from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            Flash::error('Headmov not found');

            return redirect(route('inmovtos.index'));
        }
//******************************************************************************************        
        // Busca los detalles relacionados a esta cabecera
        // por medio de la relacion hasmany, coloca en un array solo los ids
        $details=$headmov->detailmov()->pluck('id')->toarray();
        // Si encontro detalles
        if (!empty($details)){
        // llama al metodo de eliminacion de la tabla details  
         $this->detailmovRepository->deletedetails($details);
        }
//******************************************************************************************           

        $this->headmovRepository->delete($id);

        Flash::success('Headmov deleted successfully.');

        return redirect(route('inmovtos.index'));
    }
//******************************************************************************************
//******************************************************************************************
 public function getareas(Request $request, $inmueble)
    {
        if ($request->ajax()){
            $areas= $this->headmovRepository->gPropertyAreas(1,$inmueble);            
            return response()->json($areas); 
        } 
           //$areas= $this->headmovRepository->gPropertyAreas(1,$inmueble);            
           //dd($areas);
           //return response()->json($areas);      
    }    
}
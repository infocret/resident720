<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepropertyvalueRequest;
use App\Http\Requests\UpdatepropertyvalueRequest;
use App\Repositories\propertyvalueRepository;
use App\Repositories\propertyparameterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class inmuindivisoController extends AppBaseController
{
    /** @var  propertyvalueRepository */
    private $propertyvalueRepository;

    public function __construct(
        propertyvalueRepository $propertyvalueRepo,
        propertyparameterRepository $propertyparameterRepo)
    {
        $this->propertyvalueRepository = $propertyvalueRepo;
        $this->propertyparameterRepository = $propertyparameterRepo;
    }

    /**
     * Muestra indivisos de unidades deun condominio
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,$inmuid)
    {
        $this->propertyvalueRepository->pushCriteria(new RequestCriteria($request));
        $indivisos = $this->propertyvalueRepository->gIndivlUnids($inmuid);
        $indivedit = $this->propertyparameterRepository->gValParam($inmuid,'indivedit');           

        return view('inmuindivisos.index')
            ->with('indivisos', $indivisos)
             ->with('inmuid',$inmuid)
             ->with('indivedit',$indivedit);
    }

  
    /**
     * Muestra indivisos de una unidad
     *
     * @param Request $request
     * @return Response
     */
    public function uindex(Request $request,$inmuid)
    {
        $this->propertyvalueRepository->pushCriteria(new RequestCriteria($request));
        $uindivisos = $this->propertyvalueRepository->gIndivlUnid($inmuid);
        //dd($indivisos);

        return view('inmuindivisos.index')
            ->with('uindivisos', $uindivisos)
            ->with('inmuid',$inmuid);
    }
    /**
     * Show the form for creating a new propertyvalue.
     *
     * @return Response
     */
    public function create($inmuid)
    {
        $indivisos = $this->propertyvalueRepository->gIndivlUnids($inmuid);
        $numun = $this->propertyparameterRepository->gValParam($inmuid,'unidades');        
        $indivedit = $this->propertyparameterRepository->gValParam($inmuid,'indivedit');   
        $numunids = intval($numun);
        //dd($numunids);
        
        return view('inmuindivisos.create')
        ->with('indivisos',$indivisos)
        ->with('indivedit',$indivedit)
        ->with('numunids',$numunids)
        ->with('inmuid',$inmuid);
    }

    /**
     * Store a newly created propertyvalue in storage.
     *
     * @param CreatepropertyvalueRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyvalueRequest $request)
    {
        //$input = $request->all();
        //dd($input);
            // array:8 [▼
            //   "_token" => "340LFCnAOHhMyjV8RdRjQFRJSYqQk0Cur8ClrYXn"
            //   "totindiv" => "29.2560"
            //   "editable" => "1"
            //   "condominioid" => "1"
            //   "bsave" => "Guardar"
            //   "propval_id" => array:5 [▼
            //     0 => "1"
            //     1 => "2"
            //     2 => "3"
            //     3 => "4"
            //     4 => "5"
            //   ]
            //   "unidad_id" => array:5 [▼
            //     0 => "2"
            //     1 => "9"
            //     2 => "10"
            //     3 => "11"
            //     4 => "12"
            //   ]
            //   "indiv" => array:5 [▼
            //     0 => "2.12500000"
            //     1 => "2.52121500"
            //     2 => "25.00000000"
            //     3 => "0.01"
            //     4 => "0.01"
            //   ]
            // ]

        //Obtiene los arreglos del request
        $propval_id =  $request->propval_id;    //array de id de porperty values
        //$unidad_id =   $request->unidad_id;     //array de unidad id's
        $indiv =  $request->indiv;              //array de valores de indiviso         
        $editable = $request->editable;         // Si esta el check de editable
        $inmuid =  $request->condominioid;      // id del condominio 
        $indivtot = $request->totindiv;         // Total de la sumatoria de indivisos                       
       
        $idx = 0;                               //indice

        //Obtiene el registro de parametro = 'indiv1tot' y de si es editable
        $totalindiviso = $this->propertyparameterRepository->gParametro($inmuid,'indiv1tot');
        $indivedit = $this->propertyparameterRepository->gParametro($inmuid,'indivedit');
        
        // si viene vacio es que el indiv1tot presupuesto no esta definido en BD
        if ($totalindiviso->count()<1){
            //Asigna un 0, como id  
            $tid=0;                             
         }
         else{
            // obtiene el id del primer elemento de la colleccion    
            $tid = $totalindiviso[0]->id;         
         }   

        // si viene vacio es que el parametro de editable no esta definido en BD
        if ($indivedit->count()<1){
            //Asigna un 0, como id  
            $edid=0;                             
         }
         else{
            // obtiene el id del primer elemento de la colleccion    
            $edid = $indivedit[0]->id;         
         }   
                // ****** Modelo: propertyvalue ******
                // 'inmueble_id',
                // 'area',
                // 'porcentaje',
                // 'valor',
                // 'presupuesto',
                // 'cuota',
                // 'indiv1',
                // 'indiv2',
                // 'indiv3',
                // 'indiv4',
                // 'indiv5',
                // 'param1',
                // 'param2',
                // 'param3' 
        // Barre arreglos de request (el arreglo de ids de propertyvalues)
        foreach ($propval_id as $id) {   
            // crea  registro a actualizar solo el campo a actualizar y Ejecuta Update 
            $propval = $this->propertyvalueRepository->update(['indiv1' => $indiv[$idx]] , $id);
            $idx+=1; // incrementa indice
         }      
     
        // Actualiza / Crea el total del indiviso
        if ($tid==0){
            //Crea            
            $paramp = $this->propertyparameterRepository->insertaparam($inmuid,'indiv1tot',$indivtot);
         }
         else{
            //Actualiza
            $paramp = $this->propertyparameterRepository->update(['valor' => $indivtot],$tid);
         }

        // Si el request de editable viene vacio o es null
        if (empty($editable)){
            $editable = '0';
        }    
        else{
            $editable = '1';
        }
        
         // Actualiza / Crea el parametro de si es editable el presupuesto
        if ($edid==0){
            //Crea            
            $paramp = $this->propertyparameterRepository->insertaparam($inmuid,'indivedit',$editable);
         }
         else{
            //Actualiza
            $paramp = $this->propertyparameterRepository->update(['valor' => $editable],$edid);
         }

        //$propertyvalue = $this->propertyvalueRepository->create($input);

        Flash::success('Indivisos1 Actualizados.');


        return redirect(route('indivisos.index',$inmuid));
    }
//*****************************************************************************************       
//*****************************************************************************************       
//***************************** C U O T A S ***********************************************       
//*****************************************************************************************       
//*****************************************************************************************       
    /**
     * Muestra las Cuotas de unidades o Genera Cuotas a Unidades
     *
     * @param Request $request
     * @return Response
     */
    public function cuotasidx(Request $request,$inmuid)
    {
        $this->propertyvalueRepository->pushCriteria(new RequestCriteria($request));
        $cuotas = $this->propertyvalueRepository->gCuotasUnids($inmuid);
        //dd($cuotas);
        $presupuesto = $this->propertyparameterRepository->gValParam($inmuid,'presupuesto');   
        $tcuotas = $this->propertyparameterRepository->gValParam($inmuid,'cuotas');     
        $cuotedit = $this->propertyparameterRepository->gValParam($inmuid,'cuotasedit');           

        return view('inmuindivisos.indexc')
            ->with('cuotas', $cuotas)
            ->with('presupuesto',$presupuesto)
            ->with('tcuotas',$tcuotas)
            ->with('inmuid',$inmuid)
            ->with('cuotedit',$cuotedit);
    }

 /**
     * Muestra la vista de edicion y generacion de cuotas
     *
     * @return Response
     */
    public function ccreate($inmuid)
    {        
        //$cuotas = $this->propertyvalueRepository->gCreaCuotas($inmuid);
        $cuotas = $this->propertyvalueRepository->gCuotasUnids($inmuid);
        $presupuesto = $this->propertyparameterRepository->gValParam($inmuid,'presupuesto'); 
        $tcuotas = $this->propertyparameterRepository->gValParam($inmuid,'cuotas');          
        $cuotedit = $this->propertyparameterRepository->gValParam($inmuid,'cuotasedit'); 
        //dd($cuotas);
        
        return view('inmuindivisos.ccreate')
        ->with('cuotas',$cuotas)
        ->with('presupuesto',$presupuesto)
        ->with('tcuotas',$tcuotas)
        ->with('inmuid',$inmuid)
        ->with('cuotedit',$cuotedit)
        ;
    }

 /**
     * Store a newly created propertyvalue in storage.
     *
     * @param CreatepropertyvalueRequest $request
     *
     * @return Response
     */
    public function cstore(CreatepropertyvalueRequest $request)
    {
        $input = $request->all();
            // array:6 [▼
            //   "_token" => "y8gKZ7a0BfBzfH4tSHWSOmwRJRwl0qtHkdqlnKgz"
            //   "editable" => "1"
            //   "bsave" => "Guardar"
            //   "propval_id" => array:5 [▼
            //     0 => "1"
            //     1 => "2"
            //     2 => "3"
            //     3 => "4"
            //     4 => "5"
            //   ]
            //   "cuota" => array:5 [▼
            //     0 => "103419.902"
            //     1 => "12025.57"
            //     2 => "2405.114"
            //     3 => "1202.557"
            //     4 => "1202.557"
            //   ]
            //   "totcuotas" => "0"
            //   "condominioid" => "1"
            // ]
        //dd($input);
        
        //Obtiene los arreglos del request
        $editable   = $request->editable;       //Si esta el check de editable
        $propval_id = $request->propval_id;     //array de id de porperty values
        $cuotas     = $request->cuota;          //array de cuotas        
        $tcuotas    = $request->totcuotas;      //Total sumatoria de cuotas 
        $inmuid     = $request->condominioid;   //id del condominio 
       
        $idx = 0;                               //indice

        //Obtiene el registro de parametro = 'indiv1tot' y de si es editable
        
        $cuotedit = $this->propertyparameterRepository->gParametro($inmuid,'cuotasedit');
        $totalcuotas = $this->propertyparameterRepository->gParametro($inmuid,'cuotas');

        // si viene vacio es que el parametro de editable no esta definido en BD
        if ($cuotedit->count()<1){
            //Asigna un 0, como id  
            $edid=0;                             
         }
         else{
            // obtiene el id del primer elemento de la colleccion    
            $edid = $cuotedit[0]->id;         
         }   

         // si viene vacio es que el totalcuotas no esta definido en BD
        if ($totalcuotas->count()<1){
            //Asigna un 0, como id  
            $tid=0;                             
         }
         else{
            // obtiene el id del primer elemento de la colleccion    
            $tid = $totalcuotas[0]->id;         
         }   

                // ****** Modelo: propertyvalue ******
                // 'inmueble_id',
                // 'area',
                // 'porcentaje',
                // 'valor',
                // 'presupuesto',
                // 'cuota',
                // 'indiv1',
                // 'indiv2',
                // 'indiv3',
                // 'indiv4',
                // 'indiv5',
                // 'param1',
                // 'param2',
                // 'param3' 
        
        // Barre arreglos de request (el arreglo de ids de propertyvalues)
        foreach ($propval_id as $id) {   
            // crea  registro a actualizar solo el campo a actualizar y Ejecuta Update 
            $propval = $this->propertyvalueRepository->update(['cuota' => $cuotas[$idx]] , $id);
            $idx+=1; // incrementa indice
         }      

        // Actualiza / Crea el total de sumatoria de cuotas
        if ($tid==0){
            //Crea            
            $paramp = $this->propertyparameterRepository->insertaparam($inmuid,'cuotas',$tcuotas);
         }
         else{
            //Actualiza
            $paramp = $this->propertyparameterRepository->update(['valor' => $tcuotas],$tid);
         }

        // Si el request de editable viene vacio o es null
        if (empty($editable)){
            $editable = '0';
        }    
        else{
            $editable = '1';
        }
        
         // Actualiza / Crea el parametro de si es editable el presupuesto
        if ($edid==0){
            //Crea            
            $paramp = $this->propertyparameterRepository->insertaparam($inmuid,'cuotasedit',$editable);
         }
         else{
            //Actualiza
            $paramp = $this->propertyparameterRepository->update(['valor' => $editable],$edid);
         }

        //$propertyvalue = $this->propertyvalueRepository->create($input);

        Flash::success('Cuotas Actualizadas.');


        return redirect(route('indivisos.cuotasidx',$inmuid));
    }

//*****************************************************************************************       
//*****************************************************************************************       
//***************************** F I N  C U O T A S ****************************************       
//*****************************************************************************************       
//***************************************************************************************** 



    /**
     * Display the specified propertyvalue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,$inmuid)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('indivisos.index',$inmuid));
        }

        return view('inmuindivisos.show')
        ->with('propertyvalue', $propertyvalue)
        ->with('inmuid', $inmuid)
        ;
    }

    /**
     * Show the form for editing the specified propertyvalue.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,$inmuid)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);
        $unidcve = $propertyvalue->inmueble->ident;
        $unidnom = $propertyvalue->inmueble->nombre;


        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('indivisos.index',$inmuid));
        }

        return view('inmuindivisos.edit')
        ->with('propertyvalue', $propertyvalue)
        ->with('unidcve', $unidcve)
        ->with('unidnom', $unidnom)
        ->with('inmuid', $inmuid)
        ;
    }

    /**
     * Update the specified propertyvalue in storage.
     *
     * @param  int              $id
     * @param UpdatepropertyvalueRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyvalueRequest $request,$inmuid)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('indivisos.index',$inmuid));
        }

        $propertyvalue = $this->propertyvalueRepository->update($request->all(), $id);

        Flash::success('Propertyvalue updated successfully.');

        return redirect(route('indivisos.index',$inmuid));
    }

    /**
     * Remove the specified propertyvalue from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id,$inmuid)
    {
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            Flash::error('Propertyvalue not found');

            return redirect(route('indivisos.index', $inmuid));
        }

        $this->propertyvalueRepository->delete($id);

        Flash::success('Propertyvalue deleted successfully.');

        return redirect(route('indivisos.index', $inmuid));
    }
}

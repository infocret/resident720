<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepresupuestoRequest;
use App\Http\Requests\UpdatepresupuestoRequest;
use App\Repositories\presupuestoRepository;
use App\Repositories\propertyparameterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class expedpresupuestoController extends AppBaseController
{
    /** @var  presupuestoRepository */
    private $presupuestoRepository;

    public function __construct(presupuestoRepository $presupuestoRepo,
        propertyparameterRepository $propertyparameterRepo)
    {
        $this->presupuestoRepository = $presupuestoRepo;
        $this->propertyparameterRepository = $propertyparameterRepo;
    }

    /**
     * Display a listing of the presupuesto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,$inmuid)
    {
        $this->presupuestoRepository->pushCriteria(new RequestCriteria($request));
        //$presupuestos = $this->presupuestoRepository->all();
        $presupuestos = $this->presupuestoRepository->gpresupaplicado($inmuid);        
       
        // obtener si el presup es editable
        $editpre = $this->propertyparameterRepository->gValParam($inmuid,'presupedit');
        // obtener el total depresupuesto
        $totp = $this->propertyparameterRepository->gValParam($inmuid,'presupuesto');        
        $totpre = floatval($totp); // string to float
              
        return view('expedpresupuestos.index')
            ->with('inmuid', $inmuid)
            ->with('presupuestos', $presupuestos)
            ->with('editpre', $editpre)
            ->with('totpre',$totpre);
    }

    /**
     * Muestra pantalla para modificar presupuesto completo
     *
     * @return Response
     */
    public function create($inmuid)    
    {
        $presupuestos = $this->presupuestoRepository->gpresupuesto($inmuid);
         // obtener si el presup es editable
        $editp = $this->propertyparameterRepository->gValParam($inmuid,'presupedit');
        if ($editp=="1"){
            $editpre = 1;
        }
        else{
             $editpre = 0;
        }       

        return view('expedpresupuestos.create')
            ->with('inmuid', $inmuid)
            ->with('presupuestos', $presupuestos)
            ->with('editpre',$editpre);
    }

    /**
     * Guarda los registros de presupuesto , y actualiza parametro
     *
     * @param CreatepresupuestoRequest $request
     *
     * @return Response
     */
    public function store(CreatepresupuestoRequest $request)
    {
            // *** Request All ***
            // array:6 [▼
            // "_token" => "h534RJp5UKOKJPTn53eR0FU6eMOzRzbBn8DFfjLo"
            // "total" => "392380"
            // "presup_id" => array:79 [▶]
            // "inmueble_id" => array:79 [▶]
            // "movtipo_id" => array:79 [▶]
            // "monto" => array:79 [▶]
            // ]
        //$input = $request->all(); 
        
        //Obtiene los arreglos del request
        $presup_id =  $request->presup_id; 
        $inmueble_id =  $request->inmueble_id; 
        $movtipo_id =  $request->movtipo_id; 
        $monto =  $request->monto;         
        $total =  $request->total;              // monto total
        $editable = $request->editable;         // Si esta el check de editable
        
        // Variables de control
        $Condominio = $inmueble_id[0];          //Toma solo una vez el id de condominio      
        $idx = 0;                               //indice

        //Obtiene el registro de parametro = 'presupuesto' y de si es editable
        $parampresup = $this->propertyparameterRepository->gParametro($Condominio,'presupuesto');
        $predit = $this->propertyparameterRepository->gParametro($Condominio,'presupedit');
        
        // si viene vacio es que el parametro presupuesto no esta definido en BD
        if ($parampresup->count()<1){
            //Asigna un 0, como id  
            $pid=0;                             
         }
         else{
            // obtiene el id del primer elemento de la colleccion    
            $pid = $parampresup[0]->id;         
         }   

        // si viene vacio es que el parametro de editable no esta definido en BD
        if ($predit->count()<1){
            //Asigna un 0, como id  
            $pedid=0;                             
         }
         else{
            // obtiene el id del primer elemento de la colleccion    
            $pedid = $predit[0]->id;         
         }   


        
        // Barre arreglos de request (el arreglo de ids de presupuestos)
        foreach ($presup_id as $id) {            
            // crea array de registro a actualizar solo el campo a actualizar
            $Updt = array(  
                //'inmueble_id' => $Condominio,         // este campo no se modifica
                //'movtipo_id' => $movtipo_id[$idx],    // este campo no se modifica
                'monto' => $monto[$idx]                 //Solo modifica este campo            
             );  
            $idx+=1; // incrementa indice
            //Ejecuta Update 
            $presupuesto = $this->presupuestoRepository->update($Updt , $id);
         }      
                // Modelo: propertyparameter
                // "inmueble_id" => "55"
                // "parametro" => "prueba"
                // "valor" => "254"
        // Actualiza / Crea el total en parametros de propiedad 
        if ($pid==0){
            //Crea            
            $paramp = $this->propertyparameterRepository->insertaparam($Condominio,'presupuesto',$total);
         }
         else{
            //Actualiza
            $paramp = $this->propertyparameterRepository->update(['valor' => $total],$pid);
         }

        // Si el request de editable viene vacio o es null
        if (empty($editable)){
            $editable = '0';
        }    
        else{
            $editable = '1';
        }
        
         // Actualiza / Crea el parametro de si es editable el presupuesto
        if ($pedid==0){
            //Crea            
            $paramp = $this->propertyparameterRepository->insertaparam($Condominio,'presupedit',$editable);
         }
         else{
            //Actualiza
            $paramp = $this->propertyparameterRepository->update(['valor' => $editable],$pedid);
         }
        //$presupuesto = $this->presupuestoRepository->create($input);
        Flash::success('Presupuesto guardado.');

        return redirect(route('presup.index',$Condominio));
    }

   /**
    * Elimina los presupuestos para el condominio activi
    * Genera los presupuestos en 0
    * @param  $inmuid [inmueble_id / condominio]
    * @return Response
    */
    public function inicializa($inmuid)
    {        
        $result = $this->presupuestoRepository->inicializa_sp($inmuid);        
       
        return redirect(route('presup.create',$inmuid));
    }




    /**
     * Show the form for editing the specified presupuesto.
     *
     * @param  int $id
     *
     * @return Response
     */
    // public function edit($id,$inmuid)
    // {
    //     $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

    //     if (empty($presupuesto)) {
    //         Flash::error('Presupuesto no encontrado');

    //         return redirect(route('presup.index'));
    //     }

    //     return view('expedpresupuestos.edit')->with('presupuesto', $presupuesto);
    // }

    /**
     * Update the specified presupuesto in storage.
     *
     * @param  int              $id
     * @param UpdatepresupuestoRequest $request
     *
     * @return Response
     */
    // public function update(UpdatepresupuestoRequest $request,$inmuid)
    // {
       
    //    $presupuesto = $this->presupuestoRepository->findWithoutFail($id);
    //     if (empty($presupuesto)) {
    //          Flash::error('Presupuesto no encontrado');

    //          return redirect(route('presup.index'));
    //      }
        

    //     $presupuesto = $this->presupuestoRepository->update($request->all(), $id);

    //     Flash::success('Presupuesto actualizado.');

    //     return redirect(route('presup.index'));
    // }

    /**
     * Remove the specified presupuesto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    // public function destroy($id,$inmuid)
    // {
    //     $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

    //     if (empty($presupuesto)) {
    //         Flash::error('Presupuesto no encontrado');

    //         return redirect(route('presup.index'));
    //     }

    //     $this->presupuestoRepository->delete($id);

    //     Flash::success('Presupuesto eliminado.');

    //     return redirect(route('presup.index'));
    // }
}

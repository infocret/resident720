<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprovidersRequest;
use App\Http\Requests\UpdateprovidersRequest;
use App\Repositories\providersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Repositories\categorieProvidersRepository;
use Carbon\Carbon;

class proveedorController extends AppBaseController
{
    /** @var  providersRepository */
    private $providersRepository;

    public function __construct(
        providersRepository $providersRepo,
        categorieProvidersRepository $categorieProvidersRepo)
    {
        $this->providersRepository = $providersRepo;
        $this->categorieProvidersRepository = $categorieProvidersRepo;
    }

    /**
     * Display a listing of the providers.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,$personaexpid)
    {
        
        $this->providersRepository->pushCriteria(new RequestCriteria($request));

     // if (isset($request->search) && !empty($request->search) ) {   
      if (isset($personaexpid) && !empty($personaexpid) ) {   
        //$personaexpid = Session('personaexpid');
           // $providers = $this->providersRepository->all()
            //->where('persona_id', $personaexpid);
           $providers = $this->providersRepository
           ->gcategorias($personaexpid,5);
            //$categorias= $this->providersRepository->gcategorias(2,0);
            //dd($categorias);
        }
        else{
            //$personaexpid ='0';
            $providers = $this->providersRepository->all();
        }
        //dd($providers);

         return view('proveedores.index')
            ->with('providers', $providers)
            ->with('personaexpid',$personaexpid);            
    }
//##############################################################################
//
    public function provcreate()
    {
  
         $categorias = $this->providersRepository
           ->gcategorias(0,3); // Consulta categorias
           //dd($categorias);
         return view('proveedores.create')
          ->with('categorias', $categorias);
        
    }
 //##############################################################################    
 //
    public function store(CreateprovidersRequest $request)
    {
        // Toma los datos del formulario
        $input = $request->all();
       
        // inserta proveedor
        $providers = $this->providersRepository->create($input);

        // obtiene los ids de las categorias seleccionadas
        $catids = $request->cat; 

        if (!empty($catids)){
        // obtiene el id del nuevo proveedor 
        $providerid =  $providers->id;        
        // Declara Array de elementos de categorias
        $registroscats = array();
        // Genera fecha del dia para campo created_at
        $fecha=Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s');       
        
        // Barre array de categorias seleccionadas y crea registros de relacion
         foreach ($catids as $val) {
             $cid = $val; // id de categoria
             // crea array de registro
             $inputcat = array(                 
                 'provcat_id' => $cid,
                 'provider_id' => $providerid,
                 'created_at' => $fecha
             );  
            // Anexa el registro a el arreglo de registros
            array_push($registroscats,$inputcat); 
            $cid=NULL; // limpia variable de id de categoria                   
         }
        
        $this->categorieProvidersRepository->insertcategorias($registroscats);

        }   
    
        Flash::success('Proveedor guardado correctamente.');
        $personaexpid = Session('personaexpid');
        return redirect(route('proveedor.index',$personaexpid));
    }

//##############################################################################    
    public function edit($id)
    {
        $providers = $this->providersRepository->findWithoutFail($id);

        $categorias = $this->providersRepository->gcategorias($id,2);
        //dd($categorias);

        if (empty($providers)) {
            Flash::error('Providers not found');

             $personaexpid = Session('personaexpid');
        return redirect(route('proveedor.index',$personaexpid));
        }

        return view('proveedores.edit')
        ->with('providers', $providers)
         ->with('categorias', $categorias);
    }
//##############################################################################    
 
  public function update($id, UpdateprovidersRequest $request)
    {
        $providers = $this->providersRepository->findWithoutFail($id);

        if (empty($providers)) {
            Flash::error('Providers not found');

            $personaexpid = Session('personaexpid');
        return redirect(route('proveedor.index',$personaexpid));
        }


        // Busca las categorias relacionadas a este proveedor por 
        // medio de la relacion hasmany, coloca en un array solo los ids
        $categorias=$providers->categorieprovider()->pluck('id')->toarray();

        if (!empty($categorias)){
        // llama al metodo de eliminacion de la tabla pivote categorieProviders
        $this->categorieProvidersRepository->deletecategorias($categorias);
        }
        // actualiza datos del proveedor
        $providers = $this->providersRepository->update($request->all(), $id);
        // obtiene el id del proveedor 
        $providerid =  $providers->id;
        // obtiene los ids de las categorias seleccionadas
        $catids = $request->cat;    
        
        if (!empty($catids)){        
       // Declara Array de elementos de categorias
        $registroscats = array();
        // Genera fecha del dia para campo created_at
        $fecha=Carbon::now()->setTime(0,0)->format('Y-m-d H:i:s');       
        
        // Barre array de categorias seleccionadas y crea registros de relacion
         foreach ($catids as $val) {
             $cid = $val; // id de categoria
             // crea array de registro
             $inputcat = array(                 
                 'provcat_id' => $cid,
                 'provider_id' => $providerid,
                 'created_at' => $fecha
             );  
            // Anexa el registro a el arreglo de registros
            array_push($registroscats,$inputcat); 
            $cid=NULL; // limpia vatieble de id de categoria                   
         }
        
        $this->categorieProvidersRepository->insertcategorias($registroscats);
        }

        Flash::success('Providers updated successfully.');

        $personaexpid = Session('personaexpid');
        return redirect(route('proveedor.index',$personaexpid));
    }

    //##############################################################################    
  public function destroy($id)
    {
       
        // Localiza al proveedor por su id
        $providers = $this->providersRepository->findWithoutFail($id);  
        // obtiene las categorias de ese proveedor
        //$categorias = $providers->categorieprovider()->get()->toarray();        

        if (empty($providers)) {
            Flash::error('Providers not found');

             $personaexpid = Session('personaexpid');
        return redirect(route('proveedor.index',$personaexpid));
        }

        // Busca las categorias relacionadas a este proveedor por 
        // medio de la relacion hasmany, coloca en un array solo los ids
        $categorias=$providers->categorieprovider()->pluck('id')->toarray();
        if (!empty($categorias)){
        // llama al metodo de eliminacion de la tabla pivote categorieProviders
        $this->categorieProvidersRepository->deletecategorias($categorias);
        }
        // ya sin relaciones elimina al proveedor
        $this->providersRepository->delete($id);
        
        Flash::success('Proveedor eliminado correctamente.');

        $personaexpid = Session('personaexpid'); //obtiene el id d elapersona
        return redirect(route('proveedor.index',$personaexpid));
    }  
    /////##############################################################################  
  public function show($id)
    {
        //$providers = $this->providersRepository->findWithoutFail($id);

        $provs = $this->providersRepository->gcategorias($id,6);
        $providers=reset($provs);


           //dd($providers);
        if (empty($providers)) {
            Flash::error('Providers not found');

            $personaexpid = Session('personaexpid');
        return redirect(route('proveedor.index',$personaexpid));
        }

        return view('proveedores.show')->with('providers', $providers);
    }  
    ////############################################################################## 
        
}
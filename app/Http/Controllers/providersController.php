<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprovidersRequest;
use App\Http\Requests\UpdateprovidersRequest;
use App\Repositories\providersRepository;
use App\Repositories\personaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Repositories\categorieProvidersRepository;
use App\Repositories\MedioPersonaRepository;
use App\Repositories\PersonaDirRepository;

// se agregaron para listas desplegables de cuentas
use App\Repositories\bankRepository;
use App\Repositories\bankaccountRepository;
use App\Repositories\checkbookRepository;
use App\Repositories\provideraccountRepository;

// se agregaron para crear cuenta bancaria en ventana emergente popup
use App\Repositories\banksquareRepository;
use App\Repositories\currencytypeRepository;

use Carbon\Carbon;

class providersController extends AppBaseController
{
    /** @var  providersRepository */
    private $providersRepository;

    public function __construct(        
        providersRepository $providersRepo,
        personaRepository $personaRepo,
        categorieProvidersRepository $categorieProvidersRepo,
        MedioPersonaRepository $medioPersonaRepo,
        PersonaDirRepository $personaDirRepo,
        bankRepository $bankRepo,
        bankaccountRepository $bankaccountRepo,        
        checkbookRepository $checkbookRepo,
        provideraccountRepository $provideraccountRepo,
        banksquareRepository $banksquareRepo,
        currencytypeRepository $currencytypeRepo
    )
    {
        $this->providersRepository = $providersRepo;
        $this->personaRepository = $personaRepo;
        $this->categorieProvidersRepository = $categorieProvidersRepo;
        $this->medioPersonaRepository = $medioPersonaRepo;
        $this->personaDirRepository = $personaDirRepo;
        $this->bankRepository = $bankRepo;
        $this->bankaccountRepository = $bankaccountRepo;
        $this->checkbookRepository = $checkbookRepo;
        $this->provideraccountRepository = $provideraccountRepo;
        $this->banksquareRepository = $banksquareRepo;
        $this->currencytypeRepository = $currencytypeRepo;        
             }

    /**
     * Display a listing of the providers.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $criterio =  $this->providersRepository->pushCriteria(new RequestCriteria($request));

        // si la variable search del request trae algo aplica filtro de busqueda
        if (isset($request->search) && !empty($request->search) ){
            $providers = $this->providersRepository->getcategorias($request->search,1);
        }
        else{// si la variable search del request NO trae dato NO aplica filtro de busqueda
            $providers = $this->providersRepository->getcategorias('',0);
        }       

        return view('providers.index')
            ->with('providers', $providers);
    }

    /**
     * Show the form for creating a new providers.
     *
     * @return Response
     */
    public function create()
    {
        $personas = $this->personaRepository->gpersonas();
        $categorias = $this->providersRepository
        ->gcategorias(0,3); // Consulta categorias
        $bancos = $this->bankRepository->gBancos();  
        // agregadas para llenas selects en ventana emergente de
        // creacion de cuenta bancaria
        $banksqs = $this->banksquareRepository->all();
        $currencys = $this->currencytypeRepository->all();
        return view('providers.create')
        ->with('personas', $personas)
        ->with('categorias', $categorias)
        ->with('bancos',$bancos)
        ->with('banksqs', $banksqs)
        ->with('currencys', $currencys)
        ;
    }

    /**
     * Store a newly created providers in storage.
     *
     * @param CreateprovidersRequest $request
     *
     * @return Response
     */
    public function store(CreateprovidersRequest $request)
    {
        // Toma los datos del formulario
        $input = $request->all();
        //############### Proveedor ###################################  
        // inserta proveedor
        $providers = $this->providersRepository->create($input);
        //############### Categorias ###################################
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
        // Asigna relacion de categorias
        $this->categorieProvidersRepository->insertcategorias($registroscats);

        }   
        //############### Cuentas ###################################
        //Crea objeto para insertar rel cta bancaria
        $iprovcta = array(                 
             'provider_id'      => $providers->id,
             'bankaccount_id'   => $request->bankaccount_id,
             'checkbook_id'     => $request->checkbook_id
         );  
           
        // Asigna relacion de cuenta bancaria a proveedor
        $provideraccount = $this->provideraccountRepository->create($iprovcta);


        Flash::success('Proveedor guardado con exito.');

        return redirect(route('providers.index'));
    }

    /**
     * Display the specified providers.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $providers = $this->providersRepository->findWithoutFail($id);
        $categorias = $this->providersRepository->gcategorias($providers->id,1);
        $persona = $this->personaRepository->findWithoutFail($providers->persona_id);
        $medioPersonas = $this->medioPersonaRepository->gpMedios($providers->persona_id);       
        $personaDirs = $this->personaDirRepository->gUbicaciones($providers->persona_id);
        $accounts = $this->providersRepository->gaccounts($id);

        if (empty($providers)) {
            Flash::error('Proveedor no localizado.');
            return redirect(route('providers.index'));
        }

        return view('providers.show')
        ->with('providers', $providers)
        ->with('categorias', $categorias)
        ->with('accounts', $accounts)
        ->with('persona', $persona)
        ->with('medioPersonas', $medioPersonas)
        ->with('personaDirs', $personaDirs)
        ;
    }

    /**
     * Show the form for editing the specified providers.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $providers = $this->providersRepository->findWithoutFail($id);
        $personas = $this->personaRepository->gpersonas();
        $categorias = $this->providersRepository->gcategorias($id,2);
        $bancos = $this->bankRepository->gBancos();  
        $account = $this->provideraccountRepository->gcta($id);

        if (empty($providers)) {
            Flash::error('Proveedor no localizado.');
            return redirect(route('providers.index'));
        }

        return view('providers.edit')
        ->with('providers', $providers)
        ->with('personas', $personas)
        ->with('categorias', $categorias)
        ->with('bancos',$bancos)
        ->with('account',$account)
        ;
    }

    /**
     * Update the specified providers in storage.
     *
     * @param  int              $id
     * @param UpdateprovidersRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprovidersRequest $request)
    {
        $providers = $this->providersRepository->findWithoutFail($id);
 
        if (empty($providers)) {
            Flash::error('Proveedor no localizado.');
            return redirect(route('providers.index'));
        }
        //############### Proveedor ###################################
        // actualiza datos del proveedor
        $providers = $this->providersRepository->update($request->all(), $id);
        // obtiene el id del proveedor 
        $providerid =  $providers->id;
        //############### Categorias ###################################
        // Busca las categorias relacionadas a este proveedor por 
        // medio de la relacion hasmany, coloca en un array solo los ids
        $categorias=$providers->categorieprovider()->pluck('id')->toarray();

        if (!empty($categorias)){
        // llama al metodo de eliminacion de la tabla pivote categorieProviders
        $this->categorieProvidersRepository->deletecategorias($categorias);
        }
       
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

        //############### Cuentas ###################################
        // Busca las cuentas relacionadas a este proveedor por 
        // medio de la relacion hasmany, coloca en un array solo los ids
        $paccounts=$providers->provideraccount()->pluck('id')->toarray();

        if (!empty($paccounts)){
            // llama al metodo de eliminacion de la tabla pivote provideraccount
            $this->provideraccountRepository->deleteaccounts($paccounts);
        }

        //Crea objeto para insert en  rel cta bancaria
        $iprovcta = array(                 
             'provider_id'      => $providers->id,
             'bankaccount_id'   => $request->bankaccount_id,
             'checkbook_id'     => $request->checkbook_id
         );  
           
        // Asigna relacion de cuenta bancaria a proveedor
        $provideraccount = $this->provideraccountRepository->create($iprovcta);


        Flash::success('Proveedor actualizado satisfactoriamente.');

        return redirect(route('providers.index'));
    }

    /**
     * Remove the specified providers from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $providers = $this->providersRepository->findWithoutFail($id);

        if (empty($providers)) {
            Flash::error('Proveedor no localizado');

            return redirect(route('providers.index'));
        }
         //############### Categorias ###################################
        // Busca las categorias relacionadas a este proveedor por 
        // medio de la relacion hasmany, coloca en un array solo los ids
        $categorias=$providers->categorieprovider()->pluck('id')->toarray();
        if (!empty($categorias)){
        // llama al metodo de eliminacion de la tabla pivote categorieProviders
        $this->categorieProvidersRepository->deletecategorias($categorias);
        }
        //############### Cuentas ###################################
        // Busca las cuentas relacionadas a este proveedor por 
        // medio de la relacion hasmany, coloca en un array solo los ids
        $paccounts=$providers->provideraccount()->pluck('id')->toarray();
        if (!empty($paccounts)){
            // llama al metodo de eliminacion de la tabla pivote provideraccount
            $this->provideraccountRepository->deleteaccounts($paccounts);
        }
        //############### Proveedor ###################################
        // ya sin relaciones elimina al proveedor
        $this->providersRepository->delete($id);

        Flash::success('Proveedor eliminado.');

        return redirect(route('providers.index'));
    }
}

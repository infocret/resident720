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

class condominioController extends AppBaseController
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

/**
     * Lista de inmuebles d eun solo tipo
     *
     * @param Request $request
     * @return Response
     */
    public function list($condomid,Request $request)
    {
      
       $req = $this->inmuebleRepository->pushCriteria(new RequestCriteria($request));
       
       $inmuebles = $this->inmuebleRepository->gInmueblebytype($condomid,1);      

       return view('condominios.index')
            ->with('inmuebles', $inmuebles);
    }

    /**
     * Lista de inmuebles d eun solo tipo
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
      //$condomid = 68;
       $req = $this->inmuebleRepository->pushCriteria(new RequestCriteria($request));
       
       $inmuebles = $this->inmuebleRepository->gInmueblebytypeb(1);      

       return view('condominios.index')
            ->with('inmuebles', $inmuebles);
    }

   /**
     * Show the form for creating a new inmueble.
     *
     * @return Response
     */
    public function create()
    {
        //$InmuTipos = $this->InmuebleTipoRepository->gInmuebleTipos(0); //0=Todos
        //dd($InmuTipos);
        // Crea stdClass Object
        $condomi = new \stdClass();
         
        //Datos condominio        
        $condomi->cve = "";        
        $condomi->nom = "";       
        $condomi->nunid = "";
        $condomi->rfc = "";
        $condomi->cp = "N/A";
        $condomi->calle = "";
        $condomi->numext = "";

        //Datos Administrador        
        $condomi->adminom = "N/A";
        $condomi->admiapp = "N/A";
        $condomi->admiapm = "N/A";
        $condomi->admiemail = "N/A";
        $condomi->admitel = "N/A";

        //Generación de recibos        
        $condomi->diavencim = "";
        $condomi->tzainter = "";
        $condomi->gcent = "";
        $condomi->descppag = "";
        $condomi->diasvenc = "";
        $condomi->tzainterv = "";
        $condomi->numrecib = "";
        
        // Cuntas bancarias        
        $condomi->banco = "";
        $condomi->sucursal = "";
        $condomi->cta = "";
        $condomi->clabe = "";
        $condomi->convenio = "";
        $condomi->chequera = "";
        //dd($condomi);
        return view('condominios.create')
        ->with('condomi', $condomi);
    }

    /**
     * Store a newly created inmueble in storage.
     *
     * @param CreateinmuebleRequest $request
     *
     * @return Response
     */
    public function store(CreateinmuebleRequest $request)
    {
        //$input = $request->all();
        // array:18 [▼
        //   0 => "123"
        //   1 => "nombre"
        //   2 => "5"
        //   3 => "n/a"
        //   4 => "08500"
        //   5 => "retorno 7"
        //   6 => "20"
        //   7 => "Julio"
        //   8 => "Buendia"
        //   9 => "coreo@ccc .com"
        //   10 => "5536571716"
        //   11 => "10"
        //   12 => "1"
        //   13 => "Gcent"
        //   14 => "250"
        //   15 => "15"
        //   16 => "1"
        //   17 => "12"
        // ]
       // dd($input);
        $paramarray = array();      // Declara un array para parametros de procedimiento
        array_push($paramarray,$request->input("ident","cve0"));
        array_push($paramarray,$request->input("nombre","condominio nuevo")); 
        array_push($paramarray,$request->input("nunid","1")); 
        array_push($paramarray,$request->input("rfc","n/a")); 
        array_push($paramarray,$request->input("codpo","08500")); 
        array_push($paramarray,$request->input("calle","n/a")); 
        array_push($paramarray,$request->input("numExt","0")); 
        array_push($paramarray,$request->input("namep","n/a")); 
        array_push($paramarray,$request->input("appatp","n/a")); 
        array_push($paramarray,$request->input("apmatp","n/a")); 
        array_push($paramarray,$request->input("datemailp","n/a")); 
        array_push($paramarray,$request->input("datphonep","n/a")); 
        array_push($paramarray,$request->input("dvence","10")); 
        array_push($paramarray,$request->input("interes","n/a")); 
        array_push($paramarray,$request->input("cent","n/a")); 
        array_push($paramarray,$request->input("dppago","n/a")); 
        array_push($paramarray,$request->input("dsvencim","n/a")); 
        array_push($paramarray,$request->input("interes2","n/a")); 
        array_push($paramarray,$request->input("nrecip","n/a")); 
        //array_push($paramarray,$request->input("convbanc","0")); 
        //dd($paramarray);

        $condomstatus = $this->inmuebleRepository->saveCondom($paramarray);

        //$inmueble = $this->inmuebleRepository->create($input);
        if ($condomstatus="OK"){
            Flash::success('Condominio Guardado Correctamente.');
        }

        return redirect(route('condominios.index'));
    }

    /**
     * Display the specified inmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);
        //$inmutipo = $inmueble->inmuebleTipo->nombre;
        // dd($inmueble);

        if (empty($inmueble)) {
            Flash::error('Condominio no encontrado.');

            return redirect(route('condominios.index'));
        }

        return view('condominios.show')->with('inmueble', $inmueble);
    }

    /**
     * Show the form for editing the specified inmueble.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);

        if (empty($inmueble)) {
            Flash::error('Condominio no encontrado.');

            return redirect(route('condominios.index'));
        }

        return view('condominios.edit')
        ->with('inmueble', $inmueble);
        
    }

    /**
     * Update the specified inmueble in storage.
     *
     * @param  int              $id
     * @param UpdateinmuebleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinmuebleRequest $request)
    {
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);

        if (empty($inmueble)) {
            Flash::error('Condominio no encontrado.');

            return redirect(route('condominios.index'));
        }

        $inmueble = $this->inmuebleRepository->update($request->all(), $id);

        Flash::success('Condominio actualizado correctamente.');


        if ($request->session()->has('propertyexpid'))  {        
            return redirect(route('expcondominio.index',$id));
        }
        else {   
            return redirect(route('condominios.index'));
        }
       
    }

    /**
     * Remove the specified inmueble from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $inmueble = $this->inmuebleRepository->findWithoutFail($id);

        if (empty($inmueble)) {
            Flash::error('Condominio no encontrado.');

            return redirect(route('condominios.index'));
        }

        $this->inmuebleRepository->delete($id);

        Flash::success('Condominio eliminado correctamente.');

        return redirect(route('condominios.index'));
    }
   }

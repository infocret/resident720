<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateprocedmovtoRequest;
use App\Http\Requests\UpdateprocedmovtoRequest;
use App\Repositories\procedmovtoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class procedmovtoController extends AppBaseController
{
    /** @var  procedmovtoRepository */
    private $procedmovtoRepository;

    public function __construct(procedmovtoRepository $procedmovtoRepo)
    {
        $this->procedmovtoRepository = $procedmovtoRepo;
    }

    /**
     * Display a listing of the procedmovto.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->procedmovtoRepository->pushCriteria(new RequestCriteria($request));
        // $procedmovtos = $this->procedmovtoRepository->all();
        
        $procedmovtos = $this->procedmovtoRepository->gProcedmovtos();
        //dd($procedmovtos);
        return view('procedmovtos.index')
            ->with('procedmovtos', $procedmovtos);
    }

    /**
     * Show the form for creating a new procedmovto.
     *
     * @return Response
     */
    public function create()
    {
      
        $condoms = $this->procedmovtoRepository->gcondoms();
        //dd($condoms);
        $concepts = $this->procedmovtoRepository->gconcepts();
        //dd($concepts);
        $procedims = $this->procedmovtoRepository->gSps_onDb();
        //dd($procedims);

        // $movtos = $this->procedmovtoRepository->gmovtos('68','1');
        // dd($movtos);
          
        return view('procedmovtos.create')
        ->with('condoms', $condoms)
        ->with('concepts', $concepts)
        ->with('procedims', $procedims)
        ;
    }

    /**
     * Store a newly created procedmovto in storage.
     *
     * @param CreateprocedmovtoRequest $request
     *
     * @return Response
     */
    public function store(CreateprocedmovtoRequest $request)
    {
        $input = $request->all();
        //dd($input);
        //dd($request->procedimiento);
        //dd($input['procedimiento']);

        if (!array_key_exists('execauto', $input)) {
           $input['execauto'] = 0; // se agrega elemento con valor cero
        }


        $procedmovto = $this->procedmovtoRepository->create($input);

        Flash::success('Procedmovto saved successfully.');

        return redirect(route('procedmovtos.index'));
    }



    /**
     * Show the form for editing the specified procedmovto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id);

        $condoms = $this->procedmovtoRepository->gcondoms();
        //dd($condoms);
        $concepts = $this->procedmovtoRepository->gconcepts();
        //dd($concepts);
        $procedims = $this->procedmovtoRepository->gSps_onDb();
        //dd($procedims);

        $movtos = $this->procedmovtoRepository->gmovtos(
            $procedmovto->inmueble_id,$procedmovto->conceptservice_id);
  

        if (empty($procedmovto)) {
            Flash::error('Procedmovto not found');

            return redirect(route('procedmovtos.index'));
        }

        return view('procedmovtos.edit')
        ->with('procedmovto', $procedmovto)
        ->with('condoms', $condoms)
        ->with('concepts', $concepts)
        ->with('procedims', $procedims)
        ->with('movtos', $movtos)
        ;
    }

    /**
     * Update the specified procedmovto in storage.
     *
     * @param  int              $id
     * @param UpdateprocedmovtoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprocedmovtoRequest $request)
    {
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id);

        $input = $request->all();

        if (!array_key_exists('execauto', $input)) {
           $input['execauto'] = 0; // se agrega elemento con valor cero
        }

        if (empty($procedmovto)) {
            Flash::error('Procedmovto not found');

            return redirect(route('procedmovtos.index'));
        }

        $procedmovto = $this->procedmovtoRepository->update($input, $id);

        Flash::success('Procedmovto updated successfully.');

        return redirect(route('procedmovtos.index'));
    }

    /**
     * Remove the specified procedmovto from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id);

        if (empty($procedmovto)) {
            Flash::error('Procedmovto not found');

            return redirect(route('procedmovtos.index'));
        }

        $this->procedmovtoRepository->delete($id);

        Flash::success('Procedmovto deleted successfully.');

        return redirect(route('procedmovtos.index'));
    }

    /**
     * Display the specified procedmovto.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id);       

        if (empty($procedmovto)) {
            Flash::error('Registro NO Encontrado');

            return redirect(route('procedmovtos.index'));
        }

        //Crea fecha 
        $now = new \DateTime();        
        $fecha = date_format($now,"Y/m/d");

        $servmovtos = $this->procedmovtoRepository->gServMovto(
        $procedmovto->inmueble_id,$procedmovto->conceptservice_id,$procedmovto->catmovto_id);

        $inmuebles = $this->procedmovtoRepository->gCondominio($procedmovto->inmueble_id);
        
        $condominio = $inmuebles[0]->id.'-'.$inmuebles[0]->ident.'-'.$inmuebles[0]->nombre ;
        
        $servicio = $servmovtos[0]->conceptid.'-'.
        $servmovtos[0]->conceptcve.'-'.$servmovtos[0]->conceptnom ;
        
        switch ($servmovtos[0]->movtotipo) {
        case "A":
           $movtipo = ' (Abono)';
            break;
        case "C":
           $movtipo = ' (Cargo)';
            break;
        case "E":
           $movtipo = ' (Egreso)';
            break;
        case "I":
           $movtipo = ' (Ingreso)';
            break;            
        case "P":
           $movtipo = ' (Pago)';
            break;            
        default:
            $movtipo = ' (No definido)';
        }

        $movimiento = $servmovtos[0]->movtoid.'-'.
        $servmovtos[0]->movtocve.'-'.$servmovtos[0]->movtonom.$movtipo ;

        $contratos = $this->procedmovtoRepository->gUnidContrato(
            $procedmovto->inmueble_id,$procedmovto->catmovto_id);

        $ncont = count($contratos);

        $origen = 'SHOW' ;

        return view('procedmovtos.show')
        ->with('procedmovto', $procedmovto)
        ->with('condominio', $condominio)        
        ->with('servicio', $servicio)
        ->with('movimiento', $movimiento)
        ->with('contratos', $contratos)
        ->with('ncont', $ncont)
        ->with('origen', $origen)
        ->with('fecha', $fecha)
        ;
    }

    /**
     * Muestra los datos del registro 
     * del procedimiento, movimiento y contratos
     * que afectara la ejecucion del procedimiento
     *
     * @param  int $id
     *
     * @return Response
     */
    public function revisarsp($id,$origen)
    {

        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id);       

        if (empty($procedmovto)) {
            Flash::error('Registro NO Encontrado');

            return redirect(route('procedmovtos.index'));
        }

        //Crea fecha 
        $now = new \DateTime();        
        $fecha = date_format($now,"Y-m-d");

        $servmovtos = $this->procedmovtoRepository->gServMovto(
        $procedmovto->inmueble_id,$procedmovto->conceptservice_id,$procedmovto->catmovto_id);

        $inmuebles = $this->procedmovtoRepository->gCondominio($procedmovto->inmueble_id);
        
        $condominio = $inmuebles[0]->id.'-'.$inmuebles[0]->ident.'-'.$inmuebles[0]->nombre ;
        
        $servicio = $servmovtos[0]->conceptid.'-'.
        $servmovtos[0]->conceptcve.'-'.$servmovtos[0]->conceptnom ;
        
        switch ($servmovtos[0]->movtotipo) {
        case "A":
           $movtipo = ' (Abono)';
            break;
        case "C":
           $movtipo = ' (Cargo)';
            break;
        case "E":
           $movtipo = ' (Egreso)';
            break;
        case "I":
           $movtipo = ' (Ingreso)';
            break;            
        case "P":
           $movtipo = ' (Pago)';
            break;            
        default:
            $movtipo = ' (No definido)';
        }

        $movimiento = $servmovtos[0]->movtoid.'-'.
        $servmovtos[0]->movtocve.'-'.$servmovtos[0]->movtonom.$movtipo ;

        $contratos = $this->procedmovtoRepository->gUnidContrato(
            $procedmovto->inmueble_id,$procedmovto->catmovto_id);

        $ncont = count($contratos);

        return view('procedmovtos.show')
        ->with('procedmovto', $procedmovto)
        ->with('condominio', $condominio)        
        ->with('servicio', $servicio)
        ->with('movimiento', $movimiento)
        ->with('contratos', $contratos)
        ->with('ncont', $ncont)
        ->with('origen', $origen)
        ->with('fecha', $fecha)
        ;

    }
 
    /**
     * Reprograma la fecha de ejecucion en contratos
     *  y Ejecuta el SP.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function ejecutasp($id)
    {
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id); 

        if (empty($procedmovto)) {
            Flash::error('Registro NO Encontrado');

            return redirect(route('procedmovtos.index'));
        }        

        //Valida parametros
        $parametros = array();
        if(strtoupper($procedmovto->parametros) != 'N/A' && $procedmovto->parametros != '' ){
            //Si trae parametros llena array
            $parametros = explode(",", $procedmovto->parametros);            
        }
            
            //dd(count($parametros));

        //Crea fecha 
        $now = new \DateTime();        
        $fecha = date_format($now,"Y-m-d");

        //Modificar fecha en contrato (unidadmovto)
        $resupd = $this->procedmovtoRepository->gUpdate(
        $procedmovto->inmueble_id,$procedmovto->catmovto_id,$fecha);
        //dd('Reg Afectados: '.$resupd);
        
        //Ejecuta el SP <- !!!!
        $ressp = $this->procedmovtoRepository->execsp($procedmovto->procedimiento,$parametros);

        Flash::success('Se ejecuto procedimiento: '.count($ressp));

        return redirect( route('procedmovtos.revisarsp', [$procedmovto->id,'EXECSP']));          
        //return redirect(route('procedmovtos.index'));
    }


    /**
     * Asignar fecha
     *
     * @param  int $id
     *
     * @return Response
     */
    public function seldate($id)
    {       
        //dd($id);     
         //Crea fecha 
        $now = new \DateTime();        
        $fecha = date_format($now,"Y-m-d");

        return view('procedmovtos.fechaprog')
        ->with('id',$id)
        ->with('fecha',$fecha)
        ;
        
    }



    /**
     * Reprograma la fecha de ejecucion en contratos     *  
     *
     * @param  int $id
     *
     * @param UpdateprocedmovtoRequest $request
     *
     * @return Response
     */
    public function programar(Request $request)    
    {
        $input = Request()->all();
        
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($input['id']); 
        
        //Modificar fecha en contrato (unidadmovto)
        $resupd = $this->procedmovtoRepository->gUpdate(
        $procedmovto->inmueble_id,$procedmovto->catmovto_id,$input['dfecha']);

        Flash::success('Fecha actualizad en '.$resupd.' contratos.');

        return redirect( route('procedmovtos.revisarsp', [$procedmovto->id,'REPROG']));
    }




    /**     
     *  Lista movimientos de un concepto
     *  que esten relacionadad en contrato 
     *  de unidades de un condominio , 
     *  Usado por select que realiza llamada ajax 
     *  en dropsdownsps.js
     *
     * @param  int $continente
     *
     * @return Response
     */
    public function getmovtos(Request $request, $condomid,$movtoid)
    {

        if ($request->ajax()){
            $movtos = $this->procedmovtoRepository->gmovtos($condomid,$movtoid);                 
            return response()->json($movtos); 
        } 
             $movtos = $this->procedmovtoRepository->gmovtos($condomid,$movtoid);              
             return response()->json($movtos);      
    }





}

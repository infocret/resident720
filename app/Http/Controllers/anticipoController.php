<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateanticipoRequest;
use App\Http\Requests\UpdateanticipoRequest;
use App\Repositories\anticipoRepository;
use App\Http\Controllers\AppBaseController;
use App\Repositories\inmuebleRepository;
use App\Repositories\conceptserviceRepository;  // concepto servicio
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use \Carbon\Carbon;                             // Para formateo de fechas


class anticipoController extends AppBaseController
{
    /** @var  anticipoRepository */
    private $anticipoRepository;

    public function __construct(
        anticipoRepository $anticipoRepo,
        inmuebleRepository $inmuebleRepo,
        conceptserviceRepository $conceptserviceRepo)
    {
        $this->anticipoRepository = $anticipoRepo;
        $this->inmuebleRepository = $inmuebleRepo;
        $this->conceptserviceRepository = $conceptserviceRepo;
    }

    /**
     * Display a listing of the anticipo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->anticipoRepository->pushCriteria(new RequestCriteria($request));
        //$anticipos = $this->anticipoRepository->paginate(10);
        $propexpid = Session('condominioexpid');
        $anticipos = $this->anticipoRepository->ganticbycondomid($propexpid);

        return view('anticipos.index')
            ->with('anticipos', $anticipos);
    }

    /**
     * Show the form for creating a new anticipo.
     *
     * @return Response
     */
    public function create()
    {
        $user = 'user:'.auth()->user()->id.'-'.auth()->user()->name; 
        $propexpid = Session('condominioexpid');             
        $unidades = $this->inmuebleRepository->gInmuUnidades($propexpid);
      
        return view('anticipos.create')
        ->with('unidades', $unidades)
        ->with('propexpid', $propexpid)
        ->with('user', $user)
         ;
    }

    /**
     * Consulta los conceptservices de una unidad
     *
     * @return Response
     */
    public function gconceptbyunid(Request $request,$unidid)
    {
        if ($request->ajax()){      
            $conceptservices = $this->conceptserviceRepository->gconcepanticip($unidid);
            return response()->json($conceptservices);             
        }
        else{
            $conceptservices = $this->conceptserviceRepository->gconcepanticip($unidid);
            return $conceptservices; 
        }

    }



    /**
     * Store a newly created anticipo in storage.
     *
     * @param CreateanticipoRequest $request
     *
     * @return Response
     */
    public function store(CreateanticipoRequest $request)
    {
  // "unid_id" => "120"
  // "conceptserv_id" => "1"
  // "fechareg" => "2022-04-14"
  // "montoini" => "23"
  // "cobertura" => "Un año"
  // "observ" => "n/a"
  // "condom_id" => "116"
  // "folio" => "0000000000000000000000000000"
  // "saldo" => "23"
  // "status" => "Generado"
  // "desc" => "1100 - Cuota de Mantenimiento"
  // "docto" => "n/a"
  // "filelink" => "n/a"
  // "userreg" => "user:1-Julio buendia"
        $input = $request->all();
        //dd($input);

 // *************  Formatea monto    
        $cuanto = number_format( $input['montoini'], 2, '.', '');  
        $input['montoini']  = $cuanto;
        $input['saldo']     = $cuanto;
 // ************* obtiene datos para folio 
        $freg   =  $input['fechareg'] ;
        $unidid =  $input['unid_id'] ;        
 // *************   Obtiene datos de concepto servicio    
        $conceptid = $input['conceptserv_id'];
        $concept  = $this->conceptserviceRepository->findWithoutFail($conceptid);        
        $conceptcve =$concept->cve;
 // ************* Inserta el anticipo  ********************
        $anticipo = $this->anticipoRepository->create($input);
        $anticid  = $anticipo->id ;
 //************************************ Genera Folio ********************
        //Arma fecha de registro
        $tfecha = Carbon::parse($freg);
        $mfecha = $tfecha->month;
        $dfecha = $tfecha->day;
        $afecha = $tfecha->year;
        $afecha = substr($afecha,2,2);   
        //Quta punto a monto  
        $fcuanto= str_replace('.', '', $cuanto);

        // Arma Folio 28 caracteres
        // 3 inmuebleid     1-3
        // 6 fecha          4-9
        // 7 monto          10-16
        // 2 decmales       17-18
        // 4 movtocve       19-22
        // 5 movtoid        23-27
        // 1 1/2            28
        // 069 191010 000330200 1111 00001 2
        //   3      6         9    4     5 1    Tot: 28 
        //0691910100003302001111000012
        //123 456789 0123456 78 9012 34567 8
       
        // 3 inmuebleid
        $folio = str_pad($unidid, 3, "0", STR_PAD_LEFT);        
        // 6 fecha
        $folio = $folio.str_pad($afecha, 2, "0", STR_PAD_LEFT);
        $folio = $folio.str_pad($mfecha, 2, "0", STR_PAD_LEFT);
        $folio = $folio.str_pad($dfecha, 2, "0", STR_PAD_LEFT);
        // 9 monto 
        $folio = $folio.str_pad($fcuanto, 9, "0", STR_PAD_LEFT);        
        // 4 movtocve
        $folio = $folio.str_pad($conceptcve, 4, "0", STR_PAD_LEFT);
        // 5 inmuchargeid o inmumovtoid o anticipoid
        $folio = $folio.str_pad($anticid, 5, "0", STR_PAD_LEFT);
        // 1  digito identifica si es cargo 1 o movto 2  o anticipo 3               
        $folio = $folio.'3';        
        //dd($folio);
        
        //************************************ Actualiza Folio ********************
        $inpmovto = array('folio' => $folio);          
        $anticipupd = $this->anticipoRepository->update($inpmovto, $anticid);
       

        Flash::success('Anticipo registrado.');

        return redirect(route('anticipos.index'));
    }

    /**
     * Display the specified anticipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $anticipo = $this->anticipoRepository->findWithoutFail($id);

        if (empty($anticipo)) {
            Flash::error('Anticipo not found');

            return redirect(route('anticipos.index'));
        }

        return view('anticipos.show')->with('anticipo', $anticipo);
    }

    /**
     * Show the form for editing the specified anticipo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $anticipo = $this->anticipoRepository->findWithoutFail($id);

        if (empty($anticipo)) {
            Flash::error('Anticipo not found');

            return redirect(route('anticipos.index'));
        }
        
        $user = 'user:'.auth()->user()->id.'-'.auth()->user()->name; 
        $conceptservices = $this->conceptserviceRepository->gconcepanticip($anticipo->unid_id);
        $propexpid = Session('condominioexpid');             
        $unidades = $this->inmuebleRepository->gInmuUnidades($propexpid);
        return view('anticipos.edit')
        ->with('anticipo', $anticipo)
        ->with('conceptservices', $conceptservices)
        ->with('unidades', $unidades)
        ->with('propexpid', $propexpid)
        ->with('user', $user);
    }

    /**
     * Update the specified anticipo in storage.
     *
     * @param  int              $id
     * @param UpdateanticipoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateanticipoRequest $request)
    {
        $anticipo = $this->anticipoRepository->findWithoutFail($id);

        if (empty($anticipo)) {
            Flash::error('Anticipo not found');

            return redirect(route('anticipos.index'));
        }

        $anticipo = $this->anticipoRepository->update($request->all(), $id);

        Flash::success('Anticipo updated successfully.');

        return redirect(route('anticipos.index'));
    }

    /**
     * Remove the specified anticipo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $anticipo = $this->anticipoRepository->findWithoutFail($id);

        if (empty($anticipo)) {
            Flash::error('Anticipo not found');

            return redirect(route('anticipos.index'));
        }

        $this->anticipoRepository->delete($id);

        Flash::success('Anticipo deleted successfully.');

        return redirect(route('anticipos.index'));
    }
}

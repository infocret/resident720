<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCodPoRequest;
use App\Http\Requests\UpdateCodPoRequest;
use App\Repositories\CodPoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Barryvdh\DomPDF\Facade as PDF;

class CodPoController extends AppBaseController
{
    /** @var  CodPoRepository */
    private $codPoRepository;

    public function __construct(CodPoRepository $codPoRepo)
    {
        $this->codPoRepository = $codPoRepo;
    }


    /**
     * Display a listing of the CodPo.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        //dd($request);   
        //dd(new RequestCriteria($request));     
        // Si esta declarada la variable search y NO esta vacia
        if (isset($request->search) && !empty($request->search) ) {
            // Si se desea implementar solo un campo de busqueda 
            // que busque por todos los campos un texto con like
             $this->codPoRepository->pushCriteria(new RequestCriteria($request));
             $codPos = $this->codPoRepository->paginate(15);
            // Fin Campo de busqueda unico        
        }
        else {
            // Si se desea que se puedan hacer busquedas por valor para cada campo con like
            // Finalmente se pagino y filtro mediante una funcion en codPoRepository.php
            $codPos = $this->codPoRepository->filtrado($request);   ///OK
            //Fin Busqueda por calor para cada campo 
        } // Fin del if


        //Se devuelve una coleccion que aplica muy bien el paginado
        return view('cod_pos.index')
          ->with('codPos', $codPos);    
        // $this->codPoRepository->pushCriteria(new RequestCriteria($request));
        // $codPos = $this->codPoRepository->all();
        // return view('cod_pos.index')
        //     ->with('codPos', $codPos);
    }
//*************************************************************************************************
//*************************************************************************************************
//*************************************************************************************************
    // funcion que devuelve la lista de estados para llenar el select 
         public function getEstados(Request $request, $pais)
        {
            if ($request->ajax()){
                $estados= $this->codPoRepository->gEstados($pais);            
                return response()->json($estados); 
            } 
                 // $estados= $this->codPoRepository->gEstados($pais);  
                 // dd($estados)          ;
                 // return response()->json($estados);           
        }


    // funcion que devuelve la lista de ciudades para llenar el select 
         public function getCiudades(Request $request,$estado)
        {
            if ($request->ajax()){
                $ciudades= $this->codPoRepository->gCiudades($estado);                 
                return response()->json($ciudades);  
            }

        }

   
    // funcion que devuelve la lista de municipios dependiend del estado seleccionado para llenar select
    public function getMunicipios(Request $request, $ciudad)
        {
            if ($request->ajax()){
                $municipios= $this->codPoRepository->gMunicipios($ciudad);
                return response()->json($municipios);  
            } 
                // $municipios= $this->codPoRepository->gMunicipios($ciudad);
                // return response()->json($municipios);  
        }

    // funcion que devuelve la lista de asentamientos dependiend del estado seleccionado para llenar select
    public function getAsentamientos(Request $request, $municipio)
        {
            if ($request->ajax()){
                $asentamientos= $this->codPoRepository->gAsentamientos2($municipio);                
                return response()->json($asentamientos);  
            } 
               // dd($municipio);
                 // $asentamientos= $this->codPoRepository->gAsentamientos2($municipio);
                 // dd($asentamientos);
                 // return response()->json($asentamientos); 

        }


//*************************************************************************************************
 /**
     * Exportalos datos de una ubicacion de una persona a un archivo PDF
     *
     * @param  int $id
     *
     * @return Response
     */
   // public function codpopdfshow($id)
   // {
        // $personaDir=$this->personaDirRepository->gUbicacion( $id);
                  
        // $personaDir=head($personaDir);   

        // //return view('personaubicaciones.showpdf')->with('personaDir', $personaDir);   
        // //$pdf = PDF::loadView('personaubicaciones.showpdf');
       
        // $pdf = PDF::loadView('personaubicaciones.showpdf', compact('personaDir'));
        // return $pdf->download('ubicacion.pdf');
        // 
   // }
//*************************************************************************************************
//*************************************************************************************************


    /**
     * Show the form for creating a new CodPo.
     *
     * @return Response
     */
    public function create()
    {
        return view('cod_pos.create');
    }

    /**
     * Store a newly created CodPo in storage.
     *
     * @param CreateCodPoRequest $request
     *
     * @return Response
     */
    public function store(CreateCodPoRequest $request)
    {
        $input = $request->all();

        $codPo = $this->codPoRepository->create($input);

        Flash::success('Cod Po saved successfully.');

        return redirect(route('codPos.index'));
    }

    /**
     * Display the specified CodPo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $codPo = $this->codPoRepository->findWithoutFail($id);

        if (empty($codPo)) {
            Flash::error('Cod Po not found');

            return redirect(route('codPos.index'));
        }

        return view('cod_pos.show')->with('codPo', $codPo);
    }

    /**
     * Show the form for editing the specified CodPo.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $codPo = $this->codPoRepository->findWithoutFail($id);

        if (empty($codPo)) {
            Flash::error('Cod Po not found');

            return redirect(route('codPos.index'));
        }

        return view('cod_pos.edit')->with('codPo', $codPo);
    }

    /**
     * Update the specified CodPo in storage.
     *
     * @param  int              $id
     * @param UpdateCodPoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCodPoRequest $request)
    {
        $codPo = $this->codPoRepository->findWithoutFail($id);

        if (empty($codPo)) {
            Flash::error('Cod Po not found');

            return redirect(route('codPos.index'));
        }

        $codPo = $this->codPoRepository->update($request->all(), $id);

        Flash::success('Cod Po updated successfully.');

        return redirect(route('codPos.index'));
    }

    /**
     * Remove the specified CodPo from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $codPo = $this->codPoRepository->findWithoutFail($id);

        if (empty($codPo)) {
            Flash::error('Cod Po not found');

            return redirect(route('codPos.index'));
        }

        $this->codPoRepository->delete($id);

        Flash::success('Cod Po deleted successfully.');

        return redirect(route('codPos.index'));
    }
}

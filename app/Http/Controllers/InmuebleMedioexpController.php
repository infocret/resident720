<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInmuebleMedioRequest;
use App\Http\Requests\UpdateInmuebleMedioRequest;
use App\Repositories\InmuebleMedioRepository;
use App\Repositories\medioRepository;  //Para select de create y edit
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InmuebleMedioexpController extends AppBaseController
{
    /** @var  InmuebleMedioRepository */
    private $inmuebleMedioRepository;

    public function __construct(
        InmuebleMedioRepository $inmuebleMedioRepo,
        medioRepository $medioRepo             //Para select de create y edit
    )
    {
        $this->inmuebleMedioRepository = $inmuebleMedioRepo; 
        $this->medioRepository = $medioRepo;    //Para select de create y edit
    }

/**
     *   
     * Muestra los medios de contacto de un inmueble
     * Route::get('/inmumediosexp/',['as' => 'inmumediosexp.index', 
     *     'uses'=>'InmuebleMedioexpController@inmumediosindex']); 
     *
     * @param Request $request
     * @return Response
     */
    public function inmumediosindex($inmuid)
    {
        //$propertyexpid = Session('propertyexpid');     
        $inmumedios = $this->inmuebleMedioRepository->gMedios($inmuid);
        //dd($inmumedios);
        return view('inmumediosexp.index')
        ->with('inmumedios', $inmumedios)
        ->with('inmuid',$inmuid);
    }

/**
     * Display the specified MedioPersona.
     * Route::get('/inmumediosexp/show/{id}',['as' => 'inmumediosexp.show', 
     *   'uses'=>'InmuebleMedioexpController@inmumediosshow']);
     * @param  int $id
     *
     * @return Response
     */
    public function inmumediosshow($id,$inmuid)
    {
        $inmumedio = $this->inmuebleMedioRepository->findWithoutFail($id);

        if (empty($inmumedio)) {
            Flash::error('Medio Inmueble not found');

            return redirect(route('inmumediosexp.index',$inmuid));
        }

        return view('inmumediosexp.show')
        ->with('inmumedio', $inmumedio)
        ->with('inmuid',$inmuid);
    }

 /**
     * Show the form for creating a new InmuebleMedio.
     *Route::get('/inmumediosexp/create/',['as' => 'inmumediosexp.create', 
     *   'uses' => 'InmuebleMedioexpController@inmumediosreate']); 
     * @return Response
     */
    public function inmumedioscreate($inmuid)
    {
        //Para select de create 
        $mediosList = $this->medioRepository->gMediosLista();
        //dd($mediosList);
        return view('inmumediosexp.create')
          ->with('mediosList', $mediosList)
          ->with('inmuid', $inmuid);
    }

/**
     * Guarda un medio de contacto para uninmueble.
     *Route::post('/inmumediosexp',['as' => 'inmumediosexp.store', 
     *   'uses' => 'InmuebleMedioexpController@inmumediostore']);
     * @param CreateInmuebleMedioRequest $request
     *
     * @return Response
     */
    public function inmumediostore(CreateInmuebleMedioRequest $request)
    {
        $inmuid =$request->input('inmueble_id') ;// Session('propertyexpid');    
        //dd($personaexpid);
        
        $input = $request->all();

        $inmuebleMedio = $this->inmuebleMedioRepository->create($input);

        Flash::success('Inmueble Medio saved successfully.');

        return redirect(route('inmumediosexp.index', $inmuid ));
    }

  /**
     * Show the form for editing the specified InmuebleMedio.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function inmumediosedit($id,$inmuid)
    {
    //$propertyexpid = Session('propertyexpid');
    $inmuebleMedio = $this->inmuebleMedioRepository->findWithoutFail($id);
    //Para select de edit    
    $mediosList=$this->medioRepository->gMediosLista();
        if (empty($inmuebleMedio)) {
            Flash::error('Medio de contacto no localizado');

            return redirect(route('inmumediosexp.index',$inmuid));
        }    
        return view('inmumediosexp.edit')
        ->with('mediosList', $mediosList)
        ->with('inmuebleMedio', $inmuebleMedio)
        ->with('inmuid',$inmuid);
    }

//**************************************************************************
    /**
     * Update the specified Inmueble Medio in storage.
     *
     * @param  int              $id
     * @param UpdateInmuebleMedioRequest $request
     *
     * @return Response
     */
    public function inmumediosupdate($id, UpdateInmuebleMedioRequest $request)
    {
        $inmuebleMedio = $this->inmuebleMedioRepository->findWithoutFail($id);
            //dd($request->all());
        if (empty($inmuebleMedio)) {
            Flash::error('Medio de contacto no localizado');

            return redirect(route('inmumediosexp.index'));
        }

        $inmuebleMedio = $this->inmuebleMedioRepository->update($request->all(), $id);
        $inmuid =$request->input('inmueble_id') ;

        Flash::success('Medio de contacto de inmueble actualizado.');

        return redirect(route('inmumediosexp.index',$inmuid));
    }

  /**
     * Elimina el registro de Inmueble Medio
     *
     * @param  int $id
     *
     * @return Response
     */
    public function inmumediodestroy($id,$inmuid)
    {
        //dd($id);
        $inmuebleMedio = $this->inmuebleMedioRepository->findWithoutFail($id);

        if (empty($inmuebleMedio)) {
            Flash::error('Medio de contacto no localizado');

            return redirect(route('inmumediosexp.index',$inmuid));
        }

        $this->inmuebleMedioRepository->delete($id);

        Flash::success('Medio de contacto de inmueble eliminado.');

        return redirect(route('inmumediosexp.index',$inmuid));
    }

}

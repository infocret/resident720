<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepropertyareasRequest;
use App\Http\Requests\UpdatepropertyareasRequest;
use App\Repositories\propertyareasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class condomareasController extends AppBaseController
{
    /** @var  propertyareasRepository */
    private $propertyareasRepository;

    public function __construct(propertyareasRepository $propertyareasRepo)
    {
        $this->propertyareasRepository = $propertyareasRepo;
    }

    /**
     * Display a listing of the propertyareas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request,$inmuid)
    {
        $this->propertyareasRepository->pushCriteria(new RequestCriteria($request));       
        $propertyareas = $this->propertyareasRepository->gAreas($inmuid);        
        
        return view('condomareas.index')
            ->with('propertyareas', $propertyareas)
            ->with ('inmuid',$inmuid);

    }

    /**
     * Show the form for creating a new propertyareas.
     *
     * @return Response
     */
    public function create($inmuid)
    {
        
        return view('condomareas.create')
        ->with ('inmuid',$inmuid);
    }

    /**
     * Store a newly created propertyareas in storage.
     *
     * @param CreatepropertyareasRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyareasRequest $request)
    {
        $input = $request->all();
        $inmuid =$request->input('inmueble_id') ;
        $propertyareas = $this->propertyareasRepository->create($input);

        Flash::success('Area guardada correctamente');

        return redirect(route('condomareas.index',$inmuid));
    }

    /**
     * Display the specified propertyareas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id,$inmuid)
    {
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);

        if (empty($propertyareas)) {
            Flash::error('Area no localizada');

            return redirect(route('condomareas.index',$inmuid));
        }

        return view('condomareas.show')
        ->with('propertyareas', $propertyareas)
        ->with ('inmuid',$inmuid);
    }

    /**
     * Show the form for editing the specified propertyareas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id,$inmuid)
    {
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);          

        if (empty($propertyareas)) {
            Flash::error('Area no localizada');

            return redirect(route('condomareas.index',$inmuid));
        }

        return view('condomareas.edit')
        ->with('propertyareas', $propertyareas)
       ->with ('inmuid',$inmuid);
    }

    /**
     * Update the specified propertyareas in storage.
     *
     * @param  int              $id
     * @param UpdatepropertyareasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyareasRequest $request)
    {
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);
        $inmuid =$request->input('inmueble_id') ;
        if (empty($propertyareas)) {
            Flash::error('Area no localizada');

            return redirect(route('condomareas.index',$inmuid));
        }

        $propertyareas = $this->propertyareasRepository->update($request->all(), $id);
       
        Flash::success('Area actualizada correctamente.');

        return redirect(route('condomareas.index',$inmuid));
    }

    /**
     * Remove the specified propertyareas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id,$inmuid)
    {
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);

        if (empty($propertyareas)) {
            Flash::error('Area no localizada');

            return redirect(route('condomareas.index',$inmuid));
        }

        $this->propertyareasRepository->delete($id);

        Flash::success('Area eliminada.');

        return redirect(route('condomareas.index',$inmuid));
    }
}

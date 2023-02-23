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

class propertyareasController extends AppBaseController
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
    public function index(Request $request)
    {
        $this->propertyareasRepository->pushCriteria(new RequestCriteria($request));
        $propexpid = Session('propertyexpid');     
        $propertyareas = $this->propertyareasRepository->gAreas($propexpid);        
        //dd($propertyareas);
        return view('propertyareas.index')
            ->with('propertyareas', $propertyareas);

    }

    /**
     * Show the form for creating a new propertyareas.
     *
     * @return Response
     */
    public function create()
    {
        $propexpid = Session('propertyexpid');     
        return view('propertyareas.create')
         ->with('propexpid',$propexpid );
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

        $propertyareas = $this->propertyareasRepository->create($input);

        Flash::success('Propertyareas saved successfully.');

        return redirect(route('propertyareas.index'));
    }

    /**
     * Display the specified propertyareas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);

        if (empty($propertyareas)) {
            Flash::error('Propertyareas not found');

            return redirect(route('propertyareas.index'));
        }

        return view('propertyareas.show')->with('propertyareas', $propertyareas);
    }

    /**
     * Show the form for editing the specified propertyareas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);
        $propexpid = Session('propertyexpid');     

        if (empty($propertyareas)) {
            Flash::error('Propertyareas not found');

            return redirect(route('propertyareas.index'));
        }

        return view('propertyareas.edit')
        ->with('propertyareas', $propertyareas)
        ->with('propexpid', $propexpid)
        ;
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

        if (empty($propertyareas)) {
            Flash::error('Propertyareas not found');

            return redirect(route('propertyareas.index'));
        }

        $propertyareas = $this->propertyareasRepository->update($request->all(), $id);

        Flash::success('Propertyareas updated successfully.');

        return redirect(route('propertyareas.index'));
    }

    /**
     * Remove the specified propertyareas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);

        if (empty($propertyareas)) {
            Flash::error('Propertyareas not found');

            return redirect(route('propertyareas.index'));
        }

        $this->propertyareasRepository->delete($id);

        Flash::success('Propertyareas deleted successfully.');

        return redirect(route('propertyareas.index'));
    }
}

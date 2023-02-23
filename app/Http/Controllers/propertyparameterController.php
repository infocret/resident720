<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatepropertyparameterRequest;
use App\Http\Requests\UpdatepropertyparameterRequest;
use App\Repositories\propertyparameterRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class propertyparameterController extends AppBaseController
{
    /** @var  propertyparameterRepository */
    private $propertyparameterRepository;

    public function __construct(propertyparameterRepository $propertyparameterRepo)
    {
        $this->propertyparameterRepository = $propertyparameterRepo;
    }

    /**
     * Display a listing of the propertyparameter.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propertyparameterRepository->pushCriteria(new RequestCriteria($request));
        $propertyparameters = $this->propertyparameterRepository->all();

        return view('propertyparameters.index')
            ->with('propertyparameters', $propertyparameters);
    }

    /**
     * Show the form for creating a new propertyparameter.
     *
     * @return Response
     */
    public function create()
    {
        return view('propertyparameters.create');
    }

    /**
     * Store a newly created propertyparameter in storage.
     *
     * @param CreatepropertyparameterRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyparameterRequest $request)
    {
        $input = $request->all();
        //dd($input);
        $propertyparameter = $this->propertyparameterRepository->create($input);

        Flash::success('Propertyparameter saved successfully.');

        return redirect(route('propertyparameters.index'));
    }

    /**
     * Display the specified propertyparameter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            Flash::error('Propertyparameter not found');

            return redirect(route('propertyparameters.index'));
        }

        return view('propertyparameters.show')->with('propertyparameter', $propertyparameter);
    }

    /**
     * Show the form for editing the specified propertyparameter.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            Flash::error('Propertyparameter not found');

            return redirect(route('propertyparameters.index'));
        }

        return view('propertyparameters.edit')->with('propertyparameter', $propertyparameter);
    }

    /**
     * Update the specified propertyparameter in storage.
     *
     * @param  int              $id
     * @param UpdatepropertyparameterRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyparameterRequest $request)
    {
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            Flash::error('Propertyparameter not found');

            return redirect(route('propertyparameters.index'));
        }

        $propertyparameter = $this->propertyparameterRepository->update($request->all(), $id);

        Flash::success('Propertyparameter updated successfully.');

        return redirect(route('propertyparameters.index'));
    }

    /**
     * Remove the specified propertyparameter from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            Flash::error('Propertyparameter not found');

            return redirect(route('propertyparameters.index'));
        }

        $this->propertyparameterRepository->delete($id);

        Flash::success('Propertyparameter deleted successfully.');

        return redirect(route('propertyparameters.index'));
    }
}

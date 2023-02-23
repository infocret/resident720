<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepropertyparameterAPIRequest;
use App\Http\Requests\API\UpdatepropertyparameterAPIRequest;
use App\Models\propertyparameter;
use App\Repositories\propertyparameterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class propertyparameterController
 * @package App\Http\Controllers\API
 */

class propertyparameterAPIController extends AppBaseController
{
    /** @var  propertyparameterRepository */
    private $propertyparameterRepository;

    public function __construct(propertyparameterRepository $propertyparameterRepo)
    {
        $this->propertyparameterRepository = $propertyparameterRepo;
    }

    /**
     * Display a listing of the propertyparameter.
     * GET|HEAD /propertyparameters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propertyparameterRepository->pushCriteria(new RequestCriteria($request));
        $this->propertyparameterRepository->pushCriteria(new LimitOffsetCriteria($request));
        $propertyparameters = $this->propertyparameterRepository->all();

        return $this->sendResponse($propertyparameters->toArray(), 'Propertyparameters retrieved successfully');
    }

    /**
     * Store a newly created propertyparameter in storage.
     * POST /propertyparameters
     *
     * @param CreatepropertyparameterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyparameterAPIRequest $request)
    {
        $input = $request->all();

        $propertyparameters = $this->propertyparameterRepository->create($input);

        return $this->sendResponse($propertyparameters->toArray(), 'Propertyparameter saved successfully');
    }

    /**
     * Display the specified propertyparameter.
     * GET|HEAD /propertyparameters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var propertyparameter $propertyparameter */
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            return $this->sendError('Propertyparameter not found');
        }

        return $this->sendResponse($propertyparameter->toArray(), 'Propertyparameter retrieved successfully');
    }

    /**
     * Update the specified propertyparameter in storage.
     * PUT/PATCH /propertyparameters/{id}
     *
     * @param  int $id
     * @param UpdatepropertyparameterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyparameterAPIRequest $request)
    {
        $input = $request->all();

        /** @var propertyparameter $propertyparameter */
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            return $this->sendError('Propertyparameter not found');
        }

        $propertyparameter = $this->propertyparameterRepository->update($input, $id);

        return $this->sendResponse($propertyparameter->toArray(), 'propertyparameter updated successfully');
    }

    /**
     * Remove the specified propertyparameter from storage.
     * DELETE /propertyparameters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var propertyparameter $propertyparameter */
        $propertyparameter = $this->propertyparameterRepository->findWithoutFail($id);

        if (empty($propertyparameter)) {
            return $this->sendError('Propertyparameter not found');
        }

        $propertyparameter->delete();

        return $this->sendResponse($id, 'Propertyparameter deleted successfully');
    }
}

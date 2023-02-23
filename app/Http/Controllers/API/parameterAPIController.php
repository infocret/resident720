<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateparameterAPIRequest;
use App\Http\Requests\API\UpdateparameterAPIRequest;
use App\Models\parameter;
use App\Repositories\parameterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class parameterController
 * @package App\Http\Controllers\API
 */

class parameterAPIController extends AppBaseController
{
    /** @var  parameterRepository */
    private $parameterRepository;

    public function __construct(parameterRepository $parameterRepo)
    {
        $this->parameterRepository = $parameterRepo;
    }

    /**
     * Display a listing of the parameter.
     * GET|HEAD /parameters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->parameterRepository->pushCriteria(new RequestCriteria($request));
        $this->parameterRepository->pushCriteria(new LimitOffsetCriteria($request));
        $parameters = $this->parameterRepository->all();

        return $this->sendResponse($parameters->toArray(), 'Parameters retrieved successfully');
    }

    /**
     * Store a newly created parameter in storage.
     * POST /parameters
     *
     * @param CreateparameterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateparameterAPIRequest $request)
    {
        $input = $request->all();

        $parameters = $this->parameterRepository->create($input);

        return $this->sendResponse($parameters->toArray(), 'Parameter saved successfully');
    }

    /**
     * Display the specified parameter.
     * GET|HEAD /parameters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var parameter $parameter */
        $parameter = $this->parameterRepository->findWithoutFail($id);

        if (empty($parameter)) {
            return $this->sendError('Parameter not found');
        }

        return $this->sendResponse($parameter->toArray(), 'Parameter retrieved successfully');
    }

    /**
     * Update the specified parameter in storage.
     * PUT/PATCH /parameters/{id}
     *
     * @param  int $id
     * @param UpdateparameterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateparameterAPIRequest $request)
    {
        $input = $request->all();

        /** @var parameter $parameter */
        $parameter = $this->parameterRepository->findWithoutFail($id);

        if (empty($parameter)) {
            return $this->sendError('Parameter not found');
        }

        $parameter = $this->parameterRepository->update($input, $id);

        return $this->sendResponse($parameter->toArray(), 'parameter updated successfully');
    }

    /**
     * Remove the specified parameter from storage.
     * DELETE /parameters/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var parameter $parameter */
        $parameter = $this->parameterRepository->findWithoutFail($id);

        if (empty($parameter)) {
            return $this->sendError('Parameter not found');
        }

        $parameter->delete();

        return $this->sendResponse($id, 'Parameter deleted successfully');
    }
}

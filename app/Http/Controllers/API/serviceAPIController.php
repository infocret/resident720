<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateserviceAPIRequest;
use App\Http\Requests\API\UpdateserviceAPIRequest;
use App\Models\service;
use App\Repositories\serviceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class serviceController
 * @package App\Http\Controllers\API
 */

class serviceAPIController extends AppBaseController
{
    /** @var  serviceRepository */
    private $serviceRepository;

    public function __construct(serviceRepository $serviceRepo)
    {
        $this->serviceRepository = $serviceRepo;
    }

    /**
     * Display a listing of the service.
     * GET|HEAD /services
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->serviceRepository->pushCriteria(new RequestCriteria($request));
        $this->serviceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $services = $this->serviceRepository->all();

        return $this->sendResponse($services->toArray(), 'Services retrieved successfully');
    }

    /**
     * Store a newly created service in storage.
     * POST /services
     *
     * @param CreateserviceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateserviceAPIRequest $request)
    {
        $input = $request->all();

        $services = $this->serviceRepository->create($input);

        return $this->sendResponse($services->toArray(), 'Service saved successfully');
    }

    /**
     * Display the specified service.
     * GET|HEAD /services/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var service $service */
        $service = $this->serviceRepository->findWithoutFail($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        return $this->sendResponse($service->toArray(), 'Service retrieved successfully');
    }

    /**
     * Update the specified service in storage.
     * PUT/PATCH /services/{id}
     *
     * @param  int $id
     * @param UpdateserviceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateserviceAPIRequest $request)
    {
        $input = $request->all();

        /** @var service $service */
        $service = $this->serviceRepository->findWithoutFail($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        $service = $this->serviceRepository->update($input, $id);

        return $this->sendResponse($service->toArray(), 'service updated successfully');
    }

    /**
     * Remove the specified service from storage.
     * DELETE /services/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var service $service */
        $service = $this->serviceRepository->findWithoutFail($id);

        if (empty($service)) {
            return $this->sendError('Service not found');
        }

        $service->delete();

        return $this->sendResponse($id, 'Service deleted successfully');
    }
}

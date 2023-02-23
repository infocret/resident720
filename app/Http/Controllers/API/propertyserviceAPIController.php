<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepropertyserviceAPIRequest;
use App\Http\Requests\API\UpdatepropertyserviceAPIRequest;
use App\Models\propertyservice;
use App\Repositories\propertyserviceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class propertyserviceController
 * @package App\Http\Controllers\API
 */

class propertyserviceAPIController extends AppBaseController
{
    /** @var  propertyserviceRepository */
    private $propertyserviceRepository;

    public function __construct(propertyserviceRepository $propertyserviceRepo)
    {
        $this->propertyserviceRepository = $propertyserviceRepo;
    }

    /**
     * Display a listing of the propertyservice.
     * GET|HEAD /propertyservices
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propertyserviceRepository->pushCriteria(new RequestCriteria($request));
        $this->propertyserviceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $propertyservices = $this->propertyserviceRepository->all();

        return $this->sendResponse($propertyservices->toArray(), 'Propertyservices retrieved successfully');
    }

    /**
     * Store a newly created propertyservice in storage.
     * POST /propertyservices
     *
     * @param CreatepropertyserviceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyserviceAPIRequest $request)
    {
        $input = $request->all();

        $propertyservices = $this->propertyserviceRepository->create($input);

        return $this->sendResponse($propertyservices->toArray(), 'Propertyservice saved successfully');
    }

    /**
     * Display the specified propertyservice.
     * GET|HEAD /propertyservices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var propertyservice $propertyservice */
        $propertyservice = $this->propertyserviceRepository->findWithoutFail($id);

        if (empty($propertyservice)) {
            return $this->sendError('Propertyservice not found');
        }

        return $this->sendResponse($propertyservice->toArray(), 'Propertyservice retrieved successfully');
    }

    /**
     * Update the specified propertyservice in storage.
     * PUT/PATCH /propertyservices/{id}
     *
     * @param  int $id
     * @param UpdatepropertyserviceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyserviceAPIRequest $request)
    {
        $input = $request->all();

        /** @var propertyservice $propertyservice */
        $propertyservice = $this->propertyserviceRepository->findWithoutFail($id);

        if (empty($propertyservice)) {
            return $this->sendError('Propertyservice not found');
        }

        $propertyservice = $this->propertyserviceRepository->update($input, $id);

        return $this->sendResponse($propertyservice->toArray(), 'propertyservice updated successfully');
    }

    /**
     * Remove the specified propertyservice from storage.
     * DELETE /propertyservices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var propertyservice $propertyservice */
        $propertyservice = $this->propertyserviceRepository->findWithoutFail($id);

        if (empty($propertyservice)) {
            return $this->sendError('Propertyservice not found');
        }

        $propertyservice->delete();

        return $this->sendResponse($id, 'Propertyservice deleted successfully');
    }
}

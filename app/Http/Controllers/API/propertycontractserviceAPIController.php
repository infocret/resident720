<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepropertycontractserviceAPIRequest;
use App\Http\Requests\API\UpdatepropertycontractserviceAPIRequest;
use App\Models\propertycontractservice;
use App\Repositories\propertycontractserviceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class propertycontractserviceController
 * @package App\Http\Controllers\API
 */

class propertycontractserviceAPIController extends AppBaseController
{
    /** @var  propertycontractserviceRepository */
    private $propertycontractserviceRepository;

    public function __construct(propertycontractserviceRepository $propertycontractserviceRepo)
    {
        $this->propertycontractserviceRepository = $propertycontractserviceRepo;
    }

    /**
     * Display a listing of the propertycontractservice.
     * GET|HEAD /propertycontractservices
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propertycontractserviceRepository->pushCriteria(new RequestCriteria($request));
        $this->propertycontractserviceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $propertycontractservices = $this->propertycontractserviceRepository->all();

        return $this->sendResponse($propertycontractservices->toArray(), 'Propertycontractservices retrieved successfully');
    }

    /**
     * Store a newly created propertycontractservice in storage.
     * POST /propertycontractservices
     *
     * @param CreatepropertycontractserviceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertycontractserviceAPIRequest $request)
    {
        $input = $request->all();

        $propertycontractservices = $this->propertycontractserviceRepository->create($input);

        return $this->sendResponse($propertycontractservices->toArray(), 'Propertycontractservice saved successfully');
    }

    /**
     * Display the specified propertycontractservice.
     * GET|HEAD /propertycontractservices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var propertycontractservice $propertycontractservice */
        $propertycontractservice = $this->propertycontractserviceRepository->findWithoutFail($id);

        if (empty($propertycontractservice)) {
            return $this->sendError('Propertycontractservice not found');
        }

        return $this->sendResponse($propertycontractservice->toArray(), 'Propertycontractservice retrieved successfully');
    }

    /**
     * Update the specified propertycontractservice in storage.
     * PUT/PATCH /propertycontractservices/{id}
     *
     * @param  int $id
     * @param UpdatepropertycontractserviceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertycontractserviceAPIRequest $request)
    {
        $input = $request->all();

        /** @var propertycontractservice $propertycontractservice */
        $propertycontractservice = $this->propertycontractserviceRepository->findWithoutFail($id);

        if (empty($propertycontractservice)) {
            return $this->sendError('Propertycontractservice not found');
        }

        $propertycontractservice = $this->propertycontractserviceRepository->update($input, $id);

        return $this->sendResponse($propertycontractservice->toArray(), 'propertycontractservice updated successfully');
    }

    /**
     * Remove the specified propertycontractservice from storage.
     * DELETE /propertycontractservices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var propertycontractservice $propertycontractservice */
        $propertycontractservice = $this->propertycontractserviceRepository->findWithoutFail($id);

        if (empty($propertycontractservice)) {
            return $this->sendError('Propertycontractservice not found');
        }

        $propertycontractservice->delete();

        return $this->sendResponse($id, 'Propertycontractservice deleted successfully');
    }
}

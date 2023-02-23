<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateconceptserviceAPIRequest;
use App\Http\Requests\API\UpdateconceptserviceAPIRequest;
use App\Models\conceptservice;
use App\Repositories\conceptserviceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class conceptserviceController
 * @package App\Http\Controllers\API
 */

class conceptserviceAPIController extends AppBaseController
{
    /** @var  conceptserviceRepository */
    private $conceptserviceRepository;

    public function __construct(conceptserviceRepository $conceptserviceRepo)
    {
        $this->conceptserviceRepository = $conceptserviceRepo;
    }

    /**
     * Display a listing of the conceptservice.
     * GET|HEAD /conceptservices
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->conceptserviceRepository->pushCriteria(new RequestCriteria($request));
        $this->conceptserviceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $conceptservices = $this->conceptserviceRepository->all();

        return $this->sendResponse($conceptservices->toArray(), 'Conceptservices retrieved successfully');
    }

    /**
     * Store a newly created conceptservice in storage.
     * POST /conceptservices
     *
     * @param CreateconceptserviceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateconceptserviceAPIRequest $request)
    {
        $input = $request->all();

        $conceptservices = $this->conceptserviceRepository->create($input);

        return $this->sendResponse($conceptservices->toArray(), 'Conceptservice saved successfully');
    }

    /**
     * Display the specified conceptservice.
     * GET|HEAD /conceptservices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var conceptservice $conceptservice */
        $conceptservice = $this->conceptserviceRepository->findWithoutFail($id);

        if (empty($conceptservice)) {
            return $this->sendError('Conceptservice not found');
        }

        return $this->sendResponse($conceptservice->toArray(), 'Conceptservice retrieved successfully');
    }

    /**
     * Update the specified conceptservice in storage.
     * PUT/PATCH /conceptservices/{id}
     *
     * @param  int $id
     * @param UpdateconceptserviceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateconceptserviceAPIRequest $request)
    {
        $input = $request->all();

        /** @var conceptservice $conceptservice */
        $conceptservice = $this->conceptserviceRepository->findWithoutFail($id);

        if (empty($conceptservice)) {
            return $this->sendError('Conceptservice not found');
        }

        $conceptservice = $this->conceptserviceRepository->update($input, $id);

        return $this->sendResponse($conceptservice->toArray(), 'conceptservice updated successfully');
    }

    /**
     * Remove the specified conceptservice from storage.
     * DELETE /conceptservices/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var conceptservice $conceptservice */
        $conceptservice = $this->conceptserviceRepository->findWithoutFail($id);

        if (empty($conceptservice)) {
            return $this->sendError('Conceptservice not found');
        }

        $conceptservice->delete();

        return $this->sendResponse($id, 'Conceptservice deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreategasconsumptionAPIRequest;
use App\Http\Requests\API\UpdategasconsumptionAPIRequest;
use App\Models\gasconsumption;
use App\Repositories\gasconsumptionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class gasconsumptionController
 * @package App\Http\Controllers\API
 */

class gasconsumptionAPIController extends AppBaseController
{
    /** @var  gasconsumptionRepository */
    private $gasconsumptionRepository;

    public function __construct(gasconsumptionRepository $gasconsumptionRepo)
    {
        $this->gasconsumptionRepository = $gasconsumptionRepo;
    }

    /**
     * Display a listing of the gasconsumption.
     * GET|HEAD /gasconsumptions
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->gasconsumptionRepository->pushCriteria(new RequestCriteria($request));
        $this->gasconsumptionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $gasconsumptions = $this->gasconsumptionRepository->all();

        return $this->sendResponse($gasconsumptions->toArray(), 'Gasconsumptions retrieved successfully');
    }

    /**
     * Store a newly created gasconsumption in storage.
     * POST /gasconsumptions
     *
     * @param CreategasconsumptionAPIRequest $request
     *
     * @return Response
     */
    public function store(CreategasconsumptionAPIRequest $request)
    {
        $input = $request->all();

        $gasconsumptions = $this->gasconsumptionRepository->create($input);

        return $this->sendResponse($gasconsumptions->toArray(), 'Gasconsumption saved successfully');
    }

    /**
     * Display the specified gasconsumption.
     * GET|HEAD /gasconsumptions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var gasconsumption $gasconsumption */
        $gasconsumption = $this->gasconsumptionRepository->findWithoutFail($id);

        if (empty($gasconsumption)) {
            return $this->sendError('Gasconsumption not found');
        }

        return $this->sendResponse($gasconsumption->toArray(), 'Gasconsumption retrieved successfully');
    }

    /**
     * Update the specified gasconsumption in storage.
     * PUT/PATCH /gasconsumptions/{id}
     *
     * @param  int $id
     * @param UpdategasconsumptionAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdategasconsumptionAPIRequest $request)
    {
        $input = $request->all();

        /** @var gasconsumption $gasconsumption */
        $gasconsumption = $this->gasconsumptionRepository->findWithoutFail($id);

        if (empty($gasconsumption)) {
            return $this->sendError('Gasconsumption not found');
        }

        $gasconsumption = $this->gasconsumptionRepository->update($input, $id);

        return $this->sendResponse($gasconsumption->toArray(), 'gasconsumption updated successfully');
    }

    /**
     * Remove the specified gasconsumption from storage.
     * DELETE /gasconsumptions/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var gasconsumption $gasconsumption */
        $gasconsumption = $this->gasconsumptionRepository->findWithoutFail($id);

        if (empty($gasconsumption)) {
            return $this->sendError('Gasconsumption not found');
        }

        $gasconsumption->delete();

        return $this->sendResponse($id, 'Gasconsumption deleted successfully');
    }
}

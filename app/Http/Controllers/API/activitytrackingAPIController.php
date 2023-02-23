<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateactivitytrackingAPIRequest;
use App\Http\Requests\API\UpdateactivitytrackingAPIRequest;
use App\Models\activitytracking;
use App\Repositories\activitytrackingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class activitytrackingController
 * @package App\Http\Controllers\API
 */

class activitytrackingAPIController extends AppBaseController
{
    /** @var  activitytrackingRepository */
    private $activitytrackingRepository;

    public function __construct(activitytrackingRepository $activitytrackingRepo)
    {
        $this->activitytrackingRepository = $activitytrackingRepo;
    }

    /**
     * Display a listing of the activitytracking.
     * GET|HEAD /activitytrackings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->activitytrackingRepository->pushCriteria(new RequestCriteria($request));
        $this->activitytrackingRepository->pushCriteria(new LimitOffsetCriteria($request));
        $activitytrackings = $this->activitytrackingRepository->all();

        return $this->sendResponse($activitytrackings->toArray(), 'Activitytrackings retrieved successfully');
    }

    /**
     * Store a newly created activitytracking in storage.
     * POST /activitytrackings
     *
     * @param CreateactivitytrackingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateactivitytrackingAPIRequest $request)
    {
        $input = $request->all();

        $activitytrackings = $this->activitytrackingRepository->create($input);

        return $this->sendResponse($activitytrackings->toArray(), 'Activitytracking saved successfully');
    }

    /**
     * Display the specified activitytracking.
     * GET|HEAD /activitytrackings/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var activitytracking $activitytracking */
        $activitytracking = $this->activitytrackingRepository->findWithoutFail($id);

        if (empty($activitytracking)) {
            return $this->sendError('Activitytracking not found');
        }

        return $this->sendResponse($activitytracking->toArray(), 'Activitytracking retrieved successfully');
    }

    /**
     * Update the specified activitytracking in storage.
     * PUT/PATCH /activitytrackings/{id}
     *
     * @param  int $id
     * @param UpdateactivitytrackingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateactivitytrackingAPIRequest $request)
    {
        $input = $request->all();

        /** @var activitytracking $activitytracking */
        $activitytracking = $this->activitytrackingRepository->findWithoutFail($id);

        if (empty($activitytracking)) {
            return $this->sendError('Activitytracking not found');
        }

        $activitytracking = $this->activitytrackingRepository->update($input, $id);

        return $this->sendResponse($activitytracking->toArray(), 'activitytracking updated successfully');
    }

    /**
     * Remove the specified activitytracking from storage.
     * DELETE /activitytrackings/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var activitytracking $activitytracking */
        $activitytracking = $this->activitytrackingRepository->findWithoutFail($id);

        if (empty($activitytracking)) {
            return $this->sendError('Activitytracking not found');
        }

        $activitytracking->delete();

        return $this->sendResponse($id, 'Activitytracking deleted successfully');
    }
}

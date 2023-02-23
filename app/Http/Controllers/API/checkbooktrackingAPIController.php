<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecheckbooktrackingAPIRequest;
use App\Http\Requests\API\UpdatecheckbooktrackingAPIRequest;
use App\Models\checkbooktracking;
use App\Repositories\checkbooktrackingRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class checkbooktrackingController
 * @package App\Http\Controllers\API
 */

class checkbooktrackingAPIController extends AppBaseController
{
    /** @var  checkbooktrackingRepository */
    private $checkbooktrackingRepository;

    public function __construct(checkbooktrackingRepository $checkbooktrackingRepo)
    {
        $this->checkbooktrackingRepository = $checkbooktrackingRepo;
    }

    /**
     * Display a listing of the checkbooktracking.
     * GET|HEAD /checkbooktrackings
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->checkbooktrackingRepository->pushCriteria(new RequestCriteria($request));
        $this->checkbooktrackingRepository->pushCriteria(new LimitOffsetCriteria($request));
        $checkbooktrackings = $this->checkbooktrackingRepository->all();

        return $this->sendResponse($checkbooktrackings->toArray(), 'Checkbooktrackings retrieved successfully');
    }

    /**
     * Store a newly created checkbooktracking in storage.
     * POST /checkbooktrackings
     *
     * @param CreatecheckbooktrackingAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecheckbooktrackingAPIRequest $request)
    {
        $input = $request->all();

        $checkbooktrackings = $this->checkbooktrackingRepository->create($input);

        return $this->sendResponse($checkbooktrackings->toArray(), 'Checkbooktracking saved successfully');
    }

    /**
     * Display the specified checkbooktracking.
     * GET|HEAD /checkbooktrackings/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var checkbooktracking $checkbooktracking */
        $checkbooktracking = $this->checkbooktrackingRepository->findWithoutFail($id);

        if (empty($checkbooktracking)) {
            return $this->sendError('Checkbooktracking not found');
        }

        return $this->sendResponse($checkbooktracking->toArray(), 'Checkbooktracking retrieved successfully');
    }

    /**
     * Update the specified checkbooktracking in storage.
     * PUT/PATCH /checkbooktrackings/{id}
     *
     * @param  int $id
     * @param UpdatecheckbooktrackingAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecheckbooktrackingAPIRequest $request)
    {
        $input = $request->all();

        /** @var checkbooktracking $checkbooktracking */
        $checkbooktracking = $this->checkbooktrackingRepository->findWithoutFail($id);

        if (empty($checkbooktracking)) {
            return $this->sendError('Checkbooktracking not found');
        }

        $checkbooktracking = $this->checkbooktrackingRepository->update($input, $id);

        return $this->sendResponse($checkbooktracking->toArray(), 'checkbooktracking updated successfully');
    }

    /**
     * Remove the specified checkbooktracking from storage.
     * DELETE /checkbooktrackings/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var checkbooktracking $checkbooktracking */
        $checkbooktracking = $this->checkbooktrackingRepository->findWithoutFail($id);

        if (empty($checkbooktracking)) {
            return $this->sendError('Checkbooktracking not found');
        }

        $checkbooktracking->delete();

        return $this->sendResponse($id, 'Checkbooktracking deleted successfully');
    }
}

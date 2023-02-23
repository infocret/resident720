<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecheckbookprintAPIRequest;
use App\Http\Requests\API\UpdatecheckbookprintAPIRequest;
use App\Models\checkbookprint;
use App\Repositories\checkbookprintRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class checkbookprintController
 * @package App\Http\Controllers\API
 */

class checkbookprintAPIController extends AppBaseController
{
    /** @var  checkbookprintRepository */
    private $checkbookprintRepository;

    public function __construct(checkbookprintRepository $checkbookprintRepo)
    {
        $this->checkbookprintRepository = $checkbookprintRepo;
    }

    /**
     * Display a listing of the checkbookprint.
     * GET|HEAD /checkbookprints
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->checkbookprintRepository->pushCriteria(new RequestCriteria($request));
        $this->checkbookprintRepository->pushCriteria(new LimitOffsetCriteria($request));
        $checkbookprints = $this->checkbookprintRepository->all();

        return $this->sendResponse($checkbookprints->toArray(), 'Checkbookprints retrieved successfully');
    }

    /**
     * Store a newly created checkbookprint in storage.
     * POST /checkbookprints
     *
     * @param CreatecheckbookprintAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecheckbookprintAPIRequest $request)
    {
        $input = $request->all();

        $checkbookprints = $this->checkbookprintRepository->create($input);

        return $this->sendResponse($checkbookprints->toArray(), 'Checkbookprint saved successfully');
    }

    /**
     * Display the specified checkbookprint.
     * GET|HEAD /checkbookprints/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var checkbookprint $checkbookprint */
        $checkbookprint = $this->checkbookprintRepository->findWithoutFail($id);

        if (empty($checkbookprint)) {
            return $this->sendError('Checkbookprint not found');
        }

        return $this->sendResponse($checkbookprint->toArray(), 'Checkbookprint retrieved successfully');
    }

    /**
     * Update the specified checkbookprint in storage.
     * PUT/PATCH /checkbookprints/{id}
     *
     * @param  int $id
     * @param UpdatecheckbookprintAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecheckbookprintAPIRequest $request)
    {
        $input = $request->all();

        /** @var checkbookprint $checkbookprint */
        $checkbookprint = $this->checkbookprintRepository->findWithoutFail($id);

        if (empty($checkbookprint)) {
            return $this->sendError('Checkbookprint not found');
        }

        $checkbookprint = $this->checkbookprintRepository->update($input, $id);

        return $this->sendResponse($checkbookprint->toArray(), 'checkbookprint updated successfully');
    }

    /**
     * Remove the specified checkbookprint from storage.
     * DELETE /checkbookprints/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var checkbookprint $checkbookprint */
        $checkbookprint = $this->checkbookprintRepository->findWithoutFail($id);

        if (empty($checkbookprint)) {
            return $this->sendError('Checkbookprint not found');
        }

        $checkbookprint->delete();

        return $this->sendResponse($id, 'Checkbookprint deleted successfully');
    }
}

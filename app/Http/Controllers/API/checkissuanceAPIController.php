<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecheckissuanceAPIRequest;
use App\Http\Requests\API\UpdatecheckissuanceAPIRequest;
use App\Models\checkissuance;
use App\Repositories\checkissuanceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class checkissuanceController
 * @package App\Http\Controllers\API
 */

class checkissuanceAPIController extends AppBaseController
{
    /** @var  checkissuanceRepository */
    private $checkissuanceRepository;

    public function __construct(checkissuanceRepository $checkissuanceRepo)
    {
        $this->checkissuanceRepository = $checkissuanceRepo;
    }

    /**
     * Display a listing of the checkissuance.
     * GET|HEAD /checkissuances
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->checkissuanceRepository->pushCriteria(new RequestCriteria($request));
        $this->checkissuanceRepository->pushCriteria(new LimitOffsetCriteria($request));
        $checkissuances = $this->checkissuanceRepository->all();

        return $this->sendResponse($checkissuances->toArray(), 'Checkissuances retrieved successfully');
    }

    /**
     * Store a newly created checkissuance in storage.
     * POST /checkissuances
     *
     * @param CreatecheckissuanceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecheckissuanceAPIRequest $request)
    {
        $input = $request->all();

        $checkissuances = $this->checkissuanceRepository->create($input);

        return $this->sendResponse($checkissuances->toArray(), 'Checkissuance saved successfully');
    }

    /**
     * Display the specified checkissuance.
     * GET|HEAD /checkissuances/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var checkissuance $checkissuance */
        $checkissuance = $this->checkissuanceRepository->findWithoutFail($id);

        if (empty($checkissuance)) {
            return $this->sendError('Checkissuance not found');
        }

        return $this->sendResponse($checkissuance->toArray(), 'Checkissuance retrieved successfully');
    }

    /**
     * Update the specified checkissuance in storage.
     * PUT/PATCH /checkissuances/{id}
     *
     * @param  int $id
     * @param UpdatecheckissuanceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecheckissuanceAPIRequest $request)
    {
        $input = $request->all();

        /** @var checkissuance $checkissuance */
        $checkissuance = $this->checkissuanceRepository->findWithoutFail($id);

        if (empty($checkissuance)) {
            return $this->sendError('Checkissuance not found');
        }

        $checkissuance = $this->checkissuanceRepository->update($input, $id);

        return $this->sendResponse($checkissuance->toArray(), 'checkissuance updated successfully');
    }

    /**
     * Remove the specified checkissuance from storage.
     * DELETE /checkissuances/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var checkissuance $checkissuance */
        $checkissuance = $this->checkissuanceRepository->findWithoutFail($id);

        if (empty($checkissuance)) {
            return $this->sendError('Checkissuance not found');
        }

        $checkissuance->delete();

        return $this->sendResponse($id, 'Checkissuance deleted successfully');
    }
}

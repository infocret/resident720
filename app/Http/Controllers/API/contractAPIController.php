<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecontractAPIRequest;
use App\Http\Requests\API\UpdatecontractAPIRequest;
use App\Models\contract;
use App\Repositories\contractRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class contractController
 * @package App\Http\Controllers\API
 */

class contractAPIController extends AppBaseController
{
    /** @var  contractRepository */
    private $contractRepository;

    public function __construct(contractRepository $contractRepo)
    {
        $this->contractRepository = $contractRepo;
    }

    /**
     * Display a listing of the contract.
     * GET|HEAD /contracts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->contractRepository->pushCriteria(new RequestCriteria($request));
        $this->contractRepository->pushCriteria(new LimitOffsetCriteria($request));
        $contracts = $this->contractRepository->all();

        return $this->sendResponse($contracts->toArray(), 'Contracts retrieved successfully');
    }

    /**
     * Store a newly created contract in storage.
     * POST /contracts
     *
     * @param CreatecontractAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecontractAPIRequest $request)
    {
        $input = $request->all();

        $contracts = $this->contractRepository->create($input);

        return $this->sendResponse($contracts->toArray(), 'Contract saved successfully');
    }

    /**
     * Display the specified contract.
     * GET|HEAD /contracts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var contract $contract */
        $contract = $this->contractRepository->findWithoutFail($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        return $this->sendResponse($contract->toArray(), 'Contract retrieved successfully');
    }

    /**
     * Update the specified contract in storage.
     * PUT/PATCH /contracts/{id}
     *
     * @param  int $id
     * @param UpdatecontractAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecontractAPIRequest $request)
    {
        $input = $request->all();

        /** @var contract $contract */
        $contract = $this->contractRepository->findWithoutFail($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        $contract = $this->contractRepository->update($input, $id);

        return $this->sendResponse($contract->toArray(), 'contract updated successfully');
    }

    /**
     * Remove the specified contract from storage.
     * DELETE /contracts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var contract $contract */
        $contract = $this->contractRepository->findWithoutFail($id);

        if (empty($contract)) {
            return $this->sendError('Contract not found');
        }

        $contract->delete();

        return $this->sendResponse($id, 'Contract deleted successfully');
    }
}

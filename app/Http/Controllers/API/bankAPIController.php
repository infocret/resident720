<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatebankAPIRequest;
use App\Http\Requests\API\UpdatebankAPIRequest;
use App\Models\bank;
use App\Repositories\bankRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class bankController
 * @package App\Http\Controllers\API
 */

class bankAPIController extends AppBaseController
{
    /** @var  bankRepository */
    private $bankRepository;

    public function __construct(bankRepository $bankRepo)
    {
        $this->bankRepository = $bankRepo;
    }

    /**
     * Display a listing of the bank.
     * GET|HEAD /banks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bankRepository->pushCriteria(new RequestCriteria($request));
        $this->bankRepository->pushCriteria(new LimitOffsetCriteria($request));
        $banks = $this->bankRepository->all();

        return $this->sendResponse($banks->toArray(), 'Banks retrieved successfully');
    }

    /**
     * Store a newly created bank in storage.
     * POST /banks
     *
     * @param CreatebankAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatebankAPIRequest $request)
    {
        $input = $request->all();

        $banks = $this->bankRepository->create($input);

        return $this->sendResponse($banks->toArray(), 'Bank saved successfully');
    }

    /**
     * Display the specified bank.
     * GET|HEAD /banks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var bank $bank */
        $bank = $this->bankRepository->findWithoutFail($id);

        if (empty($bank)) {
            return $this->sendError('Bank not found');
        }

        return $this->sendResponse($bank->toArray(), 'Bank retrieved successfully');
    }

    /**
     * Update the specified bank in storage.
     * PUT/PATCH /banks/{id}
     *
     * @param  int $id
     * @param UpdatebankAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebankAPIRequest $request)
    {
        $input = $request->all();

        /** @var bank $bank */
        $bank = $this->bankRepository->findWithoutFail($id);

        if (empty($bank)) {
            return $this->sendError('Bank not found');
        }

        $bank = $this->bankRepository->update($input, $id);

        return $this->sendResponse($bank->toArray(), 'bank updated successfully');
    }

    /**
     * Remove the specified bank from storage.
     * DELETE /banks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var bank $bank */
        $bank = $this->bankRepository->findWithoutFail($id);

        if (empty($bank)) {
            return $this->sendError('Bank not found');
        }

        $bank->delete();

        return $this->sendResponse($id, 'Bank deleted successfully');
    }
}

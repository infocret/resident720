<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatebankaccountAPIRequest;
use App\Http\Requests\API\UpdatebankaccountAPIRequest;
use App\Models\bankaccount;
use App\Repositories\bankaccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class bankaccountController
 * @package App\Http\Controllers\API
 */

class bankaccountAPIController extends AppBaseController
{
    /** @var  bankaccountRepository */
    private $bankaccountRepository;

    public function __construct(bankaccountRepository $bankaccountRepo)
    {
        $this->bankaccountRepository = $bankaccountRepo;
    }

    /**
     * Display a listing of the bankaccount.
     * GET|HEAD /bankaccounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bankaccountRepository->pushCriteria(new RequestCriteria($request));
        $this->bankaccountRepository->pushCriteria(new LimitOffsetCriteria($request));
        $bankaccounts = $this->bankaccountRepository->all();

        return $this->sendResponse($bankaccounts->toArray(), 'Bankaccounts retrieved successfully');
    }

    /**
     * Store a newly created bankaccount in storage.
     * POST /bankaccounts
     *
     * @param CreatebankaccountAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatebankaccountAPIRequest $request)
    {
        $input = $request->all();

        $bankaccounts = $this->bankaccountRepository->create($input);

        return $this->sendResponse($bankaccounts->toArray(), 'Bankaccount saved successfully');
    }

    /**
     * Display the specified bankaccount.
     * GET|HEAD /bankaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var bankaccount $bankaccount */
        $bankaccount = $this->bankaccountRepository->findWithoutFail($id);

        if (empty($bankaccount)) {
            return $this->sendError('Bankaccount not found');
        }

        return $this->sendResponse($bankaccount->toArray(), 'Bankaccount retrieved successfully');
    }

    /**
     * Update the specified bankaccount in storage.
     * PUT/PATCH /bankaccounts/{id}
     *
     * @param  int $id
     * @param UpdatebankaccountAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebankaccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var bankaccount $bankaccount */
        $bankaccount = $this->bankaccountRepository->findWithoutFail($id);

        if (empty($bankaccount)) {
            return $this->sendError('Bankaccount not found');
        }

        $bankaccount = $this->bankaccountRepository->update($input, $id);

        return $this->sendResponse($bankaccount->toArray(), 'bankaccount updated successfully');
    }

    /**
     * Remove the specified bankaccount from storage.
     * DELETE /bankaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var bankaccount $bankaccount */
        $bankaccount = $this->bankaccountRepository->findWithoutFail($id);

        if (empty($bankaccount)) {
            return $this->sendError('Bankaccount not found');
        }

        $bankaccount->delete();

        return $this->sendResponse($id, 'Bankaccount deleted successfully');
    }
}

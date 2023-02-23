<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateconceptservpropaccountAPIRequest;
use App\Http\Requests\API\UpdateconceptservpropaccountAPIRequest;
use App\Models\conceptservpropaccount;
use App\Repositories\conceptservpropaccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class conceptservpropaccountController
 * @package App\Http\Controllers\API
 */

class conceptservpropaccountAPIController extends AppBaseController
{
    /** @var  conceptservpropaccountRepository */
    private $conceptservpropaccountRepository;

    public function __construct(conceptservpropaccountRepository $conceptservpropaccountRepo)
    {
        $this->conceptservpropaccountRepository = $conceptservpropaccountRepo;
    }

    /**
     * Display a listing of the conceptservpropaccount.
     * GET|HEAD /conceptservpropaccounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->conceptservpropaccountRepository->pushCriteria(new RequestCriteria($request));
        $this->conceptservpropaccountRepository->pushCriteria(new LimitOffsetCriteria($request));
        $conceptservpropaccounts = $this->conceptservpropaccountRepository->all();

        return $this->sendResponse($conceptservpropaccounts->toArray(), 'Conceptservpropaccounts retrieved successfully');
    }

    /**
     * Store a newly created conceptservpropaccount in storage.
     * POST /conceptservpropaccounts
     *
     * @param CreateconceptservpropaccountAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateconceptservpropaccountAPIRequest $request)
    {
        $input = $request->all();

        $conceptservpropaccounts = $this->conceptservpropaccountRepository->create($input);

        return $this->sendResponse($conceptservpropaccounts->toArray(), 'Conceptservpropaccount saved successfully');
    }

    /**
     * Display the specified conceptservpropaccount.
     * GET|HEAD /conceptservpropaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var conceptservpropaccount $conceptservpropaccount */
        $conceptservpropaccount = $this->conceptservpropaccountRepository->findWithoutFail($id);

        if (empty($conceptservpropaccount)) {
            return $this->sendError('Conceptservpropaccount not found');
        }

        return $this->sendResponse($conceptservpropaccount->toArray(), 'Conceptservpropaccount retrieved successfully');
    }

    /**
     * Update the specified conceptservpropaccount in storage.
     * PUT/PATCH /conceptservpropaccounts/{id}
     *
     * @param  int $id
     * @param UpdateconceptservpropaccountAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateconceptservpropaccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var conceptservpropaccount $conceptservpropaccount */
        $conceptservpropaccount = $this->conceptservpropaccountRepository->findWithoutFail($id);

        if (empty($conceptservpropaccount)) {
            return $this->sendError('Conceptservpropaccount not found');
        }

        $conceptservpropaccount = $this->conceptservpropaccountRepository->update($input, $id);

        return $this->sendResponse($conceptservpropaccount->toArray(), 'conceptservpropaccount updated successfully');
    }

    /**
     * Remove the specified conceptservpropaccount from storage.
     * DELETE /conceptservpropaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var conceptservpropaccount $conceptservpropaccount */
        $conceptservpropaccount = $this->conceptservpropaccountRepository->findWithoutFail($id);

        if (empty($conceptservpropaccount)) {
            return $this->sendError('Conceptservpropaccount not found');
        }

        $conceptservpropaccount->delete();

        return $this->sendResponse($id, 'Conceptservpropaccount deleted successfully');
    }
}

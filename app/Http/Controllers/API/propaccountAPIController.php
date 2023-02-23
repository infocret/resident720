<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepropaccountAPIRequest;
use App\Http\Requests\API\UpdatepropaccountAPIRequest;
use App\Models\propaccount;
use App\Repositories\propaccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class propaccountController
 * @package App\Http\Controllers\API
 */

class propaccountAPIController extends AppBaseController
{
    /** @var  propaccountRepository */
    private $propaccountRepository;

    public function __construct(propaccountRepository $propaccountRepo)
    {
        $this->propaccountRepository = $propaccountRepo;
    }

    /**
     * Display a listing of the propaccount.
     * GET|HEAD /propaccounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propaccountRepository->pushCriteria(new RequestCriteria($request));
        $this->propaccountRepository->pushCriteria(new LimitOffsetCriteria($request));
        $propaccounts = $this->propaccountRepository->all();

        return $this->sendResponse($propaccounts->toArray(), 'Propaccounts retrieved successfully');
    }

    /**
     * Store a newly created propaccount in storage.
     * POST /propaccounts
     *
     * @param CreatepropaccountAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepropaccountAPIRequest $request)
    {
        $input = $request->all();

        $propaccounts = $this->propaccountRepository->create($input);

        return $this->sendResponse($propaccounts->toArray(), 'Propaccount saved successfully');
    }

    /**
     * Display the specified propaccount.
     * GET|HEAD /propaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var propaccount $propaccount */
        $propaccount = $this->propaccountRepository->findWithoutFail($id);

        if (empty($propaccount)) {
            return $this->sendError('Propaccount not found');
        }

        return $this->sendResponse($propaccount->toArray(), 'Propaccount retrieved successfully');
    }

    /**
     * Update the specified propaccount in storage.
     * PUT/PATCH /propaccounts/{id}
     *
     * @param  int $id
     * @param UpdatepropaccountAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropaccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var propaccount $propaccount */
        $propaccount = $this->propaccountRepository->findWithoutFail($id);

        if (empty($propaccount)) {
            return $this->sendError('Propaccount not found');
        }

        $propaccount = $this->propaccountRepository->update($input, $id);

        return $this->sendResponse($propaccount->toArray(), 'propaccount updated successfully');
    }

    /**
     * Remove the specified propaccount from storage.
     * DELETE /propaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var propaccount $propaccount */
        $propaccount = $this->propaccountRepository->findWithoutFail($id);

        if (empty($propaccount)) {
            return $this->sendError('Propaccount not found');
        }

        $propaccount->delete();

        return $this->sendResponse($id, 'Propaccount deleted successfully');
    }
}

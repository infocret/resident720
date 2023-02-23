<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemovtobankaccountAPIRequest;
use App\Http\Requests\API\UpdatemovtobankaccountAPIRequest;
use App\Models\movtobankaccount;
use App\Repositories\movtobankaccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class movtobankaccountController
 * @package App\Http\Controllers\API
 */

class movtobankaccountAPIController extends AppBaseController
{
    /** @var  movtobankaccountRepository */
    private $movtobankaccountRepository;

    public function __construct(movtobankaccountRepository $movtobankaccountRepo)
    {
        $this->movtobankaccountRepository = $movtobankaccountRepo;
    }

    /**
     * Display a listing of the movtobankaccount.
     * GET|HEAD /movtobankaccounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->movtobankaccountRepository->pushCriteria(new RequestCriteria($request));
        $this->movtobankaccountRepository->pushCriteria(new LimitOffsetCriteria($request));
        $movtobankaccounts = $this->movtobankaccountRepository->all();

        return $this->sendResponse($movtobankaccounts->toArray(), 'Movtobankaccounts retrieved successfully');
    }

    /**
     * Store a newly created movtobankaccount in storage.
     * POST /movtobankaccounts
     *
     * @param CreatemovtobankaccountAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemovtobankaccountAPIRequest $request)
    {
        $input = $request->all();

        $movtobankaccounts = $this->movtobankaccountRepository->create($input);

        return $this->sendResponse($movtobankaccounts->toArray(), 'Movtobankaccount saved successfully');
    }

    /**
     * Display the specified movtobankaccount.
     * GET|HEAD /movtobankaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var movtobankaccount $movtobankaccount */
        $movtobankaccount = $this->movtobankaccountRepository->findWithoutFail($id);

        if (empty($movtobankaccount)) {
            return $this->sendError('Movtobankaccount not found');
        }

        return $this->sendResponse($movtobankaccount->toArray(), 'Movtobankaccount retrieved successfully');
    }

    /**
     * Update the specified movtobankaccount in storage.
     * PUT/PATCH /movtobankaccounts/{id}
     *
     * @param  int $id
     * @param UpdatemovtobankaccountAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovtobankaccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var movtobankaccount $movtobankaccount */
        $movtobankaccount = $this->movtobankaccountRepository->findWithoutFail($id);

        if (empty($movtobankaccount)) {
            return $this->sendError('Movtobankaccount not found');
        }

        $movtobankaccount = $this->movtobankaccountRepository->update($input, $id);

        return $this->sendResponse($movtobankaccount->toArray(), 'movtobankaccount updated successfully');
    }

    /**
     * Remove the specified movtobankaccount from storage.
     * DELETE /movtobankaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var movtobankaccount $movtobankaccount */
        $movtobankaccount = $this->movtobankaccountRepository->findWithoutFail($id);

        if (empty($movtobankaccount)) {
            return $this->sendError('Movtobankaccount not found');
        }

        $movtobankaccount->delete();

        return $this->sendResponse($id, 'Movtobankaccount deleted successfully');
    }
}

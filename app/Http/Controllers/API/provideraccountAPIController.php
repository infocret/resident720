<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateprovideraccountAPIRequest;
use App\Http\Requests\API\UpdateprovideraccountAPIRequest;
use App\Models\provideraccount;
use App\Repositories\provideraccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class provideraccountController
 * @package App\Http\Controllers\API
 */

class provideraccountAPIController extends AppBaseController
{
    /** @var  provideraccountRepository */
    private $provideraccountRepository;

    public function __construct(provideraccountRepository $provideraccountRepo)
    {
        $this->provideraccountRepository = $provideraccountRepo;
    }

    /**
     * Display a listing of the provideraccount.
     * GET|HEAD /provideraccounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->provideraccountRepository->pushCriteria(new RequestCriteria($request));
        $this->provideraccountRepository->pushCriteria(new LimitOffsetCriteria($request));
        $provideraccounts = $this->provideraccountRepository->all();

        return $this->sendResponse($provideraccounts->toArray(), 'Provideraccounts retrieved successfully');
    }

    /**
     * Store a newly created provideraccount in storage.
     * POST /provideraccounts
     *
     * @param CreateprovideraccountAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateprovideraccountAPIRequest $request)
    {
        $input = $request->all();

        $provideraccounts = $this->provideraccountRepository->create($input);

        return $this->sendResponse($provideraccounts->toArray(), 'Provideraccount saved successfully');
    }

    /**
     * Display the specified provideraccount.
     * GET|HEAD /provideraccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var provideraccount $provideraccount */
        $provideraccount = $this->provideraccountRepository->findWithoutFail($id);

        if (empty($provideraccount)) {
            return $this->sendError('Provideraccount not found');
        }

        return $this->sendResponse($provideraccount->toArray(), 'Provideraccount retrieved successfully');
    }

    /**
     * Update the specified provideraccount in storage.
     * PUT/PATCH /provideraccounts/{id}
     *
     * @param  int $id
     * @param UpdateprovideraccountAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprovideraccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var provideraccount $provideraccount */
        $provideraccount = $this->provideraccountRepository->findWithoutFail($id);

        if (empty($provideraccount)) {
            return $this->sendError('Provideraccount not found');
        }

        $provideraccount = $this->provideraccountRepository->update($input, $id);

        return $this->sendResponse($provideraccount->toArray(), 'provideraccount updated successfully');
    }

    /**
     * Remove the specified provideraccount from storage.
     * DELETE /provideraccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var provideraccount $provideraccount */
        $provideraccount = $this->provideraccountRepository->findWithoutFail($id);

        if (empty($provideraccount)) {
            return $this->sendError('Provideraccount not found');
        }

        $provideraccount->delete();

        return $this->sendResponse($id, 'Provideraccount deleted successfully');
    }
}

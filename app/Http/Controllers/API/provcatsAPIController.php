<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateprovcatsAPIRequest;
use App\Http\Requests\API\UpdateprovcatsAPIRequest;
use App\Models\provcats;
use App\Repositories\provcatsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class provcatsController
 * @package App\Http\Controllers\API
 */

class provcatsAPIController extends AppBaseController
{
    /** @var  provcatsRepository */
    private $provcatsRepository;

    public function __construct(provcatsRepository $provcatsRepo)
    {
        $this->provcatsRepository = $provcatsRepo;
    }

    /**
     * Display a listing of the provcats.
     * GET|HEAD /provcats
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->provcatsRepository->pushCriteria(new RequestCriteria($request));
        $this->provcatsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $provcats = $this->provcatsRepository->all();

        return $this->sendResponse($provcats->toArray(), 'Provcats retrieved successfully');
    }

    /**
     * Store a newly created provcats in storage.
     * POST /provcats
     *
     * @param CreateprovcatsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateprovcatsAPIRequest $request)
    {
        $input = $request->all();

        $provcats = $this->provcatsRepository->create($input);

        return $this->sendResponse($provcats->toArray(), 'Provcats saved successfully');
    }

    /**
     * Display the specified provcats.
     * GET|HEAD /provcats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var provcats $provcats */
        $provcats = $this->provcatsRepository->findWithoutFail($id);

        if (empty($provcats)) {
            return $this->sendError('Provcats not found');
        }

        return $this->sendResponse($provcats->toArray(), 'Provcats retrieved successfully');
    }

    /**
     * Update the specified provcats in storage.
     * PUT/PATCH /provcats/{id}
     *
     * @param  int $id
     * @param UpdateprovcatsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprovcatsAPIRequest $request)
    {
        $input = $request->all();

        /** @var provcats $provcats */
        $provcats = $this->provcatsRepository->findWithoutFail($id);

        if (empty($provcats)) {
            return $this->sendError('Provcats not found');
        }

        $provcats = $this->provcatsRepository->update($input, $id);

        return $this->sendResponse($provcats->toArray(), 'provcats updated successfully');
    }

    /**
     * Remove the specified provcats from storage.
     * DELETE /provcats/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var provcats $provcats */
        $provcats = $this->provcatsRepository->findWithoutFail($id);

        if (empty($provcats)) {
            return $this->sendError('Provcats not found');
        }

        $provcats->delete();

        return $this->sendResponse($id, 'Provcats deleted successfully');
    }
}

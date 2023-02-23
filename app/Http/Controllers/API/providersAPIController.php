<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateprovidersAPIRequest;
use App\Http\Requests\API\UpdateprovidersAPIRequest;
use App\Models\providers;
use App\Repositories\providersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class providersController
 * @package App\Http\Controllers\API
 */

class providersAPIController extends AppBaseController
{
    /** @var  providersRepository */
    private $providersRepository;

    public function __construct(providersRepository $providersRepo)
    {
        $this->providersRepository = $providersRepo;
    }

    /**
     * Display a listing of the providers.
     * GET|HEAD /providers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->providersRepository->pushCriteria(new RequestCriteria($request));
        $this->providersRepository->pushCriteria(new LimitOffsetCriteria($request));
        $providers = $this->providersRepository->all();

        return $this->sendResponse($providers->toArray(), 'Providers retrieved successfully');
    }

    /**
     * Store a newly created providers in storage.
     * POST /providers
     *
     * @param CreateprovidersAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateprovidersAPIRequest $request)
    {
        $input = $request->all();

        $providers = $this->providersRepository->create($input);

        return $this->sendResponse($providers->toArray(), 'Providers saved successfully');
    }

    /**
     * Display the specified providers.
     * GET|HEAD /providers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var providers $providers */
        $providers = $this->providersRepository->findWithoutFail($id);

        if (empty($providers)) {
            return $this->sendError('Providers not found');
        }

        return $this->sendResponse($providers->toArray(), 'Providers retrieved successfully');
    }

    /**
     * Update the specified providers in storage.
     * PUT/PATCH /providers/{id}
     *
     * @param  int $id
     * @param UpdateprovidersAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprovidersAPIRequest $request)
    {
        $input = $request->all();

        /** @var providers $providers */
        $providers = $this->providersRepository->findWithoutFail($id);

        if (empty($providers)) {
            return $this->sendError('Providers not found');
        }

        $providers = $this->providersRepository->update($input, $id);

        return $this->sendResponse($providers->toArray(), 'providers updated successfully');
    }

    /**
     * Remove the specified providers from storage.
     * DELETE /providers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var providers $providers */
        $providers = $this->providersRepository->findWithoutFail($id);

        if (empty($providers)) {
            return $this->sendError('Providers not found');
        }

        $providers->delete();

        return $this->sendResponse($id, 'Providers deleted successfully');
    }
}

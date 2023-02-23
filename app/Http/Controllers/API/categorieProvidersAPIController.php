<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecategorieProvidersAPIRequest;
use App\Http\Requests\API\UpdatecategorieProvidersAPIRequest;
use App\Models\categorieProviders;
use App\Repositories\categorieProvidersRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class categorieProvidersController
 * @package App\Http\Controllers\API
 */

class categorieProvidersAPIController extends AppBaseController
{
    /** @var  categorieProvidersRepository */
    private $categorieProvidersRepository;

    public function __construct(categorieProvidersRepository $categorieProvidersRepo)
    {
        $this->categorieProvidersRepository = $categorieProvidersRepo;
    }

    /**
     * Display a listing of the categorieProviders.
     * GET|HEAD /categorieProviders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categorieProvidersRepository->pushCriteria(new RequestCriteria($request));
        $this->categorieProvidersRepository->pushCriteria(new LimitOffsetCriteria($request));
        $categorieProviders = $this->categorieProvidersRepository->all();

        return $this->sendResponse($categorieProviders->toArray(), 'Categorie Providers retrieved successfully');
    }

    /**
     * Store a newly created categorieProviders in storage.
     * POST /categorieProviders
     *
     * @param CreatecategorieProvidersAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecategorieProvidersAPIRequest $request)
    {
        $input = $request->all();

        $categorieProviders = $this->categorieProvidersRepository->create($input);

        return $this->sendResponse($categorieProviders->toArray(), 'Categorie Providers saved successfully');
    }

    /**
     * Display the specified categorieProviders.
     * GET|HEAD /categorieProviders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var categorieProviders $categorieProviders */
        $categorieProviders = $this->categorieProvidersRepository->findWithoutFail($id);

        if (empty($categorieProviders)) {
            return $this->sendError('Categorie Providers not found');
        }

        return $this->sendResponse($categorieProviders->toArray(), 'Categorie Providers retrieved successfully');
    }

    /**
     * Update the specified categorieProviders in storage.
     * PUT/PATCH /categorieProviders/{id}
     *
     * @param  int $id
     * @param UpdatecategorieProvidersAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecategorieProvidersAPIRequest $request)
    {
        $input = $request->all();

        /** @var categorieProviders $categorieProviders */
        $categorieProviders = $this->categorieProvidersRepository->findWithoutFail($id);

        if (empty($categorieProviders)) {
            return $this->sendError('Categorie Providers not found');
        }

        $categorieProviders = $this->categorieProvidersRepository->update($input, $id);

        return $this->sendResponse($categorieProviders->toArray(), 'categorieProviders updated successfully');
    }

    /**
     * Remove the specified categorieProviders from storage.
     * DELETE /categorieProviders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var categorieProviders $categorieProviders */
        $categorieProviders = $this->categorieProvidersRepository->findWithoutFail($id);

        if (empty($categorieProviders)) {
            return $this->sendError('Categorie Providers not found');
        }

        $categorieProviders->delete();

        return $this->sendResponse($id, 'Categorie Providers deleted successfully');
    }
}

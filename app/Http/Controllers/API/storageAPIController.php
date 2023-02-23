<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatestorageAPIRequest;
use App\Http\Requests\API\UpdatestorageAPIRequest;
use App\Models\storage;
use App\Repositories\storageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class storageController
 * @package App\Http\Controllers\API
 */

class storageAPIController extends AppBaseController
{
    /** @var  storageRepository */
    private $storageRepository;

    public function __construct(storageRepository $storageRepo)
    {
        $this->storageRepository = $storageRepo;
    }

    /**
     * Display a listing of the storage.
     * GET|HEAD /storages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->storageRepository->pushCriteria(new RequestCriteria($request));
        $this->storageRepository->pushCriteria(new LimitOffsetCriteria($request));
        $storages = $this->storageRepository->all();

        return $this->sendResponse($storages->toArray(), 'Storages retrieved successfully');
    }

    /**
     * Store a newly created storage in storage.
     * POST /storages
     *
     * @param CreatestorageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatestorageAPIRequest $request)
    {
        $input = $request->all();

        $storages = $this->storageRepository->create($input);

        return $this->sendResponse($storages->toArray(), 'Storage saved successfully');
    }

    /**
     * Display the specified storage.
     * GET|HEAD /storages/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var storage $storage */
        $storage = $this->storageRepository->findWithoutFail($id);

        if (empty($storage)) {
            return $this->sendError('Storage not found');
        }

        return $this->sendResponse($storage->toArray(), 'Storage retrieved successfully');
    }

    /**
     * Update the specified storage in storage.
     * PUT/PATCH /storages/{id}
     *
     * @param  int $id
     * @param UpdatestorageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestorageAPIRequest $request)
    {
        $input = $request->all();

        /** @var storage $storage */
        $storage = $this->storageRepository->findWithoutFail($id);

        if (empty($storage)) {
            return $this->sendError('Storage not found');
        }

        $storage = $this->storageRepository->update($input, $id);

        return $this->sendResponse($storage->toArray(), 'storage updated successfully');
    }

    /**
     * Remove the specified storage from storage.
     * DELETE /storages/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var storage $storage */
        $storage = $this->storageRepository->findWithoutFail($id);

        if (empty($storage)) {
            return $this->sendError('Storage not found');
        }

        $storage->delete();

        return $this->sendResponse($id, 'Storage deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\storageDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatestorageRequest;
use App\Http\Requests\UpdatestorageRequest;
use App\Repositories\storageRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class storageController extends AppBaseController
{
    /** @var  storageRepository */
    private $storageRepository;

    public function __construct(storageRepository $storageRepo)
    {
        $this->storageRepository = $storageRepo;
    }

    /**
     * Display a listing of the storage.
     *
     * @param storageDataTable $storageDataTable
     * @return Response
     */
    public function index(storageDataTable $storageDataTable)
    {
        return $storageDataTable->render('storages.index');
    }

    /**
     * Show the form for creating a new storage.
     *
     * @return Response
     */
    public function create()
    {
        return view('storages.create');
    }

    /**
     * Store a newly created storage in storage.
     *
     * @param CreatestorageRequest $request
     *
     * @return Response
     */
    public function store(CreatestorageRequest $request)
    {
        $input = $request->all();

        $storage = $this->storageRepository->create($input);

        Flash::success('Storage saved successfully.');

        return redirect(route('storages.index'));
    }

    /**
     * Display the specified storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $storage = $this->storageRepository->findWithoutFail($id);

        if (empty($storage)) {
            Flash::error('Storage not found');

            return redirect(route('storages.index'));
        }

        return view('storages.show')->with('storage', $storage);
    }

    /**
     * Show the form for editing the specified storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $storage = $this->storageRepository->findWithoutFail($id);

        if (empty($storage)) {
            Flash::error('Storage not found');

            return redirect(route('storages.index'));
        }

        return view('storages.edit')->with('storage', $storage);
    }

    /**
     * Update the specified storage in storage.
     *
     * @param  int              $id
     * @param UpdatestorageRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestorageRequest $request)
    {
        $storage = $this->storageRepository->findWithoutFail($id);

        if (empty($storage)) {
            Flash::error('Storage not found');

            return redirect(route('storages.index'));
        }

        $storage = $this->storageRepository->update($request->all(), $id);

        Flash::success('Storage updated successfully.');

        return redirect(route('storages.index'));
    }

    /**
     * Remove the specified storage from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $storage = $this->storageRepository->findWithoutFail($id);

        if (empty($storage)) {
            Flash::error('Storage not found');

            return redirect(route('storages.index'));
        }

        $this->storageRepository->delete($id);

        Flash::success('Storage deleted successfully.');

        return redirect(route('storages.index'));
    }
}

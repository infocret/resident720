<?php

namespace App\Http\Controllers;

use App\DataTables\provideraccountDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateprovideraccountRequest;
use App\Http\Requests\UpdateprovideraccountRequest;
use App\Repositories\provideraccountRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class provideraccountController extends AppBaseController
{
    /** @var  provideraccountRepository */
    private $provideraccountRepository;

    public function __construct(provideraccountRepository $provideraccountRepo)
    {
        $this->provideraccountRepository = $provideraccountRepo;
    }

    /**
     * Display a listing of the provideraccount.
     *
     * @param provideraccountDataTable $provideraccountDataTable
     * @return Response
     */
    public function index(provideraccountDataTable $provideraccountDataTable)
    {
        return $provideraccountDataTable->render('provideraccounts.index');
    }

    /**
     * Show the form for creating a new provideraccount.
     *
     * @return Response
     */
    public function create()
    {
        return view('provideraccounts.create');
    }

    /**
     * Store a newly created provideraccount in storage.
     *
     * @param CreateprovideraccountRequest $request
     *
     * @return Response
     */
    public function store(CreateprovideraccountRequest $request)
    {
        $input = $request->all();

        $provideraccount = $this->provideraccountRepository->create($input);

        Flash::success('Provideraccount saved successfully.');

        return redirect(route('provideraccounts.index'));
    }

    /**
     * Display the specified provideraccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $provideraccount = $this->provideraccountRepository->findWithoutFail($id);

        if (empty($provideraccount)) {
            Flash::error('Provideraccount not found');

            return redirect(route('provideraccounts.index'));
        }

        return view('provideraccounts.show')->with('provideraccount', $provideraccount);
    }

    /**
     * Show the form for editing the specified provideraccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $provideraccount = $this->provideraccountRepository->findWithoutFail($id);

        if (empty($provideraccount)) {
            Flash::error('Provideraccount not found');

            return redirect(route('provideraccounts.index'));
        }

        return view('provideraccounts.edit')->with('provideraccount', $provideraccount);
    }

    /**
     * Update the specified provideraccount in storage.
     *
     * @param  int              $id
     * @param UpdateprovideraccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprovideraccountRequest $request)
    {
        $provideraccount = $this->provideraccountRepository->findWithoutFail($id);

        if (empty($provideraccount)) {
            Flash::error('Provideraccount not found');

            return redirect(route('provideraccounts.index'));
        }

        $provideraccount = $this->provideraccountRepository->update($request->all(), $id);

        Flash::success('Provideraccount updated successfully.');

        return redirect(route('provideraccounts.index'));
    }

    /**
     * Remove the specified provideraccount from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $provideraccount = $this->provideraccountRepository->findWithoutFail($id);

        if (empty($provideraccount)) {
            Flash::error('Provideraccount not found');

            return redirect(route('provideraccounts.index'));
        }

        $this->provideraccountRepository->delete($id);

        Flash::success('Provideraccount deleted successfully.');

        return redirect(route('provideraccounts.index'));
    }
}

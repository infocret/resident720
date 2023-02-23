<?php

namespace App\Http\Controllers;

use App\DataTables\movtobankaccountDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemovtobankaccountRequest;
use App\Http\Requests\UpdatemovtobankaccountRequest;
use App\Repositories\movtobankaccountRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class movtobankaccountController extends AppBaseController
{
    /** @var  movtobankaccountRepository */
    private $movtobankaccountRepository;

    public function __construct(movtobankaccountRepository $movtobankaccountRepo)
    {
        $this->movtobankaccountRepository = $movtobankaccountRepo;
    }

    /**
     * Display a listing of the movtobankaccount.
     *
     * @param movtobankaccountDataTable $movtobankaccountDataTable
     * @return Response
     */
    public function index(movtobankaccountDataTable $movtobankaccountDataTable)
    {
        return $movtobankaccountDataTable->render('movtobankaccounts.index');
    }

    /**
     * Show the form for creating a new movtobankaccount.
     *
     * @return Response
     */
    public function create()
    {
        return view('movtobankaccounts.create');
    }

    /**
     * Store a newly created movtobankaccount in storage.
     *
     * @param CreatemovtobankaccountRequest $request
     *
     * @return Response
     */
    public function store(CreatemovtobankaccountRequest $request)
    {
        $input = $request->all();

        $movtobankaccount = $this->movtobankaccountRepository->create($input);

        Flash::success('Movtobankaccount saved successfully.');

        return redirect(route('movtobankaccounts.index'));
    }

    /**
     * Display the specified movtobankaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $movtobankaccount = $this->movtobankaccountRepository->findWithoutFail($id);

        if (empty($movtobankaccount)) {
            Flash::error('Movtobankaccount not found');

            return redirect(route('movtobankaccounts.index'));
        }

        return view('movtobankaccounts.show')->with('movtobankaccount', $movtobankaccount);
    }

    /**
     * Show the form for editing the specified movtobankaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $movtobankaccount = $this->movtobankaccountRepository->findWithoutFail($id);

        if (empty($movtobankaccount)) {
            Flash::error('Movtobankaccount not found');

            return redirect(route('movtobankaccounts.index'));
        }

        return view('movtobankaccounts.edit')->with('movtobankaccount', $movtobankaccount);
    }

    /**
     * Update the specified movtobankaccount in storage.
     *
     * @param  int              $id
     * @param UpdatemovtobankaccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovtobankaccountRequest $request)
    {
        $movtobankaccount = $this->movtobankaccountRepository->findWithoutFail($id);

        if (empty($movtobankaccount)) {
            Flash::error('Movtobankaccount not found');

            return redirect(route('movtobankaccounts.index'));
        }

        $movtobankaccount = $this->movtobankaccountRepository->update($request->all(), $id);

        Flash::success('Movtobankaccount updated successfully.');

        return redirect(route('movtobankaccounts.index'));
    }

    /**
     * Remove the specified movtobankaccount from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $movtobankaccount = $this->movtobankaccountRepository->findWithoutFail($id);

        if (empty($movtobankaccount)) {
            Flash::error('Movtobankaccount not found');

            return redirect(route('movtobankaccounts.index'));
        }

        $this->movtobankaccountRepository->delete($id);

        Flash::success('Movtobankaccount deleted successfully.');

        return redirect(route('movtobankaccounts.index'));
    }
}

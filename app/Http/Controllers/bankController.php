<?php

namespace App\Http\Controllers;

use App\DataTables\bankDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatebankRequest;
use App\Http\Requests\UpdatebankRequest;
use App\Repositories\bankRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class bankController extends AppBaseController
{
    /** @var  bankRepository */
    private $bankRepository;

    public function __construct(bankRepository $bankRepo)
    {
        $this->bankRepository = $bankRepo;
    }

    /**
     * Display a listing of the bank.
     *
     * @param bankDataTable $bankDataTable
     * @return Response
     */
    public function index(bankDataTable $bankDataTable)
    {
        return $bankDataTable->render('banks.index');
    }

    /**
     * Show the form for creating a new bank.
     *
     * @return Response
     */
    public function create()
    {
        return view('banks.create');
    }

    /**
     * Store a newly created bank in storage.
     *
     * @param CreatebankRequest $request
     *
     * @return Response
     */
    public function store(CreatebankRequest $request)
    {
        $input = $request->all();

        $bank = $this->bankRepository->create($input);

        Flash::success('Bank saved successfully.');

        return redirect(route('banks.index'));
    }

    /**
     * Display the specified bank.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bank = $this->bankRepository->findWithoutFail($id);

        if (empty($bank)) {
            Flash::error('Bank not found');

            return redirect(route('banks.index'));
        }

        return view('banks.show')->with('bank', $bank);
    }

    /**
     * Show the form for editing the specified bank.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bank = $this->bankRepository->findWithoutFail($id);

        if (empty($bank)) {
            Flash::error('Bank not found');

            return redirect(route('banks.index'));
        }

        return view('banks.edit')->with('bank', $bank);
    }

    /**
     * Update the specified bank in storage.
     *
     * @param  int              $id
     * @param UpdatebankRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebankRequest $request)
    {
        $bank = $this->bankRepository->findWithoutFail($id);

        if (empty($bank)) {
            Flash::error('Bank not found');

            return redirect(route('banks.index'));
        }

        $bank = $this->bankRepository->update($request->all(), $id);

        Flash::success('Bank updated successfully.');

        return redirect(route('banks.index'));
    }

    /**
     * Remove the specified bank from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bank = $this->bankRepository->findWithoutFail($id);

        if (empty($bank)) {
            Flash::error('Bank not found');

            return redirect(route('banks.index'));
        }

        $this->bankRepository->delete($id);

        Flash::success('Bank deleted successfully.');

        return redirect(route('banks.index'));
    }
}

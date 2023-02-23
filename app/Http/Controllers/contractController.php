<?php

namespace App\Http\Controllers;

use App\DataTables\contractDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatecontractRequest;
use App\Http\Requests\UpdatecontractRequest;
use App\Repositories\contractRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class contractController extends AppBaseController
{
    /** @var  contractRepository */
    private $contractRepository;

    public function __construct(contractRepository $contractRepo)
    {
        $this->contractRepository = $contractRepo;
    }

    /**
     * Display a listing of the contract.
     *
     * @param contractDataTable $contractDataTable
     * @return Response
     */
    public function index(contractDataTable $contractDataTable)
    {
        return $contractDataTable->render('contracts.index');
    }

    /**
     * Show the form for creating a new contract.
     *
     * @return Response
     */
    public function create()
    {
        return view('contracts.create');
    }

    /**
     * Store a newly created contract in storage.
     *
     * @param CreatecontractRequest $request
     *
     * @return Response
     */
    public function store(CreatecontractRequest $request)
    {
        $input = $request->all();

        $contract = $this->contractRepository->create($input);

        Flash::success('Contract saved successfully.');

        return redirect(route('contracts.index'));
    }

    /**
     * Display the specified contract.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contract = $this->contractRepository->findWithoutFail($id);

        if (empty($contract)) {
            Flash::error('Contract not found');

            return redirect(route('contracts.index'));
        }

        return view('contracts.show')->with('contract', $contract);
    }

    /**
     * Show the form for editing the specified contract.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contract = $this->contractRepository->findWithoutFail($id);

        if (empty($contract)) {
            Flash::error('Contract not found');

            return redirect(route('contracts.index'));
        }

        return view('contracts.edit')->with('contract', $contract);
    }

    /**
     * Update the specified contract in storage.
     *
     * @param  int              $id
     * @param UpdatecontractRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecontractRequest $request)
    {
        $contract = $this->contractRepository->findWithoutFail($id);

        if (empty($contract)) {
            Flash::error('Contract not found');

            return redirect(route('contracts.index'));
        }

        $contract = $this->contractRepository->update($request->all(), $id);

        Flash::success('Contract updated successfully.');

        return redirect(route('contracts.index'));
    }

    /**
     * Remove the specified contract from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contract = $this->contractRepository->findWithoutFail($id);

        if (empty($contract)) {
            Flash::error('Contract not found');

            return redirect(route('contracts.index'));
        }

        $this->contractRepository->delete($id);

        Flash::success('Contract deleted successfully.');

        return redirect(route('contracts.index'));
    }
}

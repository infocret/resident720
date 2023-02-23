<?php

namespace App\Http\Controllers;

use App\DataTables\personaccountDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatepersonaccountRequest;
use App\Http\Requests\UpdatepersonaccountRequest;
use App\Repositories\personaccountRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class personaccountController extends AppBaseController
{
    /** @var  personaccountRepository */
    private $personaccountRepository;

    public function __construct(personaccountRepository $personaccountRepo)
    {
        $this->personaccountRepository = $personaccountRepo;
    }

    /**
     * Display a listing of the personaccount.
     *
     * @param personaccountDataTable $personaccountDataTable
     * @return Response
     */
    public function index(personaccountDataTable $personaccountDataTable)
    {
        return $personaccountDataTable->render('personaccounts.index');
    }

    /**
     * Show the form for creating a new personaccount.
     *
     * @return Response
     */
    public function create()
    {
        return view('personaccounts.create');
    }

    /**
     * Store a newly created personaccount in storage.
     *
     * @param CreatepersonaccountRequest $request
     *
     * @return Response
     */
    public function store(CreatepersonaccountRequest $request)
    {
        $input = $request->all();

        $personaccount = $this->personaccountRepository->create($input);

        Flash::success('Personaccount saved successfully.');

        return redirect(route('personaccounts.index'));
    }

    /**
     * Display the specified personaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $personaccount = $this->personaccountRepository->findWithoutFail($id);

        if (empty($personaccount)) {
            Flash::error('Personaccount not found');

            return redirect(route('personaccounts.index'));
        }

        return view('personaccounts.show')->with('personaccount', $personaccount);
    }

    /**
     * Show the form for editing the specified personaccount.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $personaccount = $this->personaccountRepository->findWithoutFail($id);

        if (empty($personaccount)) {
            Flash::error('Personaccount not found');

            return redirect(route('personaccounts.index'));
        }

        return view('personaccounts.edit')->with('personaccount', $personaccount);
    }

    /**
     * Update the specified personaccount in storage.
     *
     * @param  int              $id
     * @param UpdatepersonaccountRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepersonaccountRequest $request)
    {
        $personaccount = $this->personaccountRepository->findWithoutFail($id);

        if (empty($personaccount)) {
            Flash::error('Personaccount not found');

            return redirect(route('personaccounts.index'));
        }

        $personaccount = $this->personaccountRepository->update($request->all(), $id);

        Flash::success('Personaccount updated successfully.');

        return redirect(route('personaccounts.index'));
    }

    /**
     * Remove the specified personaccount from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $personaccount = $this->personaccountRepository->findWithoutFail($id);

        if (empty($personaccount)) {
            Flash::error('Personaccount not found');

            return redirect(route('personaccounts.index'));
        }

        $this->personaccountRepository->delete($id);

        Flash::success('Personaccount deleted successfully.');

        return redirect(route('personaccounts.index'));
    }
}

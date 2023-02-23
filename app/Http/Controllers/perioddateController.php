<?php

namespace App\Http\Controllers;

use App\DataTables\perioddateDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateperioddateRequest;
use App\Http\Requests\UpdateperioddateRequest;
use App\Repositories\perioddateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class perioddateController extends AppBaseController
{
    /** @var  perioddateRepository */
    private $perioddateRepository;

    public function __construct(perioddateRepository $perioddateRepo)
    {
        $this->perioddateRepository = $perioddateRepo;
    }

    /**
     * Display a listing of the perioddate.
     *
     * @param perioddateDataTable $perioddateDataTable
     * @return Response
     */
    public function index(perioddateDataTable $perioddateDataTable)
    {
        return $perioddateDataTable->render('perioddates.index');
    }

    /**
     * Show the form for creating a new perioddate.
     *
     * @return Response
     */
    public function create()
    {
        return view('perioddates.create');
    }

    /**
     * Store a newly created perioddate in storage.
     *
     * @param CreateperioddateRequest $request
     *
     * @return Response
     */
    public function store(CreateperioddateRequest $request)
    {
        $input = $request->all();

        $perioddate = $this->perioddateRepository->create($input);

        Flash::success('Perioddate saved successfully.');

        return redirect(route('perioddates.index'));
    }

    /**
     * Display the specified perioddate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $perioddate = $this->perioddateRepository->findWithoutFail($id);

        if (empty($perioddate)) {
            Flash::error('Perioddate not found');

            return redirect(route('perioddates.index'));
        }

        return view('perioddates.show')->with('perioddate', $perioddate);
    }

    /**
     * Show the form for editing the specified perioddate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $perioddate = $this->perioddateRepository->findWithoutFail($id);

        if (empty($perioddate)) {
            Flash::error('Perioddate not found');

            return redirect(route('perioddates.index'));
        }

        return view('perioddates.edit')->with('perioddate', $perioddate);
    }

    /**
     * Update the specified perioddate in storage.
     *
     * @param  int              $id
     * @param UpdateperioddateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateperioddateRequest $request)
    {
        $perioddate = $this->perioddateRepository->findWithoutFail($id);

        if (empty($perioddate)) {
            Flash::error('Perioddate not found');

            return redirect(route('perioddates.index'));
        }

        $perioddate = $this->perioddateRepository->update($request->all(), $id);

        Flash::success('Perioddate updated successfully.');

        return redirect(route('perioddates.index'));
    }

    /**
     * Remove the specified perioddate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $perioddate = $this->perioddateRepository->findWithoutFail($id);

        if (empty($perioddate)) {
            Flash::error('Perioddate not found');

            return redirect(route('perioddates.index'));
        }

        $this->perioddateRepository->delete($id);

        Flash::success('Perioddate deleted successfully.');

        return redirect(route('perioddates.index'));
    }
}

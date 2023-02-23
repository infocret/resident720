<?php

namespace App\Http\Controllers;

use App\DataTables\periodDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateperiodRequest;
use App\Http\Requests\UpdateperiodRequest;
use App\Repositories\periodRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class periodController extends AppBaseController
{
    /** @var  periodRepository */
    private $periodRepository;

    public function __construct(periodRepository $periodRepo)
    {
        $this->periodRepository = $periodRepo;
    }

    /**
     * Display a listing of the period.
     *
     * @param periodDataTable $periodDataTable
     * @return Response
     */
    public function index(periodDataTable $periodDataTable)
    {
        return $periodDataTable->render('periods.index');
    }

    /**
     * Show the form for creating a new period.
     *
     * @return Response
     */
    public function create()
    {
        return view('periods.create');
    }

    /**
     * Store a newly created period in storage.
     *
     * @param CreateperiodRequest $request
     *
     * @return Response
     */
    public function store(CreateperiodRequest $request)
    {
        $input = $request->all();

        $period = $this->periodRepository->create($input);

        Flash::success('Period saved successfully.');

        return redirect(route('periods.index'));
    }

    /**
     * Display the specified period.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $period = $this->periodRepository->findWithoutFail($id);

        if (empty($period)) {
            Flash::error('Period not found');

            return redirect(route('periods.index'));
        }

        return view('periods.show')->with('period', $period);
    }

    /**
     * Show the form for editing the specified period.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $period = $this->periodRepository->findWithoutFail($id);

        if (empty($period)) {
            Flash::error('Period not found');

            return redirect(route('periods.index'));
        }

        return view('periods.edit')->with('period', $period);
    }

    /**
     * Update the specified period in storage.
     *
     * @param  int              $id
     * @param UpdateperiodRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateperiodRequest $request)
    {
        $period = $this->periodRepository->findWithoutFail($id);

        if (empty($period)) {
            Flash::error('Period not found');

            return redirect(route('periods.index'));
        }

        $period = $this->periodRepository->update($request->all(), $id);

        Flash::success('Period updated successfully.');

        return redirect(route('periods.index'));
    }

    /**
     * Remove the specified period from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $period = $this->periodRepository->findWithoutFail($id);

        if (empty($period)) {
            Flash::error('Period not found');

            return redirect(route('periods.index'));
        }

        $this->periodRepository->delete($id);

        Flash::success('Period deleted successfully.');

        return redirect(route('periods.index'));
    }
}

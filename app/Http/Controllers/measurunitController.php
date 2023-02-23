<?php

namespace App\Http\Controllers;

use App\DataTables\measurunitDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemeasurunitRequest;
use App\Http\Requests\UpdatemeasurunitRequest;
use App\Repositories\measurunitRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class measurunitController extends AppBaseController
{
    /** @var  measurunitRepository */
    private $measurunitRepository;

    public function __construct(measurunitRepository $measurunitRepo)
    {
        $this->measurunitRepository = $measurunitRepo;
    }

    /**
     * Display a listing of the measurunit.
     *
     * @param measurunitDataTable $measurunitDataTable
     * @return Response
     */
    public function index(measurunitDataTable $measurunitDataTable)
    {
        return $measurunitDataTable->render('measurunits.index');
    }

    /**
     * Show the form for creating a new measurunit.
     *
     * @return Response
     */
    public function create()
    {
        return view('measurunits.create');
    }

    /**
     * Store a newly created measurunit in storage.
     *
     * @param CreatemeasurunitRequest $request
     *
     * @return Response
     */
    public function store(CreatemeasurunitRequest $request)
    {
        $input = $request->all();

        $measurunit = $this->measurunitRepository->create($input);

        Flash::success('Measurunit saved successfully.');

        return redirect(route('measurunits.index'));
    }

    /**
     * Display the specified measurunit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $measurunit = $this->measurunitRepository->findWithoutFail($id);

        if (empty($measurunit)) {
            Flash::error('Measurunit not found');

            return redirect(route('measurunits.index'));
        }

        return view('measurunits.show')->with('measurunit', $measurunit);
    }

    /**
     * Show the form for editing the specified measurunit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $measurunit = $this->measurunitRepository->findWithoutFail($id);

        if (empty($measurunit)) {
            Flash::error('Measurunit not found');

            return redirect(route('measurunits.index'));
        }

        return view('measurunits.edit')->with('measurunit', $measurunit);
    }

    /**
     * Update the specified measurunit in storage.
     *
     * @param  int              $id
     * @param UpdatemeasurunitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemeasurunitRequest $request)
    {
        $measurunit = $this->measurunitRepository->findWithoutFail($id);

        if (empty($measurunit)) {
            Flash::error('Measurunit not found');

            return redirect(route('measurunits.index'));
        }

        $measurunit = $this->measurunitRepository->update($request->all(), $id);

        Flash::success('Measurunit updated successfully.');

        return redirect(route('measurunits.index'));
    }

    /**
     * Remove the specified measurunit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $measurunit = $this->measurunitRepository->findWithoutFail($id);

        if (empty($measurunit)) {
            Flash::error('Measurunit not found');

            return redirect(route('measurunits.index'));
        }

        $this->measurunitRepository->delete($id);

        Flash::success('Measurunit deleted successfully.');

        return redirect(route('measurunits.index'));
    }
}

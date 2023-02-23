<?php

namespace App\Http\Controllers;

use App\DataTables\activitytrackingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateactivitytrackingRequest;
use App\Http\Requests\UpdateactivitytrackingRequest;
use App\Repositories\activitytrackingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class activitytrackingController extends AppBaseController
{
    /** @var  activitytrackingRepository */
    private $activitytrackingRepository;

    public function __construct(activitytrackingRepository $activitytrackingRepo)
    {
        $this->activitytrackingRepository = $activitytrackingRepo;
    }

    /**
     * Display a listing of the activitytracking.
     *
     * @param activitytrackingDataTable $activitytrackingDataTable
     * @return Response
     */
    public function index(activitytrackingDataTable $activitytrackingDataTable)
    {
        return $activitytrackingDataTable->render('activitytrackings.index');
    }

    /**
     * Show the form for creating a new activitytracking.
     *
     * @return Response
     */
    public function create()
    {
        return view('activitytrackings.create');
    }

    /**
     * Store a newly created activitytracking in storage.
     *
     * @param CreateactivitytrackingRequest $request
     *
     * @return Response
     */
    public function store(CreateactivitytrackingRequest $request)
    {
        $input = $request->all();

        $activitytracking = $this->activitytrackingRepository->create($input);

        Flash::success('Activitytracking saved successfully.');

        return redirect(route('activitytrackings.index'));
    }

    /**
     * Display the specified activitytracking.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $activitytracking = $this->activitytrackingRepository->findWithoutFail($id);

        if (empty($activitytracking)) {
            Flash::error('Activitytracking not found');

            return redirect(route('activitytrackings.index'));
        }

        return view('activitytrackings.show')->with('activitytracking', $activitytracking);
    }

    /**
     * Show the form for editing the specified activitytracking.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $activitytracking = $this->activitytrackingRepository->findWithoutFail($id);

        if (empty($activitytracking)) {
            Flash::error('Activitytracking not found');

            return redirect(route('activitytrackings.index'));
        }

        return view('activitytrackings.edit')->with('activitytracking', $activitytracking);
    }

    /**
     * Update the specified activitytracking in storage.
     *
     * @param  int              $id
     * @param UpdateactivitytrackingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateactivitytrackingRequest $request)
    {
        $activitytracking = $this->activitytrackingRepository->findWithoutFail($id);

        if (empty($activitytracking)) {
            Flash::error('Activitytracking not found');

            return redirect(route('activitytrackings.index'));
        }

        $activitytracking = $this->activitytrackingRepository->update($request->all(), $id);

        Flash::success('Activitytracking updated successfully.');

        return redirect(route('activitytrackings.index'));
    }

    /**
     * Remove the specified activitytracking from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $activitytracking = $this->activitytrackingRepository->findWithoutFail($id);

        if (empty($activitytracking)) {
            Flash::error('Activitytracking not found');

            return redirect(route('activitytrackings.index'));
        }

        $this->activitytrackingRepository->delete($id);

        Flash::success('Activitytracking deleted successfully.');

        return redirect(route('activitytrackings.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\detailmovDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatedetailmovRequest;
use App\Http\Requests\UpdatedetailmovRequest;
use App\Repositories\detailmovRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class detailmovController extends AppBaseController
{
    /** @var  detailmovRepository */
    private $detailmovRepository;

    public function __construct(detailmovRepository $detailmovRepo)
    {
        $this->detailmovRepository = $detailmovRepo;
    }

    /**
     * Display a listing of the detailmov.
     *
     * @param detailmovDataTable $detailmovDataTable
     * @return Response
     */
    public function index(detailmovDataTable $detailmovDataTable)
    {
        return $detailmovDataTable->render('detailmovs.index');
    }

    /**
     * Show the form for creating a new detailmov.
     *
     * @return Response
     */
    public function create()
    {
        return view('detailmovs.create');
    }

    /**
     * Store a newly created detailmov in storage.
     *
     * @param CreatedetailmovRequest $request
     *
     * @return Response
     */
    public function store(CreatedetailmovRequest $request)
    {
        $input = $request->all();

        $detailmov = $this->detailmovRepository->create($input);

        Flash::success('Detailmov saved successfully.');

        return redirect(route('detailmovs.index'));
    }

    /**
     * Display the specified detailmov.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $detailmov = $this->detailmovRepository->findWithoutFail($id);

        if (empty($detailmov)) {
            Flash::error('Detailmov not found');

            return redirect(route('detailmovs.index'));
        }

        return view('detailmovs.show')->with('detailmov', $detailmov);
    }

    /**
     * Show the form for editing the specified detailmov.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $detailmov = $this->detailmovRepository->findWithoutFail($id);

        if (empty($detailmov)) {
            Flash::error('Detailmov not found');

            return redirect(route('detailmovs.index'));
        }

        return view('detailmovs.edit')->with('detailmov', $detailmov);
    }

    /**
     * Update the specified detailmov in storage.
     *
     * @param  int              $id
     * @param UpdatedetailmovRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetailmovRequest $request)
    {
        
        $detailmov = $this->detailmovRepository->findWithoutFail($id);

        if (empty($detailmov)) {
            Flash::error('Detailmov not found');

            return redirect(route('detailmovs.index'));
        }

        $detailmov = $this->detailmovRepository->update($request->all(), $id);

        Flash::success('Detailmov updated successfully.');

        return redirect(route('detailmovs.index'));
    }

    /**
     * Remove the specified detailmov from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $detailmov = $this->detailmovRepository->findWithoutFail($id);

        if (empty($detailmov)) {
            Flash::error('Detailmov not found');

            return redirect(route('detailmovs.index'));
        }

        $this->detailmovRepository->delete($id);

        Flash::success('Detailmov deleted successfully.');

        return redirect(route('detailmovs.index'));
    }
}

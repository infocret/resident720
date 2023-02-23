<?php

namespace App\Http\Controllers;

use App\DataTables\movtoheadDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatemovtoheadRequest;
use App\Http\Requests\UpdatemovtoheadRequest;
use App\Repositories\movtoheadRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class movtoheadController extends AppBaseController
{
    /** @var  movtoheadRepository */
    private $movtoheadRepository;

    public function __construct(movtoheadRepository $movtoheadRepo)
    {
        $this->movtoheadRepository = $movtoheadRepo;
    }

    /**
     * Display a listing of the movtohead.
     *
     * @param movtoheadDataTable $movtoheadDataTable
     * @return Response
     */
    public function index(movtoheadDataTable $movtoheadDataTable)
    {
        return $movtoheadDataTable->render('movtoheads.index');
    }

    /**
     * Show the form for creating a new movtohead.
     *
     * @return Response
     */
    public function create()
    {
        return view('movtoheads.create');
    }

    /**
     * Store a newly created movtohead in storage.
     *
     * @param CreatemovtoheadRequest $request
     *
     * @return Response
     */
    public function store(CreatemovtoheadRequest $request)
    {
        $input = $request->all();

        $movtohead = $this->movtoheadRepository->create($input);

        Flash::success('Movtohead saved successfully.');

        return redirect(route('movtoheads.index'));
    }

    /**
     * Display the specified movtohead.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $movtohead = $this->movtoheadRepository->findWithoutFail($id);

        if (empty($movtohead)) {
            Flash::error('Movtohead not found');

            return redirect(route('movtoheads.index'));
        }

        return view('movtoheads.show')->with('movtohead', $movtohead);
    }

    /**
     * Show the form for editing the specified movtohead.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $movtohead = $this->movtoheadRepository->findWithoutFail($id);

        if (empty($movtohead)) {
            Flash::error('Movtohead not found');

            return redirect(route('movtoheads.index'));
        }

        return view('movtoheads.edit')->with('movtohead', $movtohead);
    }

    /**
     * Update the specified movtohead in storage.
     *
     * @param  int              $id
     * @param UpdatemovtoheadRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovtoheadRequest $request)
    {
        $movtohead = $this->movtoheadRepository->findWithoutFail($id);

        if (empty($movtohead)) {
            Flash::error('Movtohead not found');

            return redirect(route('movtoheads.index'));
        }

        $movtohead = $this->movtoheadRepository->update($request->all(), $id);

        Flash::success('Movtohead updated successfully.');

        return redirect(route('movtoheads.index'));
    }

    /**
     * Remove the specified movtohead from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $movtohead = $this->movtoheadRepository->findWithoutFail($id);

        if (empty($movtohead)) {
            Flash::error('Movtohead not found');

            return redirect(route('movtoheads.index'));
        }

        $this->movtoheadRepository->delete($id);

        Flash::success('Movtohead deleted successfully.');

        return redirect(route('movtoheads.index'));
    }
}

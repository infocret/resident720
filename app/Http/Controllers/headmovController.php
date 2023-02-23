<?php

namespace App\Http\Controllers;

use App\DataTables\headmovDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateheadmovRequest;
use App\Http\Requests\UpdateheadmovRequest;
use App\Repositories\headmovRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class headmovController extends AppBaseController
{
    /** @var  headmovRepository */
    private $headmovRepository;

    public function __construct(headmovRepository $headmovRepo)
    {
        $this->headmovRepository = $headmovRepo;
    }

    /**
     * Display a listing of the headmov.
     *
     * @param headmovDataTable $headmovDataTable
     * @return Response
     */
    public function index(headmovDataTable $headmovDataTable)
    {
        return $headmovDataTable->render('headmovs.index');
    }

    /**
     * Show the form for creating a new headmov.
     *
     * @return Response
     */
    public function create()
    {
        return view('headmovs.create');
    }

    /**
     * Store a newly created headmov in storage.
     *
     * @param CreateheadmovRequest $request
     *
     * @return Response
     */
    public function store(CreateheadmovRequest $request)
    {
        $input = $request->all();

        $headmov = $this->headmovRepository->create($input);

        Flash::success('Headmov saved successfully.');

        return redirect(route('headmovs.index'));
    }

    /**
     * Display the specified headmov.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            Flash::error('Headmov not found');

            return redirect(route('headmovs.index'));
        }

        return view('headmovs.show')->with('headmov', $headmov);
    }

    /**
     * Show the form for editing the specified headmov.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            Flash::error('Headmov not found');

            return redirect(route('headmovs.index'));
        }

        return view('headmovs.edit')->with('headmov', $headmov);
    }

    /**
     * Update the specified headmov in storage.
     *
     * @param  int              $id
     * @param UpdateheadmovRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateheadmovRequest $request)
    {
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            Flash::error('Headmov not found');

            return redirect(route('headmovs.index'));
        }

        $headmov = $this->headmovRepository->update($request->all(), $id);

        Flash::success('Headmov updated successfully.');

        return redirect(route('headmovs.index'));
    }

    /**
     * Remove the specified headmov from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            Flash::error('Headmov not found');

            return redirect(route('headmovs.index'));
        }

        $this->headmovRepository->delete($id);

        Flash::success('Headmov deleted successfully.');

        return redirect(route('headmovs.index'));
    }
}

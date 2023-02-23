<?php

namespace App\Http\Controllers;

use App\DataTables\banksquareDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatebanksquareRequest;
use App\Http\Requests\UpdatebanksquareRequest;
use App\Repositories\banksquareRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class banksquareController extends AppBaseController
{
    /** @var  banksquareRepository */
    private $banksquareRepository;

    public function __construct(banksquareRepository $banksquareRepo)
    {
        $this->banksquareRepository = $banksquareRepo;
    }

    /**
     * Display a listing of the banksquare.
     *
     * @param banksquareDataTable $banksquareDataTable
     * @return Response
     */
    public function index(banksquareDataTable $banksquareDataTable)
    {
        return $banksquareDataTable->render('banksquares.index');
    }

    /**
     * Show the form for creating a new banksquare.
     *
     * @return Response
     */
    public function create()
    {
        return view('banksquares.create');
    }

    /**
     * Store a newly created banksquare in storage.
     *
     * @param CreatebanksquareRequest $request
     *
     * @return Response
     */
    public function store(CreatebanksquareRequest $request)
    {
        $input = $request->all();

        $banksquare = $this->banksquareRepository->create($input);

        Flash::success('Banksquare saved successfully.');

        return redirect(route('banksquares.index'));
    }

    /**
     * Display the specified banksquare.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $banksquare = $this->banksquareRepository->findWithoutFail($id);

        if (empty($banksquare)) {
            Flash::error('Banksquare not found');

            return redirect(route('banksquares.index'));
        }

        return view('banksquares.show')->with('banksquare', $banksquare);
    }

    /**
     * Show the form for editing the specified banksquare.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $banksquare = $this->banksquareRepository->findWithoutFail($id);

        if (empty($banksquare)) {
            Flash::error('Banksquare not found');

            return redirect(route('banksquares.index'));
        }

        return view('banksquares.edit')->with('banksquare', $banksquare);
    }

    /**
     * Update the specified banksquare in storage.
     *
     * @param  int              $id
     * @param UpdatebanksquareRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebanksquareRequest $request)
    {
        $banksquare = $this->banksquareRepository->findWithoutFail($id);

        if (empty($banksquare)) {
            Flash::error('Banksquare not found');

            return redirect(route('banksquares.index'));
        }

        $banksquare = $this->banksquareRepository->update($request->all(), $id);

        Flash::success('Banksquare updated successfully.');

        return redirect(route('banksquares.index'));
    }

    /**
     * Remove the specified banksquare from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $banksquare = $this->banksquareRepository->findWithoutFail($id);

        if (empty($banksquare)) {
            Flash::error('Banksquare not found');

            return redirect(route('banksquares.index'));
        }

        $this->banksquareRepository->delete($id);

        Flash::success('Banksquare deleted successfully.');

        return redirect(route('banksquares.index'));
    }
}

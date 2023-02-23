<?php

namespace App\Http\Controllers;

use App\DataTables\stockmovementDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatestockmovementRequest;
use App\Http\Requests\UpdatestockmovementRequest;
use App\Repositories\stockmovementRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class stockmovementController extends AppBaseController
{
    /** @var  stockmovementRepository */
    private $stockmovementRepository;

    public function __construct(stockmovementRepository $stockmovementRepo)
    {
        $this->stockmovementRepository = $stockmovementRepo;
    }

    /**
     * Display a listing of the stockmovement.
     *
     * @param stockmovementDataTable $stockmovementDataTable
     * @return Response
     */
    public function index(stockmovementDataTable $stockmovementDataTable)
    {
        return $stockmovementDataTable->render('stockmovements.index');
    }

    /**
     * Show the form for creating a new stockmovement.
     *
     * @return Response
     */
    public function create()
    {
        return view('stockmovements.create');
    }

    /**
     * Store a newly created stockmovement in storage.
     *
     * @param CreatestockmovementRequest $request
     *
     * @return Response
     */
    public function store(CreatestockmovementRequest $request)
    {
        $input = $request->all();

        $stockmovement = $this->stockmovementRepository->create($input);

        Flash::success('Stockmovement saved successfully.');

        return redirect(route('stockmovements.index'));
    }

    /**
     * Display the specified stockmovement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stockmovement = $this->stockmovementRepository->findWithoutFail($id);

        if (empty($stockmovement)) {
            Flash::error('Stockmovement not found');

            return redirect(route('stockmovements.index'));
        }

        return view('stockmovements.show')->with('stockmovement', $stockmovement);
    }

    /**
     * Show the form for editing the specified stockmovement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stockmovement = $this->stockmovementRepository->findWithoutFail($id);

        if (empty($stockmovement)) {
            Flash::error('Stockmovement not found');

            return redirect(route('stockmovements.index'));
        }

        return view('stockmovements.edit')->with('stockmovement', $stockmovement);
    }

    /**
     * Update the specified stockmovement in storage.
     *
     * @param  int              $id
     * @param UpdatestockmovementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestockmovementRequest $request)
    {
        $stockmovement = $this->stockmovementRepository->findWithoutFail($id);

        if (empty($stockmovement)) {
            Flash::error('Stockmovement not found');

            return redirect(route('stockmovements.index'));
        }

        $stockmovement = $this->stockmovementRepository->update($request->all(), $id);

        Flash::success('Stockmovement updated successfully.');

        return redirect(route('stockmovements.index'));
    }

    /**
     * Remove the specified stockmovement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stockmovement = $this->stockmovementRepository->findWithoutFail($id);

        if (empty($stockmovement)) {
            Flash::error('Stockmovement not found');

            return redirect(route('stockmovements.index'));
        }

        $this->stockmovementRepository->delete($id);

        Flash::success('Stockmovement deleted successfully.');

        return redirect(route('stockmovements.index'));
    }
}

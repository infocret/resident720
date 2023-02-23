<?php

namespace App\Http\Controllers;

use App\DataTables\stockDataTable;
use App\Http\Requests;
use App\Http\Requests\CreatestockRequest;
use App\Http\Requests\UpdatestockRequest;
use App\Repositories\stockRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class stockController extends AppBaseController
{
    /** @var  stockRepository */
    private $stockRepository;

    public function __construct(stockRepository $stockRepo)
    {
        $this->stockRepository = $stockRepo;
    }

    /**
     * Display a listing of the stock.
     *
     * @param stockDataTable $stockDataTable
     * @return Response
     */
    public function index(stockDataTable $stockDataTable)
    {
        return $stockDataTable->render('stocks.index');
    }

    /**
     * Show the form for creating a new stock.
     *
     * @return Response
     */
    public function create()
    {
        return view('stocks.create');
    }

    /**
     * Store a newly created stock in storage.
     *
     * @param CreatestockRequest $request
     *
     * @return Response
     */
    public function store(CreatestockRequest $request)
    {
        $input = $request->all();

        $stock = $this->stockRepository->create($input);

        Flash::success('Stock saved successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Display the specified stock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        return view('stocks.show')->with('stock', $stock);
    }

    /**
     * Show the form for editing the specified stock.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        return view('stocks.edit')->with('stock', $stock);
    }

    /**
     * Update the specified stock in storage.
     *
     * @param  int              $id
     * @param UpdatestockRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestockRequest $request)
    {
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        $stock = $this->stockRepository->update($request->all(), $id);

        Flash::success('Stock updated successfully.');

        return redirect(route('stocks.index'));
    }

    /**
     * Remove the specified stock from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            Flash::error('Stock not found');

            return redirect(route('stocks.index'));
        }

        $this->stockRepository->delete($id);

        Flash::success('Stock deleted successfully.');

        return redirect(route('stocks.index'));
    }
}

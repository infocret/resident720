<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatestockAPIRequest;
use App\Http\Requests\API\UpdatestockAPIRequest;
use App\Models\stock;
use App\Repositories\stockRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class stockController
 * @package App\Http\Controllers\API
 */

class stockAPIController extends AppBaseController
{
    /** @var  stockRepository */
    private $stockRepository;

    public function __construct(stockRepository $stockRepo)
    {
        $this->stockRepository = $stockRepo;
    }

    /**
     * Display a listing of the stock.
     * GET|HEAD /stocks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->stockRepository->pushCriteria(new RequestCriteria($request));
        $this->stockRepository->pushCriteria(new LimitOffsetCriteria($request));
        $stocks = $this->stockRepository->all();

        return $this->sendResponse($stocks->toArray(), 'Stocks retrieved successfully');
    }

    /**
     * Store a newly created stock in storage.
     * POST /stocks
     *
     * @param CreatestockAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatestockAPIRequest $request)
    {
        $input = $request->all();

        $stocks = $this->stockRepository->create($input);

        return $this->sendResponse($stocks->toArray(), 'Stock saved successfully');
    }

    /**
     * Display the specified stock.
     * GET|HEAD /stocks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var stock $stock */
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            return $this->sendError('Stock not found');
        }

        return $this->sendResponse($stock->toArray(), 'Stock retrieved successfully');
    }

    /**
     * Update the specified stock in storage.
     * PUT/PATCH /stocks/{id}
     *
     * @param  int $id
     * @param UpdatestockAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestockAPIRequest $request)
    {
        $input = $request->all();

        /** @var stock $stock */
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            return $this->sendError('Stock not found');
        }

        $stock = $this->stockRepository->update($input, $id);

        return $this->sendResponse($stock->toArray(), 'stock updated successfully');
    }

    /**
     * Remove the specified stock from storage.
     * DELETE /stocks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var stock $stock */
        $stock = $this->stockRepository->findWithoutFail($id);

        if (empty($stock)) {
            return $this->sendError('Stock not found');
        }

        $stock->delete();

        return $this->sendResponse($id, 'Stock deleted successfully');
    }
}

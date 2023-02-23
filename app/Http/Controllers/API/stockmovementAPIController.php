<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatestockmovementAPIRequest;
use App\Http\Requests\API\UpdatestockmovementAPIRequest;
use App\Models\stockmovement;
use App\Repositories\stockmovementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class stockmovementController
 * @package App\Http\Controllers\API
 */

class stockmovementAPIController extends AppBaseController
{
    /** @var  stockmovementRepository */
    private $stockmovementRepository;

    public function __construct(stockmovementRepository $stockmovementRepo)
    {
        $this->stockmovementRepository = $stockmovementRepo;
    }

    /**
     * Display a listing of the stockmovement.
     * GET|HEAD /stockmovements
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->stockmovementRepository->pushCriteria(new RequestCriteria($request));
        $this->stockmovementRepository->pushCriteria(new LimitOffsetCriteria($request));
        $stockmovements = $this->stockmovementRepository->all();

        return $this->sendResponse($stockmovements->toArray(), 'Stockmovements retrieved successfully');
    }

    /**
     * Store a newly created stockmovement in storage.
     * POST /stockmovements
     *
     * @param CreatestockmovementAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatestockmovementAPIRequest $request)
    {
        $input = $request->all();

        $stockmovements = $this->stockmovementRepository->create($input);

        return $this->sendResponse($stockmovements->toArray(), 'Stockmovement saved successfully');
    }

    /**
     * Display the specified stockmovement.
     * GET|HEAD /stockmovements/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var stockmovement $stockmovement */
        $stockmovement = $this->stockmovementRepository->findWithoutFail($id);

        if (empty($stockmovement)) {
            return $this->sendError('Stockmovement not found');
        }

        return $this->sendResponse($stockmovement->toArray(), 'Stockmovement retrieved successfully');
    }

    /**
     * Update the specified stockmovement in storage.
     * PUT/PATCH /stockmovements/{id}
     *
     * @param  int $id
     * @param UpdatestockmovementAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestockmovementAPIRequest $request)
    {
        $input = $request->all();

        /** @var stockmovement $stockmovement */
        $stockmovement = $this->stockmovementRepository->findWithoutFail($id);

        if (empty($stockmovement)) {
            return $this->sendError('Stockmovement not found');
        }

        $stockmovement = $this->stockmovementRepository->update($input, $id);

        return $this->sendResponse($stockmovement->toArray(), 'stockmovement updated successfully');
    }

    /**
     * Remove the specified stockmovement from storage.
     * DELETE /stockmovements/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var stockmovement $stockmovement */
        $stockmovement = $this->stockmovementRepository->findWithoutFail($id);

        if (empty($stockmovement)) {
            return $this->sendError('Stockmovement not found');
        }

        $stockmovement->delete();

        return $this->sendResponse($id, 'Stockmovement deleted successfully');
    }
}

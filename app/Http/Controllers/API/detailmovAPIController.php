<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatedetailmovAPIRequest;
use App\Http\Requests\API\UpdatedetailmovAPIRequest;
use App\Models\detailmov;
use App\Repositories\detailmovRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class detailmovController
 * @package App\Http\Controllers\API
 */

class detailmovAPIController extends AppBaseController
{
    /** @var  detailmovRepository */
    private $detailmovRepository;

    public function __construct(detailmovRepository $detailmovRepo)
    {
        $this->detailmovRepository = $detailmovRepo;
    }

    /**
     * Display a listing of the detailmov.
     * GET|HEAD /detailmovs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->detailmovRepository->pushCriteria(new RequestCriteria($request));
        $this->detailmovRepository->pushCriteria(new LimitOffsetCriteria($request));
        $detailmovs = $this->detailmovRepository->all();

        return $this->sendResponse($detailmovs->toArray(), 'Detailmovs retrieved successfully');
    }

    /**
     * Store a newly created detailmov in storage.
     * POST /detailmovs
     *
     * @param CreatedetailmovAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatedetailmovAPIRequest $request)
    {
        $input = $request->all();

        $detailmovs = $this->detailmovRepository->create($input);

        return $this->sendResponse($detailmovs->toArray(), 'Detailmov saved successfully');
    }

    /**
     * Display the specified detailmov.
     * GET|HEAD /detailmovs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var detailmov $detailmov */
        $detailmov = $this->detailmovRepository->findWithoutFail($id);

        if (empty($detailmov)) {
            return $this->sendError('Detailmov not found');
        }

        return $this->sendResponse($detailmov->toArray(), 'Detailmov retrieved successfully');
    }

    /**
     * Update the specified detailmov in storage.
     * PUT/PATCH /detailmovs/{id}
     *
     * @param  int $id
     * @param UpdatedetailmovAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatedetailmovAPIRequest $request)
    {
        $input = $request->all();

        /** @var detailmov $detailmov */
        $detailmov = $this->detailmovRepository->findWithoutFail($id);

        if (empty($detailmov)) {
            return $this->sendError('Detailmov not found');
        }

        $detailmov = $this->detailmovRepository->update($input, $id);

        return $this->sendResponse($detailmov->toArray(), 'detailmov updated successfully');
    }

    /**
     * Remove the specified detailmov from storage.
     * DELETE /detailmovs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var detailmov $detailmov */
        $detailmov = $this->detailmovRepository->findWithoutFail($id);

        if (empty($detailmov)) {
            return $this->sendError('Detailmov not found');
        }

        $detailmov->delete();

        return $this->sendResponse($id, 'Detailmov deleted successfully');
    }
}

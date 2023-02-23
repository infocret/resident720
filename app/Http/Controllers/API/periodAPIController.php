<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateperiodAPIRequest;
use App\Http\Requests\API\UpdateperiodAPIRequest;
use App\Models\period;
use App\Repositories\periodRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class periodController
 * @package App\Http\Controllers\API
 */

class periodAPIController extends AppBaseController
{
    /** @var  periodRepository */
    private $periodRepository;

    public function __construct(periodRepository $periodRepo)
    {
        $this->periodRepository = $periodRepo;
    }

    /**
     * Display a listing of the period.
     * GET|HEAD /periods
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->periodRepository->pushCriteria(new RequestCriteria($request));
        $this->periodRepository->pushCriteria(new LimitOffsetCriteria($request));
        $periods = $this->periodRepository->all();

        return $this->sendResponse($periods->toArray(), 'Periods retrieved successfully');
    }

    /**
     * Store a newly created period in storage.
     * POST /periods
     *
     * @param CreateperiodAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateperiodAPIRequest $request)
    {
        $input = $request->all();

        $periods = $this->periodRepository->create($input);

        return $this->sendResponse($periods->toArray(), 'Period saved successfully');
    }

    /**
     * Display the specified period.
     * GET|HEAD /periods/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var period $period */
        $period = $this->periodRepository->findWithoutFail($id);

        if (empty($period)) {
            return $this->sendError('Period not found');
        }

        return $this->sendResponse($period->toArray(), 'Period retrieved successfully');
    }

    /**
     * Update the specified period in storage.
     * PUT/PATCH /periods/{id}
     *
     * @param  int $id
     * @param UpdateperiodAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateperiodAPIRequest $request)
    {
        $input = $request->all();

        /** @var period $period */
        $period = $this->periodRepository->findWithoutFail($id);

        if (empty($period)) {
            return $this->sendError('Period not found');
        }

        $period = $this->periodRepository->update($input, $id);

        return $this->sendResponse($period->toArray(), 'period updated successfully');
    }

    /**
     * Remove the specified period from storage.
     * DELETE /periods/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var period $period */
        $period = $this->periodRepository->findWithoutFail($id);

        if (empty($period)) {
            return $this->sendError('Period not found');
        }

        $period->delete();

        return $this->sendResponse($id, 'Period deleted successfully');
    }
}

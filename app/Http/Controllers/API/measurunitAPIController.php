<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemeasurunitAPIRequest;
use App\Http\Requests\API\UpdatemeasurunitAPIRequest;
use App\Models\measurunit;
use App\Repositories\measurunitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class measurunitController
 * @package App\Http\Controllers\API
 */

class measurunitAPIController extends AppBaseController
{
    /** @var  measurunitRepository */
    private $measurunitRepository;

    public function __construct(measurunitRepository $measurunitRepo)
    {
        $this->measurunitRepository = $measurunitRepo;
    }

    /**
     * Display a listing of the measurunit.
     * GET|HEAD /measurunits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->measurunitRepository->pushCriteria(new RequestCriteria($request));
        $this->measurunitRepository->pushCriteria(new LimitOffsetCriteria($request));
        $measurunits = $this->measurunitRepository->all();

        return $this->sendResponse($measurunits->toArray(), 'Measurunits retrieved successfully');
    }

    /**
     * Store a newly created measurunit in storage.
     * POST /measurunits
     *
     * @param CreatemeasurunitAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemeasurunitAPIRequest $request)
    {
        $input = $request->all();

        $measurunits = $this->measurunitRepository->create($input);

        return $this->sendResponse($measurunits->toArray(), 'Measurunit saved successfully');
    }

    /**
     * Display the specified measurunit.
     * GET|HEAD /measurunits/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var measurunit $measurunit */
        $measurunit = $this->measurunitRepository->findWithoutFail($id);

        if (empty($measurunit)) {
            return $this->sendError('Measurunit not found');
        }

        return $this->sendResponse($measurunit->toArray(), 'Measurunit retrieved successfully');
    }

    /**
     * Update the specified measurunit in storage.
     * PUT/PATCH /measurunits/{id}
     *
     * @param  int $id
     * @param UpdatemeasurunitAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemeasurunitAPIRequest $request)
    {
        $input = $request->all();

        /** @var measurunit $measurunit */
        $measurunit = $this->measurunitRepository->findWithoutFail($id);

        if (empty($measurunit)) {
            return $this->sendError('Measurunit not found');
        }

        $measurunit = $this->measurunitRepository->update($input, $id);

        return $this->sendResponse($measurunit->toArray(), 'measurunit updated successfully');
    }

    /**
     * Remove the specified measurunit from storage.
     * DELETE /measurunits/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var measurunit $measurunit */
        $measurunit = $this->measurunitRepository->findWithoutFail($id);

        if (empty($measurunit)) {
            return $this->sendError('Measurunit not found');
        }

        $measurunit->delete();

        return $this->sendResponse($id, 'Measurunit deleted successfully');
    }
}

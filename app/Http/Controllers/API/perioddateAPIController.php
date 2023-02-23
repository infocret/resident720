<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateperioddateAPIRequest;
use App\Http\Requests\API\UpdateperioddateAPIRequest;
use App\Models\perioddate;
use App\Repositories\perioddateRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class perioddateController
 * @package App\Http\Controllers\API
 */

class perioddateAPIController extends AppBaseController
{
    /** @var  perioddateRepository */
    private $perioddateRepository;

    public function __construct(perioddateRepository $perioddateRepo)
    {
        $this->perioddateRepository = $perioddateRepo;
    }

    /**
     * Display a listing of the perioddate.
     * GET|HEAD /perioddates
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->perioddateRepository->pushCriteria(new RequestCriteria($request));
        $this->perioddateRepository->pushCriteria(new LimitOffsetCriteria($request));
        $perioddates = $this->perioddateRepository->all();

        return $this->sendResponse($perioddates->toArray(), 'Perioddates retrieved successfully');
    }

    /**
     * Store a newly created perioddate in storage.
     * POST /perioddates
     *
     * @param CreateperioddateAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateperioddateAPIRequest $request)
    {
        $input = $request->all();

        $perioddates = $this->perioddateRepository->create($input);

        return $this->sendResponse($perioddates->toArray(), 'Perioddate saved successfully');
    }

    /**
     * Display the specified perioddate.
     * GET|HEAD /perioddates/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var perioddate $perioddate */
        $perioddate = $this->perioddateRepository->findWithoutFail($id);

        if (empty($perioddate)) {
            return $this->sendError('Perioddate not found');
        }

        return $this->sendResponse($perioddate->toArray(), 'Perioddate retrieved successfully');
    }

    /**
     * Update the specified perioddate in storage.
     * PUT/PATCH /perioddates/{id}
     *
     * @param  int $id
     * @param UpdateperioddateAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateperioddateAPIRequest $request)
    {
        $input = $request->all();

        /** @var perioddate $perioddate */
        $perioddate = $this->perioddateRepository->findWithoutFail($id);

        if (empty($perioddate)) {
            return $this->sendError('Perioddate not found');
        }

        $perioddate = $this->perioddateRepository->update($input, $id);

        return $this->sendResponse($perioddate->toArray(), 'perioddate updated successfully');
    }

    /**
     * Remove the specified perioddate from storage.
     * DELETE /perioddates/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var perioddate $perioddate */
        $perioddate = $this->perioddateRepository->findWithoutFail($id);

        if (empty($perioddate)) {
            return $this->sendError('Perioddate not found');
        }

        $perioddate->delete();

        return $this->sendResponse($id, 'Perioddate deleted successfully');
    }
}

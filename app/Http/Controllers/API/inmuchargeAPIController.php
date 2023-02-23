<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateinmuchargeAPIRequest;
use App\Http\Requests\API\UpdateinmuchargeAPIRequest;
use App\Models\inmucharge;
use App\Repositories\inmuchargeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class inmuchargeController
 * @package App\Http\Controllers\API
 */

class inmuchargeAPIController extends AppBaseController
{
    /** @var  inmuchargeRepository */
    private $inmuchargeRepository;

    public function __construct(inmuchargeRepository $inmuchargeRepo)
    {
        $this->inmuchargeRepository = $inmuchargeRepo;
    }

    /**
     * Display a listing of the inmucharge.
     * GET|HEAD /inmucharges
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmuchargeRepository->pushCriteria(new RequestCriteria($request));
        $this->inmuchargeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $inmucharges = $this->inmuchargeRepository->all();

        return $this->sendResponse($inmucharges->toArray(), 'Inmucharges retrieved successfully');
    }

    /**
     * Store a newly created inmucharge in storage.
     * POST /inmucharges
     *
     * @param CreateinmuchargeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateinmuchargeAPIRequest $request)
    {
        $input = $request->all();

        $inmucharges = $this->inmuchargeRepository->create($input);

        return $this->sendResponse($inmucharges->toArray(), 'Inmucharge saved successfully');
    }

    /**
     * Display the specified inmucharge.
     * GET|HEAD /inmucharges/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var inmucharge $inmucharge */
        $inmucharge = $this->inmuchargeRepository->findWithoutFail($id);

        if (empty($inmucharge)) {
            return $this->sendError('Inmucharge not found');
        }

        return $this->sendResponse($inmucharge->toArray(), 'Inmucharge retrieved successfully');
    }

    /**
     * Update the specified inmucharge in storage.
     * PUT/PATCH /inmucharges/{id}
     *
     * @param  int $id
     * @param UpdateinmuchargeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinmuchargeAPIRequest $request)
    {
        $input = $request->all();

        /** @var inmucharge $inmucharge */
        $inmucharge = $this->inmuchargeRepository->findWithoutFail($id);

        if (empty($inmucharge)) {
            return $this->sendError('Inmucharge not found');
        }

        $inmucharge = $this->inmuchargeRepository->update($input, $id);

        return $this->sendResponse($inmucharge->toArray(), 'inmucharge updated successfully');
    }

    /**
     * Remove the specified inmucharge from storage.
     * DELETE /inmucharges/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var inmucharge $inmucharge */
        $inmucharge = $this->inmuchargeRepository->findWithoutFail($id);

        if (empty($inmucharge)) {
            return $this->sendError('Inmucharge not found');
        }

        $inmucharge->delete();

        return $this->sendResponse($id, 'Inmucharge deleted successfully');
    }
}

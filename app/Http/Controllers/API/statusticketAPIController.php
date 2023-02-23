<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatestatusticketAPIRequest;
use App\Http\Requests\API\UpdatestatusticketAPIRequest;
use App\Models\statusticket;
use App\Repositories\statusticketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class statusticketController
 * @package App\Http\Controllers\API
 */

class statusticketAPIController extends AppBaseController
{
    /** @var  statusticketRepository */
    private $statusticketRepository;

    public function __construct(statusticketRepository $statusticketRepo)
    {
        $this->statusticketRepository = $statusticketRepo;
    }

    /**
     * Display a listing of the statusticket.
     * GET|HEAD /statustickets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->statusticketRepository->pushCriteria(new RequestCriteria($request));
        $this->statusticketRepository->pushCriteria(new LimitOffsetCriteria($request));
        $statustickets = $this->statusticketRepository->all();

        return $this->sendResponse($statustickets->toArray(), 'Statustickets retrieved successfully');
    }

    /**
     * Store a newly created statusticket in storage.
     * POST /statustickets
     *
     * @param CreatestatusticketAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatestatusticketAPIRequest $request)
    {
        $input = $request->all();

        $statustickets = $this->statusticketRepository->create($input);

        return $this->sendResponse($statustickets->toArray(), 'Statusticket saved successfully');
    }

    /**
     * Display the specified statusticket.
     * GET|HEAD /statustickets/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var statusticket $statusticket */
        $statusticket = $this->statusticketRepository->findWithoutFail($id);

        if (empty($statusticket)) {
            return $this->sendError('Statusticket not found');
        }

        return $this->sendResponse($statusticket->toArray(), 'Statusticket retrieved successfully');
    }

    /**
     * Update the specified statusticket in storage.
     * PUT/PATCH /statustickets/{id}
     *
     * @param  int $id
     * @param UpdatestatusticketAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatusticketAPIRequest $request)
    {
        $input = $request->all();

        /** @var statusticket $statusticket */
        $statusticket = $this->statusticketRepository->findWithoutFail($id);

        if (empty($statusticket)) {
            return $this->sendError('Statusticket not found');
        }

        $statusticket = $this->statusticketRepository->update($input, $id);

        return $this->sendResponse($statusticket->toArray(), 'statusticket updated successfully');
    }

    /**
     * Remove the specified statusticket from storage.
     * DELETE /statustickets/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var statusticket $statusticket */
        $statusticket = $this->statusticketRepository->findWithoutFail($id);

        if (empty($statusticket)) {
            return $this->sendError('Statusticket not found');
        }

        $statusticket->delete();

        return $this->sendResponse($id, 'Statusticket deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatestatusticketimgAPIRequest;
use App\Http\Requests\API\UpdatestatusticketimgAPIRequest;
use App\Models\statusticketimg;
use App\Repositories\statusticketimgRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class statusticketimgController
 * @package App\Http\Controllers\API
 */

class statusticketimgAPIController extends AppBaseController
{
    /** @var  statusticketimgRepository */
    private $statusticketimgRepository;

    public function __construct(statusticketimgRepository $statusticketimgRepo)
    {
        $this->statusticketimgRepository = $statusticketimgRepo;
    }

    /**
     * Display a listing of the statusticketimg.
     * GET|HEAD /statusticketimgs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->statusticketimgRepository->pushCriteria(new RequestCriteria($request));
        $this->statusticketimgRepository->pushCriteria(new LimitOffsetCriteria($request));
        $statusticketimgs = $this->statusticketimgRepository->all();

        return $this->sendResponse($statusticketimgs->toArray(), 'Statusticketimgs retrieved successfully');
    }

    /**
     * Store a newly created statusticketimg in storage.
     * POST /statusticketimgs
     *
     * @param CreatestatusticketimgAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatestatusticketimgAPIRequest $request)
    {
        $input = $request->all();

        $statusticketimgs = $this->statusticketimgRepository->create($input);

        return $this->sendResponse($statusticketimgs->toArray(), 'Statusticketimg saved successfully');
    }

    /**
     * Display the specified statusticketimg.
     * GET|HEAD /statusticketimgs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var statusticketimg $statusticketimg */
        $statusticketimg = $this->statusticketimgRepository->findWithoutFail($id);

        if (empty($statusticketimg)) {
            return $this->sendError('Statusticketimg not found');
        }

        return $this->sendResponse($statusticketimg->toArray(), 'Statusticketimg retrieved successfully');
    }

    /**
     * Update the specified statusticketimg in storage.
     * PUT/PATCH /statusticketimgs/{id}
     *
     * @param  int $id
     * @param UpdatestatusticketimgAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatestatusticketimgAPIRequest $request)
    {
        $input = $request->all();

        /** @var statusticketimg $statusticketimg */
        $statusticketimg = $this->statusticketimgRepository->findWithoutFail($id);

        if (empty($statusticketimg)) {
            return $this->sendError('Statusticketimg not found');
        }

        $statusticketimg = $this->statusticketimgRepository->update($input, $id);

        return $this->sendResponse($statusticketimg->toArray(), 'statusticketimg updated successfully');
    }

    /**
     * Remove the specified statusticketimg from storage.
     * DELETE /statusticketimgs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var statusticketimg $statusticketimg */
        $statusticketimg = $this->statusticketimgRepository->findWithoutFail($id);

        if (empty($statusticketimg)) {
            return $this->sendError('Statusticketimg not found');
        }

        $statusticketimg->delete();

        return $this->sendResponse($id, 'Statusticketimg deleted successfully');
    }
}

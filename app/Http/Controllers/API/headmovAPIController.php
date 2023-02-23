<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateheadmovAPIRequest;
use App\Http\Requests\API\UpdateheadmovAPIRequest;
use App\Models\headmov;
use App\Repositories\headmovRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class headmovController
 * @package App\Http\Controllers\API
 */

class headmovAPIController extends AppBaseController
{
    /** @var  headmovRepository */
    private $headmovRepository;

    public function __construct(headmovRepository $headmovRepo)
    {
        $this->headmovRepository = $headmovRepo;
    }

    /**
     * Display a listing of the headmov.
     * GET|HEAD /headmovs
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->headmovRepository->pushCriteria(new RequestCriteria($request));
        $this->headmovRepository->pushCriteria(new LimitOffsetCriteria($request));
        $headmovs = $this->headmovRepository->all();

        return $this->sendResponse($headmovs->toArray(), 'Headmovs retrieved successfully');
    }

    /**
     * Store a newly created headmov in storage.
     * POST /headmovs
     *
     * @param CreateheadmovAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateheadmovAPIRequest $request)
    {
        $input = $request->all();

        $headmovs = $this->headmovRepository->create($input);

        return $this->sendResponse($headmovs->toArray(), 'Headmov saved successfully');
    }

    /**
     * Display the specified headmov.
     * GET|HEAD /headmovs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var headmov $headmov */
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            return $this->sendError('Headmov not found');
        }

        return $this->sendResponse($headmov->toArray(), 'Headmov retrieved successfully');
    }

    /**
     * Update the specified headmov in storage.
     * PUT/PATCH /headmovs/{id}
     *
     * @param  int $id
     * @param UpdateheadmovAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateheadmovAPIRequest $request)
    {
        $input = $request->all();

        /** @var headmov $headmov */
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            return $this->sendError('Headmov not found');
        }

        $headmov = $this->headmovRepository->update($input, $id);

        return $this->sendResponse($headmov->toArray(), 'headmov updated successfully');
    }

    /**
     * Remove the specified headmov from storage.
     * DELETE /headmovs/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var headmov $headmov */
        $headmov = $this->headmovRepository->findWithoutFail($id);

        if (empty($headmov)) {
            return $this->sendError('Headmov not found');
        }

        $headmov->delete();

        return $this->sendResponse($id, 'Headmov deleted successfully');
    }
}

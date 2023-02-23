<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemovtoheadAPIRequest;
use App\Http\Requests\API\UpdatemovtoheadAPIRequest;
use App\Models\movtohead;
use App\Repositories\movtoheadRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class movtoheadController
 * @package App\Http\Controllers\API
 */

class movtoheadAPIController extends AppBaseController
{
    /** @var  movtoheadRepository */
    private $movtoheadRepository;

    public function __construct(movtoheadRepository $movtoheadRepo)
    {
        $this->movtoheadRepository = $movtoheadRepo;
    }

    /**
     * Display a listing of the movtohead.
     * GET|HEAD /movtoheads
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->movtoheadRepository->pushCriteria(new RequestCriteria($request));
        $this->movtoheadRepository->pushCriteria(new LimitOffsetCriteria($request));
        $movtoheads = $this->movtoheadRepository->all();

        return $this->sendResponse($movtoheads->toArray(), 'Movtoheads retrieved successfully');
    }

    /**
     * Store a newly created movtohead in storage.
     * POST /movtoheads
     *
     * @param CreatemovtoheadAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemovtoheadAPIRequest $request)
    {
        $input = $request->all();

        $movtoheads = $this->movtoheadRepository->create($input);

        return $this->sendResponse($movtoheads->toArray(), 'Movtohead saved successfully');
    }

    /**
     * Display the specified movtohead.
     * GET|HEAD /movtoheads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var movtohead $movtohead */
        $movtohead = $this->movtoheadRepository->findWithoutFail($id);

        if (empty($movtohead)) {
            return $this->sendError('Movtohead not found');
        }

        return $this->sendResponse($movtohead->toArray(), 'Movtohead retrieved successfully');
    }

    /**
     * Update the specified movtohead in storage.
     * PUT/PATCH /movtoheads/{id}
     *
     * @param  int $id
     * @param UpdatemovtoheadAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovtoheadAPIRequest $request)
    {
        $input = $request->all();

        /** @var movtohead $movtohead */
        $movtohead = $this->movtoheadRepository->findWithoutFail($id);

        if (empty($movtohead)) {
            return $this->sendError('Movtohead not found');
        }

        $movtohead = $this->movtoheadRepository->update($input, $id);

        return $this->sendResponse($movtohead->toArray(), 'movtohead updated successfully');
    }

    /**
     * Remove the specified movtohead from storage.
     * DELETE /movtoheads/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var movtohead $movtohead */
        $movtohead = $this->movtoheadRepository->findWithoutFail($id);

        if (empty($movtohead)) {
            return $this->sendError('Movtohead not found');
        }

        $movtohead->delete();

        return $this->sendResponse($id, 'Movtohead deleted successfully');
    }
}

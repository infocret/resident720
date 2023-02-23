<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateanticipoAPIRequest;
use App\Http\Requests\API\UpdateanticipoAPIRequest;
use App\Models\anticipo;
use App\Repositories\anticipoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class anticipoController
 * @package App\Http\Controllers\API
 */

class anticipoAPIController extends AppBaseController
{
    /** @var  anticipoRepository */
    private $anticipoRepository;

    public function __construct(anticipoRepository $anticipoRepo)
    {
        $this->anticipoRepository = $anticipoRepo;
    }

    /**
     * Display a listing of the anticipo.
     * GET|HEAD /anticipos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->anticipoRepository->pushCriteria(new RequestCriteria($request));
        $this->anticipoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $anticipos = $this->anticipoRepository->all();

        return $this->sendResponse($anticipos->toArray(), 'Anticipos retrieved successfully');
    }

    /**
     * Store a newly created anticipo in storage.
     * POST /anticipos
     *
     * @param CreateanticipoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateanticipoAPIRequest $request)
    {
        $input = $request->all();

        $anticipo = $this->anticipoRepository->create($input);

        return $this->sendResponse($anticipo->toArray(), 'Anticipo saved successfully');
    }

    /**
     * Display the specified anticipo.
     * GET|HEAD /anticipos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var anticipo $anticipo */
        $anticipo = $this->anticipoRepository->findWithoutFail($id);

        if (empty($anticipo)) {
            return $this->sendError('Anticipo not found');
        }

        return $this->sendResponse($anticipo->toArray(), 'Anticipo retrieved successfully');
    }

    /**
     * Update the specified anticipo in storage.
     * PUT/PATCH /anticipos/{id}
     *
     * @param  int $id
     * @param UpdateanticipoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateanticipoAPIRequest $request)
    {
        $input = $request->all();

        /** @var anticipo $anticipo */
        $anticipo = $this->anticipoRepository->findWithoutFail($id);

        if (empty($anticipo)) {
            return $this->sendError('Anticipo not found');
        }

        $anticipo = $this->anticipoRepository->update($input, $id);

        return $this->sendResponse($anticipo->toArray(), 'anticipo updated successfully');
    }

    /**
     * Remove the specified anticipo from storage.
     * DELETE /anticipos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var anticipo $anticipo */
        $anticipo = $this->anticipoRepository->findWithoutFail($id);

        if (empty($anticipo)) {
            return $this->sendError('Anticipo not found');
        }

        $anticipo->delete();

        return $this->sendSuccess('Anticipo deleted successfully');
    }
}

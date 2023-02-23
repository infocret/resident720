<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepresupuestoAPIRequest;
use App\Http\Requests\API\UpdatepresupuestoAPIRequest;
use App\Models\presupuesto;
use App\Repositories\presupuestoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class presupuestoController
 * @package App\Http\Controllers\API
 */

class presupuestoAPIController extends AppBaseController
{
    /** @var  presupuestoRepository */
    private $presupuestoRepository;

    public function __construct(presupuestoRepository $presupuestoRepo)
    {
        $this->presupuestoRepository = $presupuestoRepo;
    }

    /**
     * Display a listing of the presupuesto.
     * GET|HEAD /presupuestos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->presupuestoRepository->pushCriteria(new RequestCriteria($request));
        $this->presupuestoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $presupuestos = $this->presupuestoRepository->all();

        return $this->sendResponse($presupuestos->toArray(), 'Presupuestos retrieved successfully');
    }

    /**
     * Store a newly created presupuesto in storage.
     * POST /presupuestos
     *
     * @param CreatepresupuestoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepresupuestoAPIRequest $request)
    {
        $input = $request->all();

        $presupuestos = $this->presupuestoRepository->create($input);

        return $this->sendResponse($presupuestos->toArray(), 'Presupuesto saved successfully');
    }

    /**
     * Display the specified presupuesto.
     * GET|HEAD /presupuestos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var presupuesto $presupuesto */
        $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

        if (empty($presupuesto)) {
            return $this->sendError('Presupuesto not found');
        }

        return $this->sendResponse($presupuesto->toArray(), 'Presupuesto retrieved successfully');
    }

    /**
     * Update the specified presupuesto in storage.
     * PUT/PATCH /presupuestos/{id}
     *
     * @param  int $id
     * @param UpdatepresupuestoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepresupuestoAPIRequest $request)
    {
        $input = $request->all();

        /** @var presupuesto $presupuesto */
        $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

        if (empty($presupuesto)) {
            return $this->sendError('Presupuesto not found');
        }

        $presupuesto = $this->presupuestoRepository->update($input, $id);

        return $this->sendResponse($presupuesto->toArray(), 'presupuesto updated successfully');
    }

    /**
     * Remove the specified presupuesto from storage.
     * DELETE /presupuestos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var presupuesto $presupuesto */
        $presupuesto = $this->presupuestoRepository->findWithoutFail($id);

        if (empty($presupuesto)) {
            return $this->sendError('Presupuesto not found');
        }

        $presupuesto->delete();

        return $this->sendResponse($id, 'Presupuesto deleted successfully');
    }
}

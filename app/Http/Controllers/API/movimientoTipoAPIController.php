<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemovimientoTipoAPIRequest;
use App\Http\Requests\API\UpdatemovimientoTipoAPIRequest;
use App\Models\movimientoTipo;
use App\Repositories\movimientoTipoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class movimientoTipoController
 * @package App\Http\Controllers\API
 */

class movimientoTipoAPIController extends AppBaseController
{
    /** @var  movimientoTipoRepository */
    private $movimientoTipoRepository;

    public function __construct(movimientoTipoRepository $movimientoTipoRepo)
    {
        $this->movimientoTipoRepository = $movimientoTipoRepo;
    }

    /**
     * Display a listing of the movimientoTipo.
     * GET|HEAD /movimientoTipos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->movimientoTipoRepository->pushCriteria(new RequestCriteria($request));
        $this->movimientoTipoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $movimientoTipos = $this->movimientoTipoRepository->all();

        return $this->sendResponse($movimientoTipos->toArray(), 'Movimiento Tipos retrieved successfully');
    }

    /**
     * Store a newly created movimientoTipo in storage.
     * POST /movimientoTipos
     *
     * @param CreatemovimientoTipoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemovimientoTipoAPIRequest $request)
    {
        $input = $request->all();

        $movimientoTipos = $this->movimientoTipoRepository->create($input);

        return $this->sendResponse($movimientoTipos->toArray(), 'Movimiento Tipo saved successfully');
    }

    /**
     * Display the specified movimientoTipo.
     * GET|HEAD /movimientoTipos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var movimientoTipo $movimientoTipo */
        $movimientoTipo = $this->movimientoTipoRepository->findWithoutFail($id);

        if (empty($movimientoTipo)) {
            return $this->sendError('Movimiento Tipo not found');
        }

        return $this->sendResponse($movimientoTipo->toArray(), 'Movimiento Tipo retrieved successfully');
    }

    /**
     * Update the specified movimientoTipo in storage.
     * PUT/PATCH /movimientoTipos/{id}
     *
     * @param  int $id
     * @param UpdatemovimientoTipoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovimientoTipoAPIRequest $request)
    {
        $input = $request->all();

        /** @var movimientoTipo $movimientoTipo */
        $movimientoTipo = $this->movimientoTipoRepository->findWithoutFail($id);

        if (empty($movimientoTipo)) {
            return $this->sendError('Movimiento Tipo not found');
        }

        $movimientoTipo = $this->movimientoTipoRepository->update($input, $id);

        return $this->sendResponse($movimientoTipo->toArray(), 'movimientoTipo updated successfully');
    }

    /**
     * Remove the specified movimientoTipo from storage.
     * DELETE /movimientoTipos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var movimientoTipo $movimientoTipo */
        $movimientoTipo = $this->movimientoTipoRepository->findWithoutFail($id);

        if (empty($movimientoTipo)) {
            return $this->sendError('Movimiento Tipo not found');
        }

        $movimientoTipo->delete();

        return $this->sendResponse($id, 'Movimiento Tipo deleted successfully');
    }
}

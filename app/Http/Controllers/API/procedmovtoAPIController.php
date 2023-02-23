<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateprocedmovtoAPIRequest;
use App\Http\Requests\API\UpdateprocedmovtoAPIRequest;
use App\Models\procedmovto;
use App\Repositories\procedmovtoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class procedmovtoController
 * @package App\Http\Controllers\API
 */

class procedmovtoAPIController extends AppBaseController
{
    /** @var  procedmovtoRepository */
    private $procedmovtoRepository;

    public function __construct(procedmovtoRepository $procedmovtoRepo)
    {
        $this->procedmovtoRepository = $procedmovtoRepo;
    }

    /**
     * Display a listing of the procedmovto.
     * GET|HEAD /procedmovtos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->procedmovtoRepository->pushCriteria(new RequestCriteria($request));
        $this->procedmovtoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $procedmovtos = $this->procedmovtoRepository->all();

        return $this->sendResponse($procedmovtos->toArray(), 'Procedmovtos retrieved successfully');
    }

    /**
     * Store a newly created procedmovto in storage.
     * POST /procedmovtos
     *
     * @param CreateprocedmovtoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateprocedmovtoAPIRequest $request)
    {
        $input = $request->all();

        $procedmovtos = $this->procedmovtoRepository->create($input);

        return $this->sendResponse($procedmovtos->toArray(), 'Procedmovto saved successfully');
    }

    /**
     * Display the specified procedmovto.
     * GET|HEAD /procedmovtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var procedmovto $procedmovto */
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id);

        if (empty($procedmovto)) {
            return $this->sendError('Procedmovto not found');
        }

        return $this->sendResponse($procedmovto->toArray(), 'Procedmovto retrieved successfully');
    }

    /**
     * Update the specified procedmovto in storage.
     * PUT/PATCH /procedmovtos/{id}
     *
     * @param  int $id
     * @param UpdateprocedmovtoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateprocedmovtoAPIRequest $request)
    {
        $input = $request->all();

        /** @var procedmovto $procedmovto */
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id);

        if (empty($procedmovto)) {
            return $this->sendError('Procedmovto not found');
        }

        $procedmovto = $this->procedmovtoRepository->update($input, $id);

        return $this->sendResponse($procedmovto->toArray(), 'procedmovto updated successfully');
    }

    /**
     * Remove the specified procedmovto from storage.
     * DELETE /procedmovtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var procedmovto $procedmovto */
        $procedmovto = $this->procedmovtoRepository->findWithoutFail($id);

        if (empty($procedmovto)) {
            return $this->sendError('Procedmovto not found');
        }

        $procedmovto->delete();

        return $this->sendResponse($id, 'Procedmovto deleted successfully');
    }
}

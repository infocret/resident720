<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateunidadmovtoAPIRequest;
use App\Http\Requests\API\UpdateunidadmovtoAPIRequest;
use App\Models\unidadmovto;
use App\Repositories\unidadmovtoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class unidadmovtoController
 * @package App\Http\Controllers\API
 */

class unidadmovtoAPIController extends AppBaseController
{
    /** @var  unidadmovtoRepository */
    private $unidadmovtoRepository;

    public function __construct(unidadmovtoRepository $unidadmovtoRepo)
    {
        $this->unidadmovtoRepository = $unidadmovtoRepo;
    }

    /**
     * Display a listing of the unidadmovto.
     * GET|HEAD /unidadmovtos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->unidadmovtoRepository->pushCriteria(new RequestCriteria($request));
        $this->unidadmovtoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $unidadmovtos = $this->unidadmovtoRepository->all();

        return $this->sendResponse($unidadmovtos->toArray(), 'Unidadmovtos retrieved successfully');
    }

    /**
     * Store a newly created unidadmovto in storage.
     * POST /unidadmovtos
     *
     * @param CreateunidadmovtoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateunidadmovtoAPIRequest $request)
    {
        $input = $request->all();

        $unidadmovtos = $this->unidadmovtoRepository->create($input);

        return $this->sendResponse($unidadmovtos->toArray(), 'Unidadmovto saved successfully');
    }

    /**
     * Display the specified unidadmovto.
     * GET|HEAD /unidadmovtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var unidadmovto $unidadmovto */
        $unidadmovto = $this->unidadmovtoRepository->findWithoutFail($id);

        if (empty($unidadmovto)) {
            return $this->sendError('Unidadmovto not found');
        }

        return $this->sendResponse($unidadmovto->toArray(), 'Unidadmovto retrieved successfully');
    }

    /**
     * Update the specified unidadmovto in storage.
     * PUT/PATCH /unidadmovtos/{id}
     *
     * @param  int $id
     * @param UpdateunidadmovtoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateunidadmovtoAPIRequest $request)
    {
        $input = $request->all();

        /** @var unidadmovto $unidadmovto */
        $unidadmovto = $this->unidadmovtoRepository->findWithoutFail($id);

        if (empty($unidadmovto)) {
            return $this->sendError('Unidadmovto not found');
        }

        $unidadmovto = $this->unidadmovtoRepository->update($input, $id);

        return $this->sendResponse($unidadmovto->toArray(), 'unidadmovto updated successfully');
    }

    /**
     * Remove the specified unidadmovto from storage.
     * DELETE /unidadmovtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var unidadmovto $unidadmovto */
        $unidadmovto = $this->unidadmovtoRepository->findWithoutFail($id);

        if (empty($unidadmovto)) {
            return $this->sendError('Unidadmovto not found');
        }

        $unidadmovto->delete();

        return $this->sendResponse($id, 'Unidadmovto deleted successfully');
    }
}

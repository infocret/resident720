<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecatmovtoAPIRequest;
use App\Http\Requests\API\UpdatecatmovtoAPIRequest;
use App\Models\catmovto;
use App\Repositories\catmovtoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class catmovtoController
 * @package App\Http\Controllers\API
 */

class catmovtoAPIController extends AppBaseController
{
    /** @var  catmovtoRepository */
    private $catmovtoRepository;

    public function __construct(catmovtoRepository $catmovtoRepo)
    {
        $this->catmovtoRepository = $catmovtoRepo;
    }

    /**
     * Display a listing of the catmovto.
     * GET|HEAD /catmovtos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->catmovtoRepository->pushCriteria(new RequestCriteria($request));
        $this->catmovtoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $catmovtos = $this->catmovtoRepository->all();

        return $this->sendResponse($catmovtos->toArray(), 'Catmovtos retrieved successfully');
    }

    /**
     * Store a newly created catmovto in storage.
     * POST /catmovtos
     *
     * @param CreatecatmovtoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecatmovtoAPIRequest $request)
    {
        $input = $request->all();

        $catmovtos = $this->catmovtoRepository->create($input);

        return $this->sendResponse($catmovtos->toArray(), 'Catmovto saved successfully');
    }

    /**
     * Display the specified catmovto.
     * GET|HEAD /catmovtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var catmovto $catmovto */
        $catmovto = $this->catmovtoRepository->findWithoutFail($id);

        if (empty($catmovto)) {
            return $this->sendError('Catmovto not found');
        }

        return $this->sendResponse($catmovto->toArray(), 'Catmovto retrieved successfully');
    }

    /**
     * Update the specified catmovto in storage.
     * PUT/PATCH /catmovtos/{id}
     *
     * @param  int $id
     * @param UpdatecatmovtoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecatmovtoAPIRequest $request)
    {
        $input = $request->all();

        /** @var catmovto $catmovto */
        $catmovto = $this->catmovtoRepository->findWithoutFail($id);

        if (empty($catmovto)) {
            return $this->sendError('Catmovto not found');
        }

        $catmovto = $this->catmovtoRepository->update($input, $id);

        return $this->sendResponse($catmovto->toArray(), 'catmovto updated successfully');
    }

    /**
     * Remove the specified catmovto from storage.
     * DELETE /catmovtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var catmovto $catmovto */
        $catmovto = $this->catmovtoRepository->findWithoutFail($id);

        if (empty($catmovto)) {
            return $this->sendError('Catmovto not found');
        }

        $catmovto->delete();

        return $this->sendResponse($id, 'Catmovto deleted successfully');
    }
}

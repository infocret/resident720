<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateinmumovtoAPIRequest;
use App\Http\Requests\API\UpdateinmumovtoAPIRequest;
use App\Models\inmumovto;
use App\Repositories\inmumovtoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class inmumovtoController
 * @package App\Http\Controllers\API
 */

class inmumovtoAPIController extends AppBaseController
{
    /** @var  inmumovtoRepository */
    private $inmumovtoRepository;

    public function __construct(inmumovtoRepository $inmumovtoRepo)
    {
        $this->inmumovtoRepository = $inmumovtoRepo;
    }

    /**
     * Display a listing of the inmumovto.
     * GET|HEAD /inmumovtos
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmumovtoRepository->pushCriteria(new RequestCriteria($request));
        $this->inmumovtoRepository->pushCriteria(new LimitOffsetCriteria($request));
        $inmumovtos = $this->inmumovtoRepository->all();

        return $this->sendResponse($inmumovtos->toArray(), 'Inmumovtos retrieved successfully');
    }

    /**
     * Store a newly created inmumovto in storage.
     * POST /inmumovtos
     *
     * @param CreateinmumovtoAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateinmumovtoAPIRequest $request)
    {
        $input = $request->all();

        $inmumovtos = $this->inmumovtoRepository->create($input);

        return $this->sendResponse($inmumovtos->toArray(), 'Inmumovto saved successfully');
    }

    /**
     * Display the specified inmumovto.
     * GET|HEAD /inmumovtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var inmumovto $inmumovto */
        $inmumovto = $this->inmumovtoRepository->findWithoutFail($id);

        if (empty($inmumovto)) {
            return $this->sendError('Inmumovto not found');
        }

        return $this->sendResponse($inmumovto->toArray(), 'Inmumovto retrieved successfully');
    }

    /**
     * Update the specified inmumovto in storage.
     * PUT/PATCH /inmumovtos/{id}
     *
     * @param  int $id
     * @param UpdateinmumovtoAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinmumovtoAPIRequest $request)
    {
        $input = $request->all();

        /** @var inmumovto $inmumovto */
        $inmumovto = $this->inmumovtoRepository->findWithoutFail($id);

        if (empty($inmumovto)) {
            return $this->sendError('Inmumovto not found');
        }

        $inmumovto = $this->inmumovtoRepository->update($input, $id);

        return $this->sendResponse($inmumovto->toArray(), 'inmumovto updated successfully');
    }

    /**
     * Remove the specified inmumovto from storage.
     * DELETE /inmumovtos/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var inmumovto $inmumovto */
        $inmumovto = $this->inmumovtoRepository->findWithoutFail($id);

        if (empty($inmumovto)) {
            return $this->sendError('Inmumovto not found');
        }

        $inmumovto->delete();

        return $this->sendResponse($id, 'Inmumovto deleted successfully');
    }
}

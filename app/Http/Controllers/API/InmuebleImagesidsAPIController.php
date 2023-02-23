<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInmuebleImagesidsAPIRequest;
use App\Http\Requests\API\UpdateInmuebleImagesidsAPIRequest;
use App\Models\InmuebleImagesids;
use App\Repositories\InmuebleImagesidsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InmuebleImagesidsController
 * @package App\Http\Controllers\API
 */

class InmuebleImagesidsAPIController extends AppBaseController
{
    /** @var  InmuebleImagesidsRepository */
    private $inmuebleImagesidsRepository;

    public function __construct(InmuebleImagesidsRepository $inmuebleImagesidsRepo)
    {
        $this->inmuebleImagesidsRepository = $inmuebleImagesidsRepo;
    }

    /**
     * Display a listing of the InmuebleImagesids.
     * GET|HEAD /inmuebleImagesids
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->inmuebleImagesidsRepository->pushCriteria(new RequestCriteria($request));
        $this->inmuebleImagesidsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->all();

        return $this->sendResponse($inmuebleImagesids->toArray(), 'Inmueble Imagesids retrieved successfully');
    }

    /**
     * Store a newly created InmuebleImagesids in storage.
     * POST /inmuebleImagesids
     *
     * @param CreateInmuebleImagesidsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateInmuebleImagesidsAPIRequest $request)
    {
        $input = $request->all();

        $inmuebleImagesids = $this->inmuebleImagesidsRepository->create($input);

        return $this->sendResponse($inmuebleImagesids->toArray(), 'Inmueble Imagesids saved successfully');
    }

    /**
     * Display the specified InmuebleImagesids.
     * GET|HEAD /inmuebleImagesids/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var InmuebleImagesids $inmuebleImagesids */
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->findWithoutFail($id);

        if (empty($inmuebleImagesids)) {
            return $this->sendError('Inmueble Imagesids not found');
        }

        return $this->sendResponse($inmuebleImagesids->toArray(), 'Inmueble Imagesids retrieved successfully');
    }

    /**
     * Update the specified InmuebleImagesids in storage.
     * PUT/PATCH /inmuebleImagesids/{id}
     *
     * @param  int $id
     * @param UpdateInmuebleImagesidsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInmuebleImagesidsAPIRequest $request)
    {
        $input = $request->all();

        /** @var InmuebleImagesids $inmuebleImagesids */
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->findWithoutFail($id);

        if (empty($inmuebleImagesids)) {
            return $this->sendError('Inmueble Imagesids not found');
        }

        $inmuebleImagesids = $this->inmuebleImagesidsRepository->update($input, $id);

        return $this->sendResponse($inmuebleImagesids->toArray(), 'InmuebleImagesids updated successfully');
    }

    /**
     * Remove the specified InmuebleImagesids from storage.
     * DELETE /inmuebleImagesids/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var InmuebleImagesids $inmuebleImagesids */
        $inmuebleImagesids = $this->inmuebleImagesidsRepository->findWithoutFail($id);

        if (empty($inmuebleImagesids)) {
            return $this->sendError('Inmueble Imagesids not found');
        }

        $inmuebleImagesids->delete();

        return $this->sendResponse($id, 'Inmueble Imagesids deleted successfully');
    }
}

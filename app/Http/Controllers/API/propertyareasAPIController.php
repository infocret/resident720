<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepropertyareasAPIRequest;
use App\Http\Requests\API\UpdatepropertyareasAPIRequest;
use App\Models\propertyareas;
use App\Repositories\propertyareasRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class propertyareasController
 * @package App\Http\Controllers\API
 */

class propertyareasAPIController extends AppBaseController
{
    /** @var  propertyareasRepository */
    private $propertyareasRepository;

    public function __construct(propertyareasRepository $propertyareasRepo)
    {
        $this->propertyareasRepository = $propertyareasRepo;
    }

    /**
     * Display a listing of the propertyareas.
     * GET|HEAD /propertyareas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propertyareasRepository->pushCriteria(new RequestCriteria($request));
        $this->propertyareasRepository->pushCriteria(new LimitOffsetCriteria($request));
        $propertyareas = $this->propertyareasRepository->all();

        return $this->sendResponse($propertyareas->toArray(), 'Propertyareas retrieved successfully');
    }

    /**
     * Store a newly created propertyareas in storage.
     * POST /propertyareas
     *
     * @param CreatepropertyareasAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyareasAPIRequest $request)
    {
        $input = $request->all();

        $propertyareas = $this->propertyareasRepository->create($input);

        return $this->sendResponse($propertyareas->toArray(), 'Propertyareas saved successfully');
    }

    /**
     * Display the specified propertyareas.
     * GET|HEAD /propertyareas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var propertyareas $propertyareas */
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);

        if (empty($propertyareas)) {
            return $this->sendError('Propertyareas not found');
        }

        return $this->sendResponse($propertyareas->toArray(), 'Propertyareas retrieved successfully');
    }

    /**
     * Update the specified propertyareas in storage.
     * PUT/PATCH /propertyareas/{id}
     *
     * @param  int $id
     * @param UpdatepropertyareasAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyareasAPIRequest $request)
    {
        $input = $request->all();

        /** @var propertyareas $propertyareas */
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);

        if (empty($propertyareas)) {
            return $this->sendError('Propertyareas not found');
        }

        $propertyareas = $this->propertyareasRepository->update($input, $id);

        return $this->sendResponse($propertyareas->toArray(), 'propertyareas updated successfully');
    }

    /**
     * Remove the specified propertyareas from storage.
     * DELETE /propertyareas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var propertyareas $propertyareas */
        $propertyareas = $this->propertyareasRepository->findWithoutFail($id);

        if (empty($propertyareas)) {
            return $this->sendError('Propertyareas not found');
        }

        $propertyareas->delete();

        return $this->sendResponse($id, 'Propertyareas deleted successfully');
    }
}

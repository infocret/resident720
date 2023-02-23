<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepropertyvalueAPIRequest;
use App\Http\Requests\API\UpdatepropertyvalueAPIRequest;
use App\Models\propertyvalue;
use App\Repositories\propertyvalueRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class propertyvalueController
 * @package App\Http\Controllers\API
 */

class propertyvalueAPIController extends AppBaseController
{
    /** @var  propertyvalueRepository */
    private $propertyvalueRepository;

    public function __construct(propertyvalueRepository $propertyvalueRepo)
    {
        $this->propertyvalueRepository = $propertyvalueRepo;
    }

    /**
     * Display a listing of the propertyvalue.
     * GET|HEAD /propertyvalues
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->propertyvalueRepository->pushCriteria(new RequestCriteria($request));
        $this->propertyvalueRepository->pushCriteria(new LimitOffsetCriteria($request));
        $propertyvalues = $this->propertyvalueRepository->all();

        return $this->sendResponse($propertyvalues->toArray(), 'Propertyvalues retrieved successfully');
    }

    /**
     * Store a newly created propertyvalue in storage.
     * POST /propertyvalues
     *
     * @param CreatepropertyvalueAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepropertyvalueAPIRequest $request)
    {
        $input = $request->all();

        $propertyvalues = $this->propertyvalueRepository->create($input);

        return $this->sendResponse($propertyvalues->toArray(), 'Propertyvalue saved successfully');
    }

    /**
     * Display the specified propertyvalue.
     * GET|HEAD /propertyvalues/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var propertyvalue $propertyvalue */
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            return $this->sendError('Propertyvalue not found');
        }

        return $this->sendResponse($propertyvalue->toArray(), 'Propertyvalue retrieved successfully');
    }

    /**
     * Update the specified propertyvalue in storage.
     * PUT/PATCH /propertyvalues/{id}
     *
     * @param  int $id
     * @param UpdatepropertyvalueAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepropertyvalueAPIRequest $request)
    {
        $input = $request->all();

        /** @var propertyvalue $propertyvalue */
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            return $this->sendError('Propertyvalue not found');
        }

        $propertyvalue = $this->propertyvalueRepository->update($input, $id);

        return $this->sendResponse($propertyvalue->toArray(), 'propertyvalue updated successfully');
    }

    /**
     * Remove the specified propertyvalue from storage.
     * DELETE /propertyvalues/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var propertyvalue $propertyvalue */
        $propertyvalue = $this->propertyvalueRepository->findWithoutFail($id);

        if (empty($propertyvalue)) {
            return $this->sendError('Propertyvalue not found');
        }

        $propertyvalue->delete();

        return $this->sendResponse($id, 'Propertyvalue deleted successfully');
    }
}

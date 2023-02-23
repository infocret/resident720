<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreaterelationshipPropertieAPIRequest;
use App\Http\Requests\API\UpdaterelationshipPropertieAPIRequest;
use App\Models\relationshipPropertie;
use App\Repositories\relationshipPropertieRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class relationshipPropertieController
 * @package App\Http\Controllers\API
 */

class relationshipPropertieAPIController extends AppBaseController
{
    /** @var  relationshipPropertieRepository */
    private $relationshipPropertieRepository;

    public function __construct(relationshipPropertieRepository $relationshipPropertieRepo)
    {
        $this->relationshipPropertieRepository = $relationshipPropertieRepo;
    }

    /**
     * Display a listing of the relationshipPropertie.
     * GET|HEAD /relationshipProperties
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->relationshipPropertieRepository->pushCriteria(new RequestCriteria($request));
        $this->relationshipPropertieRepository->pushCriteria(new LimitOffsetCriteria($request));
        $relationshipProperties = $this->relationshipPropertieRepository->all();

        return $this->sendResponse($relationshipProperties->toArray(), 'Relationship Properties retrieved successfully');
    }

    /**
     * Store a newly created relationshipPropertie in storage.
     * POST /relationshipProperties
     *
     * @param CreaterelationshipPropertieAPIRequest $request
     *
     * @return Response
     */
    public function store(CreaterelationshipPropertieAPIRequest $request)
    {
        $input = $request->all();

        $relationshipProperties = $this->relationshipPropertieRepository->create($input);

        return $this->sendResponse($relationshipProperties->toArray(), 'Relationship Propertie saved successfully');
    }

    /**
     * Display the specified relationshipPropertie.
     * GET|HEAD /relationshipProperties/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var relationshipPropertie $relationshipPropertie */
        $relationshipPropertie = $this->relationshipPropertieRepository->findWithoutFail($id);

        if (empty($relationshipPropertie)) {
            return $this->sendError('Relationship Propertie not found');
        }

        return $this->sendResponse($relationshipPropertie->toArray(), 'Relationship Propertie retrieved successfully');
    }

    /**
     * Update the specified relationshipPropertie in storage.
     * PUT/PATCH /relationshipProperties/{id}
     *
     * @param  int $id
     * @param UpdaterelationshipPropertieAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdaterelationshipPropertieAPIRequest $request)
    {
        $input = $request->all();

        /** @var relationshipPropertie $relationshipPropertie */
        $relationshipPropertie = $this->relationshipPropertieRepository->findWithoutFail($id);

        if (empty($relationshipPropertie)) {
            return $this->sendError('Relationship Propertie not found');
        }

        $relationshipPropertie = $this->relationshipPropertieRepository->update($input, $id);

        return $this->sendResponse($relationshipPropertie->toArray(), 'relationshipPropertie updated successfully');
    }

    /**
     * Remove the specified relationshipPropertie from storage.
     * DELETE /relationshipProperties/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var relationshipPropertie $relationshipPropertie */
        $relationshipPropertie = $this->relationshipPropertieRepository->findWithoutFail($id);

        if (empty($relationshipPropertie)) {
            return $this->sendError('Relationship Propertie not found');
        }

        $relationshipPropertie->delete();

        return $this->sendResponse($id, 'Relationship Propertie deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateanticiposapliAPIRequest;
use App\Http\Requests\API\UpdateanticiposapliAPIRequest;
use App\Models\anticiposapli;
use App\Repositories\anticiposapliRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class anticiposapliController
 * @package App\Http\Controllers\API
 */

class anticiposapliAPIController extends AppBaseController
{
    /** @var  anticiposapliRepository */
    private $anticiposapliRepository;

    public function __construct(anticiposapliRepository $anticiposapliRepo)
    {
        $this->anticiposapliRepository = $anticiposapliRepo;
    }

    /**
     * Display a listing of the anticiposapli.
     * GET|HEAD /anticiposaplis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->anticiposapliRepository->pushCriteria(new RequestCriteria($request));
        $this->anticiposapliRepository->pushCriteria(new LimitOffsetCriteria($request));
        $anticiposaplis = $this->anticiposapliRepository->all();

        return $this->sendResponse($anticiposaplis->toArray(), 'Anticiposaplis retrieved successfully');
    }

    /**
     * Store a newly created anticiposapli in storage.
     * POST /anticiposaplis
     *
     * @param CreateanticiposapliAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateanticiposapliAPIRequest $request)
    {
        $input = $request->all();

        $anticiposapli = $this->anticiposapliRepository->create($input);

        return $this->sendResponse($anticiposapli->toArray(), 'Anticiposapli saved successfully');
    }

    /**
     * Display the specified anticiposapli.
     * GET|HEAD /anticiposaplis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var anticiposapli $anticiposapli */
        $anticiposapli = $this->anticiposapliRepository->findWithoutFail($id);

        if (empty($anticiposapli)) {
            return $this->sendError('Anticiposapli not found');
        }

        return $this->sendResponse($anticiposapli->toArray(), 'Anticiposapli retrieved successfully');
    }

    /**
     * Update the specified anticiposapli in storage.
     * PUT/PATCH /anticiposaplis/{id}
     *
     * @param  int $id
     * @param UpdateanticiposapliAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateanticiposapliAPIRequest $request)
    {
        $input = $request->all();

        /** @var anticiposapli $anticiposapli */
        $anticiposapli = $this->anticiposapliRepository->findWithoutFail($id);

        if (empty($anticiposapli)) {
            return $this->sendError('Anticiposapli not found');
        }

        $anticiposapli = $this->anticiposapliRepository->update($input, $id);

        return $this->sendResponse($anticiposapli->toArray(), 'anticiposapli updated successfully');
    }

    /**
     * Remove the specified anticiposapli from storage.
     * DELETE /anticiposaplis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var anticiposapli $anticiposapli */
        $anticiposapli = $this->anticiposapliRepository->findWithoutFail($id);

        if (empty($anticiposapli)) {
            return $this->sendError('Anticiposapli not found');
        }

        $anticiposapli->delete();

        return $this->sendSuccess('Anticiposapli deleted successfully');
    }
}

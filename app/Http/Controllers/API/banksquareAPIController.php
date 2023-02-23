<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatebanksquareAPIRequest;
use App\Http\Requests\API\UpdatebanksquareAPIRequest;
use App\Models\banksquare;
use App\Repositories\banksquareRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class banksquareController
 * @package App\Http\Controllers\API
 */

class banksquareAPIController extends AppBaseController
{
    /** @var  banksquareRepository */
    private $banksquareRepository;

    public function __construct(banksquareRepository $banksquareRepo)
    {
        $this->banksquareRepository = $banksquareRepo;
    }

    /**
     * Display a listing of the banksquare.
     * GET|HEAD /banksquares
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->banksquareRepository->pushCriteria(new RequestCriteria($request));
        $this->banksquareRepository->pushCriteria(new LimitOffsetCriteria($request));
        $banksquares = $this->banksquareRepository->all();

        return $this->sendResponse($banksquares->toArray(), 'Banksquares retrieved successfully');
    }

    /**
     * Store a newly created banksquare in storage.
     * POST /banksquares
     *
     * @param CreatebanksquareAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatebanksquareAPIRequest $request)
    {
        $input = $request->all();

        $banksquares = $this->banksquareRepository->create($input);

        return $this->sendResponse($banksquares->toArray(), 'Banksquare saved successfully');
    }

    /**
     * Display the specified banksquare.
     * GET|HEAD /banksquares/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var banksquare $banksquare */
        $banksquare = $this->banksquareRepository->findWithoutFail($id);

        if (empty($banksquare)) {
            return $this->sendError('Banksquare not found');
        }

        return $this->sendResponse($banksquare->toArray(), 'Banksquare retrieved successfully');
    }

    /**
     * Update the specified banksquare in storage.
     * PUT/PATCH /banksquares/{id}
     *
     * @param  int $id
     * @param UpdatebanksquareAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebanksquareAPIRequest $request)
    {
        $input = $request->all();

        /** @var banksquare $banksquare */
        $banksquare = $this->banksquareRepository->findWithoutFail($id);

        if (empty($banksquare)) {
            return $this->sendError('Banksquare not found');
        }

        $banksquare = $this->banksquareRepository->update($input, $id);

        return $this->sendResponse($banksquare->toArray(), 'banksquare updated successfully');
    }

    /**
     * Remove the specified banksquare from storage.
     * DELETE /banksquares/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var banksquare $banksquare */
        $banksquare = $this->banksquareRepository->findWithoutFail($id);

        if (empty($banksquare)) {
            return $this->sendError('Banksquare not found');
        }

        $banksquare->delete();

        return $this->sendResponse($id, 'Banksquare deleted successfully');
    }
}

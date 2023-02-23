<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecurrencytypeAPIRequest;
use App\Http\Requests\API\UpdatecurrencytypeAPIRequest;
use App\Models\currencytype;
use App\Repositories\currencytypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class currencytypeController
 * @package App\Http\Controllers\API
 */

class currencytypeAPIController extends AppBaseController
{
    /** @var  currencytypeRepository */
    private $currencytypeRepository;

    public function __construct(currencytypeRepository $currencytypeRepo)
    {
        $this->currencytypeRepository = $currencytypeRepo;
    }

    /**
     * Display a listing of the currencytype.
     * GET|HEAD /currencytypes
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->currencytypeRepository->pushCriteria(new RequestCriteria($request));
        $this->currencytypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $currencytypes = $this->currencytypeRepository->all();

        return $this->sendResponse($currencytypes->toArray(), 'Currencytypes retrieved successfully');
    }

    /**
     * Store a newly created currencytype in storage.
     * POST /currencytypes
     *
     * @param CreatecurrencytypeAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecurrencytypeAPIRequest $request)
    {
        $input = $request->all();

        $currencytypes = $this->currencytypeRepository->create($input);

        return $this->sendResponse($currencytypes->toArray(), 'Currencytype saved successfully');
    }

    /**
     * Display the specified currencytype.
     * GET|HEAD /currencytypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var currencytype $currencytype */
        $currencytype = $this->currencytypeRepository->findWithoutFail($id);

        if (empty($currencytype)) {
            return $this->sendError('Currencytype not found');
        }

        return $this->sendResponse($currencytype->toArray(), 'Currencytype retrieved successfully');
    }

    /**
     * Update the specified currencytype in storage.
     * PUT/PATCH /currencytypes/{id}
     *
     * @param  int $id
     * @param UpdatecurrencytypeAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecurrencytypeAPIRequest $request)
    {
        $input = $request->all();

        /** @var currencytype $currencytype */
        $currencytype = $this->currencytypeRepository->findWithoutFail($id);

        if (empty($currencytype)) {
            return $this->sendError('Currencytype not found');
        }

        $currencytype = $this->currencytypeRepository->update($input, $id);

        return $this->sendResponse($currencytype->toArray(), 'currencytype updated successfully');
    }

    /**
     * Remove the specified currencytype from storage.
     * DELETE /currencytypes/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var currencytype $currencytype */
        $currencytype = $this->currencytypeRepository->findWithoutFail($id);

        if (empty($currencytype)) {
            return $this->sendError('Currencytype not found');
        }

        $currencytype->delete();

        return $this->sendResponse($id, 'Currencytype deleted successfully');
    }
}

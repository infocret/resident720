<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatepersonaccountAPIRequest;
use App\Http\Requests\API\UpdatepersonaccountAPIRequest;
use App\Models\personaccount;
use App\Repositories\personaccountRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class personaccountController
 * @package App\Http\Controllers\API
 */

class personaccountAPIController extends AppBaseController
{
    /** @var  personaccountRepository */
    private $personaccountRepository;

    public function __construct(personaccountRepository $personaccountRepo)
    {
        $this->personaccountRepository = $personaccountRepo;
    }

    /**
     * Display a listing of the personaccount.
     * GET|HEAD /personaccounts
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->personaccountRepository->pushCriteria(new RequestCriteria($request));
        $this->personaccountRepository->pushCriteria(new LimitOffsetCriteria($request));
        $personaccounts = $this->personaccountRepository->all();

        return $this->sendResponse($personaccounts->toArray(), 'Personaccounts retrieved successfully');
    }

    /**
     * Store a newly created personaccount in storage.
     * POST /personaccounts
     *
     * @param CreatepersonaccountAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatepersonaccountAPIRequest $request)
    {
        $input = $request->all();

        $personaccounts = $this->personaccountRepository->create($input);

        return $this->sendResponse($personaccounts->toArray(), 'Personaccount saved successfully');
    }

    /**
     * Display the specified personaccount.
     * GET|HEAD /personaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var personaccount $personaccount */
        $personaccount = $this->personaccountRepository->findWithoutFail($id);

        if (empty($personaccount)) {
            return $this->sendError('Personaccount not found');
        }

        return $this->sendResponse($personaccount->toArray(), 'Personaccount retrieved successfully');
    }

    /**
     * Update the specified personaccount in storage.
     * PUT/PATCH /personaccounts/{id}
     *
     * @param  int $id
     * @param UpdatepersonaccountAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatepersonaccountAPIRequest $request)
    {
        $input = $request->all();

        /** @var personaccount $personaccount */
        $personaccount = $this->personaccountRepository->findWithoutFail($id);

        if (empty($personaccount)) {
            return $this->sendError('Personaccount not found');
        }

        $personaccount = $this->personaccountRepository->update($input, $id);

        return $this->sendResponse($personaccount->toArray(), 'personaccount updated successfully');
    }

    /**
     * Remove the specified personaccount from storage.
     * DELETE /personaccounts/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var personaccount $personaccount */
        $personaccount = $this->personaccountRepository->findWithoutFail($id);

        if (empty($personaccount)) {
            return $this->sendError('Personaccount not found');
        }

        $personaccount->delete();

        return $this->sendResponse($id, 'Personaccount deleted successfully');
    }
}

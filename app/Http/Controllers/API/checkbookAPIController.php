<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatecheckbookAPIRequest;
use App\Http\Requests\API\UpdatecheckbookAPIRequest;
use App\Models\checkbook;
use App\Repositories\checkbookRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class checkbookController
 * @package App\Http\Controllers\API
 */

class checkbookAPIController extends AppBaseController
{
    /** @var  checkbookRepository */
    private $checkbookRepository;

    public function __construct(checkbookRepository $checkbookRepo)
    {
        $this->checkbookRepository = $checkbookRepo;
    }

    /**
     * Display a listing of the checkbook.
     * GET|HEAD /checkbooks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->checkbookRepository->pushCriteria(new RequestCriteria($request));
        $this->checkbookRepository->pushCriteria(new LimitOffsetCriteria($request));
        $checkbooks = $this->checkbookRepository->all();

        return $this->sendResponse($checkbooks->toArray(), 'Checkbooks retrieved successfully');
    }

    /**
     * Store a newly created checkbook in storage.
     * POST /checkbooks
     *
     * @param CreatecheckbookAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatecheckbookAPIRequest $request)
    {
        $input = $request->all();

        $checkbooks = $this->checkbookRepository->create($input);

        return $this->sendResponse($checkbooks->toArray(), 'Checkbook saved successfully');
    }

    /**
     * Display the specified checkbook.
     * GET|HEAD /checkbooks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var checkbook $checkbook */
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        if (empty($checkbook)) {
            return $this->sendError('Checkbook not found');
        }

        return $this->sendResponse($checkbook->toArray(), 'Checkbook retrieved successfully');
    }

    /**
     * Update the specified checkbook in storage.
     * PUT/PATCH /checkbooks/{id}
     *
     * @param  int $id
     * @param UpdatecheckbookAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecheckbookAPIRequest $request)
    {
        $input = $request->all();

        /** @var checkbook $checkbook */
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        if (empty($checkbook)) {
            return $this->sendError('Checkbook not found');
        }

        $checkbook = $this->checkbookRepository->update($input, $id);

        return $this->sendResponse($checkbook->toArray(), 'checkbook updated successfully');
    }

    /**
     * Remove the specified checkbook from storage.
     * DELETE /checkbooks/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var checkbook $checkbook */
        $checkbook = $this->checkbookRepository->findWithoutFail($id);

        if (empty($checkbook)) {
            return $this->sendError('Checkbook not found');
        }

        $checkbook->delete();

        return $this->sendResponse($id, 'Checkbook deleted successfully');
    }
}

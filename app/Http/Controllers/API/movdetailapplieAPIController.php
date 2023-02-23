<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemovdetailapplieAPIRequest;
use App\Http\Requests\API\UpdatemovdetailapplieAPIRequest;
use App\Models\movdetailapplie;
use App\Repositories\movdetailapplieRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class movdetailapplieController
 * @package App\Http\Controllers\API
 */

class movdetailapplieAPIController extends AppBaseController
{
    /** @var  movdetailapplieRepository */
    private $movdetailapplieRepository;

    public function __construct(movdetailapplieRepository $movdetailapplieRepo)
    {
        $this->movdetailapplieRepository = $movdetailapplieRepo;
    }

    /**
     * Display a listing of the movdetailapplie.
     * GET|HEAD /movdetailapplies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->movdetailapplieRepository->pushCriteria(new RequestCriteria($request));
        $this->movdetailapplieRepository->pushCriteria(new LimitOffsetCriteria($request));
        $movdetailapplies = $this->movdetailapplieRepository->all();

        return $this->sendResponse($movdetailapplies->toArray(), 'Movdetailapplies retrieved successfully');
    }

    /**
     * Store a newly created movdetailapplie in storage.
     * POST /movdetailapplies
     *
     * @param CreatemovdetailapplieAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemovdetailapplieAPIRequest $request)
    {
        $input = $request->all();

        $movdetailapplies = $this->movdetailapplieRepository->create($input);

        return $this->sendResponse($movdetailapplies->toArray(), 'Movdetailapplie saved successfully');
    }

    /**
     * Display the specified movdetailapplie.
     * GET|HEAD /movdetailapplies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var movdetailapplie $movdetailapplie */
        $movdetailapplie = $this->movdetailapplieRepository->findWithoutFail($id);

        if (empty($movdetailapplie)) {
            return $this->sendError('Movdetailapplie not found');
        }

        return $this->sendResponse($movdetailapplie->toArray(), 'Movdetailapplie retrieved successfully');
    }

    /**
     * Update the specified movdetailapplie in storage.
     * PUT/PATCH /movdetailapplies/{id}
     *
     * @param  int $id
     * @param UpdatemovdetailapplieAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovdetailapplieAPIRequest $request)
    {
        $input = $request->all();

        /** @var movdetailapplie $movdetailapplie */
        $movdetailapplie = $this->movdetailapplieRepository->findWithoutFail($id);

        if (empty($movdetailapplie)) {
            return $this->sendError('Movdetailapplie not found');
        }

        $movdetailapplie = $this->movdetailapplieRepository->update($input, $id);

        return $this->sendResponse($movdetailapplie->toArray(), 'movdetailapplie updated successfully');
    }

    /**
     * Remove the specified movdetailapplie from storage.
     * DELETE /movdetailapplies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var movdetailapplie $movdetailapplie */
        $movdetailapplie = $this->movdetailapplieRepository->findWithoutFail($id);

        if (empty($movdetailapplie)) {
            return $this->sendError('Movdetailapplie not found');
        }

        $movdetailapplie->delete();

        return $this->sendResponse($id, 'Movdetailapplie deleted successfully');
    }
}

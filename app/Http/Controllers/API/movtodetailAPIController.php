<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemovtodetailAPIRequest;
use App\Http\Requests\API\UpdatemovtodetailAPIRequest;
use App\Models\movtodetail;
use App\Repositories\movtodetailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class movtodetailController
 * @package App\Http\Controllers\API
 */

class movtodetailAPIController extends AppBaseController
{
    /** @var  movtodetailRepository */
    private $movtodetailRepository;

    public function __construct(movtodetailRepository $movtodetailRepo)
    {
        $this->movtodetailRepository = $movtodetailRepo;
    }

    /**
     * Display a listing of the movtodetail.
     * GET|HEAD /movtodetails
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->movtodetailRepository->pushCriteria(new RequestCriteria($request));
        $this->movtodetailRepository->pushCriteria(new LimitOffsetCriteria($request));
        $movtodetails = $this->movtodetailRepository->all();

        return $this->sendResponse($movtodetails->toArray(), 'Movtodetails retrieved successfully');
    }

    /**
     * Store a newly created movtodetail in storage.
     * POST /movtodetails
     *
     * @param CreatemovtodetailAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemovtodetailAPIRequest $request)
    {
        $input = $request->all();

        $movtodetails = $this->movtodetailRepository->create($input);

        return $this->sendResponse($movtodetails->toArray(), 'Movtodetail saved successfully');
    }

    /**
     * Display the specified movtodetail.
     * GET|HEAD /movtodetails/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var movtodetail $movtodetail */
        $movtodetail = $this->movtodetailRepository->findWithoutFail($id);

        if (empty($movtodetail)) {
            return $this->sendError('Movtodetail not found');
        }

        return $this->sendResponse($movtodetail->toArray(), 'Movtodetail retrieved successfully');
    }

    /**
     * Update the specified movtodetail in storage.
     * PUT/PATCH /movtodetails/{id}
     *
     * @param  int $id
     * @param UpdatemovtodetailAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemovtodetailAPIRequest $request)
    {
        $input = $request->all();

        /** @var movtodetail $movtodetail */
        $movtodetail = $this->movtodetailRepository->findWithoutFail($id);

        if (empty($movtodetail)) {
            return $this->sendError('Movtodetail not found');
        }

        $movtodetail = $this->movtodetailRepository->update($input, $id);

        return $this->sendResponse($movtodetail->toArray(), 'movtodetail updated successfully');
    }

    /**
     * Remove the specified movtodetail from storage.
     * DELETE /movtodetails/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var movtodetail $movtodetail */
        $movtodetail = $this->movtodetailRepository->findWithoutFail($id);

        if (empty($movtodetail)) {
            return $this->sendError('Movtodetail not found');
        }

        $movtodetail->delete();

        return $this->sendResponse($id, 'Movtodetail deleted successfully');
    }
}

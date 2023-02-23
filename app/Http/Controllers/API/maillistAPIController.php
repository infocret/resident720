<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemaillistAPIRequest;
use App\Http\Requests\API\UpdatemaillistAPIRequest;
use App\Models\maillist;
use App\Repositories\maillistRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class maillistController
 * @package App\Http\Controllers\API
 */

class maillistAPIController extends AppBaseController
{
    /** @var  maillistRepository */
    private $maillistRepository;

    public function __construct(maillistRepository $maillistRepo)
    {
        $this->maillistRepository = $maillistRepo;
    }

    /**
     * Display a listing of the maillist.
     * GET|HEAD /maillists
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->maillistRepository->pushCriteria(new RequestCriteria($request));
        $this->maillistRepository->pushCriteria(new LimitOffsetCriteria($request));
        $maillists = $this->maillistRepository->all();

        return $this->sendResponse($maillists->toArray(), 'Maillists retrieved successfully');
    }

    /**
     * Store a newly created maillist in storage.
     * POST /maillists
     *
     * @param CreatemaillistAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemaillistAPIRequest $request)
    {
        $input = $request->all();

        $maillists = $this->maillistRepository->create($input);

        return $this->sendResponse($maillists->toArray(), 'Maillist saved successfully');
    }

    /**
     * Display the specified maillist.
     * GET|HEAD /maillists/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var maillist $maillist */
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            return $this->sendError('Maillist not found');
        }

        return $this->sendResponse($maillist->toArray(), 'Maillist retrieved successfully');
    }

    /**
     * Update the specified maillist in storage.
     * PUT/PATCH /maillists/{id}
     *
     * @param  int $id
     * @param UpdatemaillistAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemaillistAPIRequest $request)
    {
        $input = $request->all();

        /** @var maillist $maillist */
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            return $this->sendError('Maillist not found');
        }

        $maillist = $this->maillistRepository->update($input, $id);

        return $this->sendResponse($maillist->toArray(), 'maillist updated successfully');
    }

    /**
     * Remove the specified maillist from storage.
     * DELETE /maillists/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var maillist $maillist */
        $maillist = $this->maillistRepository->findWithoutFail($id);

        if (empty($maillist)) {
            return $this->sendError('Maillist not found');
        }

        $maillist->delete();

        return $this->sendResponse($id, 'Maillist deleted successfully');
    }
}

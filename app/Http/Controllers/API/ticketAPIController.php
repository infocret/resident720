<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateticketAPIRequest;
use App\Http\Requests\API\UpdateticketAPIRequest;
use App\Models\ticket;
use App\Repositories\ticketRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ticketController
 * @package App\Http\Controllers\API
 */

class ticketAPIController extends AppBaseController
{
    /** @var  ticketRepository */
    private $ticketRepository;

    public function __construct(ticketRepository $ticketRepo)
    {
        $this->ticketRepository = $ticketRepo;
    }

    /**
     * Display a listing of the ticket.
     * GET|HEAD /tickets
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->ticketRepository->pushCriteria(new RequestCriteria($request));
        $this->ticketRepository->pushCriteria(new LimitOffsetCriteria($request));
        $tickets = $this->ticketRepository->all();

        return $this->sendResponse($tickets->toArray(), 'Tickets retrieved successfully');
    }

    /**
     * Store a newly created ticket in storage.
     * POST /tickets
     *
     * @param CreateticketAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateticketAPIRequest $request)
    {
        $input = $request->all();

        $tickets = $this->ticketRepository->create($input);

        return $this->sendResponse($tickets->toArray(), 'Ticket saved successfully');
    }

    /**
     * Display the specified ticket.
     * GET|HEAD /tickets/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ticket $ticket */
        $ticket = $this->ticketRepository->findWithoutFail($id);

        if (empty($ticket)) {
            return $this->sendError('Ticket not found');
        }

        return $this->sendResponse($ticket->toArray(), 'Ticket retrieved successfully');
    }

    /**
     * Update the specified ticket in storage.
     * PUT/PATCH /tickets/{id}
     *
     * @param  int $id
     * @param UpdateticketAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateticketAPIRequest $request)
    {
        $input = $request->all();

        /** @var ticket $ticket */
        $ticket = $this->ticketRepository->findWithoutFail($id);

        if (empty($ticket)) {
            return $this->sendError('Ticket not found');
        }

        $ticket = $this->ticketRepository->update($input, $id);

        return $this->sendResponse($ticket->toArray(), 'ticket updated successfully');
    }

    /**
     * Remove the specified ticket from storage.
     * DELETE /tickets/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ticket $ticket */
        $ticket = $this->ticketRepository->findWithoutFail($id);

        if (empty($ticket)) {
            return $this->sendError('Ticket not found');
        }

        $ticket->delete();

        return $this->sendResponse($id, 'Ticket deleted successfully');
    }
}

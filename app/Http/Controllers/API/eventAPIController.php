<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateeventAPIRequest;
use App\Http\Requests\API\UpdateeventAPIRequest;
use App\Models\event;
use App\Repositories\eventRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class eventController
 * @package App\Http\Controllers\API
 */

class eventAPIController extends AppBaseController
{
    /** @var  eventRepository */
    private $eventRepository;

    public function __construct(eventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
    }

    /**
     * Display a listing of the event.
     * GET|HEAD /events
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->eventRepository->pushCriteria(new RequestCriteria($request));
        $this->eventRepository->pushCriteria(new LimitOffsetCriteria($request));
        $events = $this->eventRepository->all();

        return $this->sendResponse($events->toArray(), 'Events retrieved successfully');
    }

    /**
     * Store a newly created event in storage.
     * POST /events
     *
     * @param CreateeventAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateeventAPIRequest $request)
    {
        $input = $request->all();

        $events = $this->eventRepository->create($input);

        return $this->sendResponse($events->toArray(), 'Event saved successfully');
    }

    /**
     * Display the specified event.
     * GET|HEAD /events/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var event $event */
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            return $this->sendError('Event not found');
        }

        return $this->sendResponse($event->toArray(), 'Event retrieved successfully');
    }

    /**
     * Update the specified event in storage.
     * PUT/PATCH /events/{id}
     *
     * @param  int $id
     * @param UpdateeventAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateeventAPIRequest $request)
    {
        $input = $request->all();

        /** @var event $event */
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            return $this->sendError('Event not found');
        }

        $event = $this->eventRepository->update($input, $id);

        return $this->sendResponse($event->toArray(), 'event updated successfully');
    }

    /**
     * Remove the specified event from storage.
     * DELETE /events/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var event $event */
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            return $this->sendError('Event not found');
        }

        $event->delete();

        return $this->sendResponse($id, 'Event deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\eventDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateeventRequest;
use App\Http\Requests\UpdateeventRequest;
use App\Repositories\eventRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

use Calendar;
use Event;
class eventController extends AppBaseController
{
    /** @var  eventRepository */
    private $eventRepository;

    public function __construct(eventRepository $eventRepo)
    {
        $this->eventRepository = $eventRepo;
    }


 public function showcalendar()

    {

       $events = [];

       //$data = Event::all();
       $data = $this->eventRepository->all();


       if($data->count()){

          foreach ($data as $key => $value) {

            $events[] = Calendar::event(

                $value->title,

                true,

                new \DateTime($value->start_date),

                new \DateTime($value->end_date.' +1 day')

            );

          }

       }

      $calendar = Calendar::addEvents($events); 

      return view('events.mycalenderlay', compact('calendar'));

    }

    /**
     * Display a listing of the event.
     *
     * @param eventDataTable $eventDataTable
     * @return Response
     */
    public function index(eventDataTable $eventDataTable)
    {
        return $eventDataTable->render('events.index');
    }

    /**
     * Show the form for creating a new event.
     *
     * @return Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created event in storage.
     *
     * @param CreateeventRequest $request
     *
     * @return Response
     */
    public function store(CreateeventRequest $request)
    {
        $input = $request->all();

        $event = $this->eventRepository->create($input);

        Flash::success('Event saved successfully.');

        return redirect(route('events.index'));
    }

    /**
     * Display the specified event.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        return view('events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified event.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        return view('events.edit')->with('event', $event);
    }

    /**
     * Update the specified event in storage.
     *
     * @param  int              $id
     * @param UpdateeventRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateeventRequest $request)
    {
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        $event = $this->eventRepository->update($request->all(), $id);

        Flash::success('Event updated successfully.');

        return redirect(route('events.index'));
    }

    /**
     * Remove the specified event from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $event = $this->eventRepository->findWithoutFail($id);

        if (empty($event)) {
            Flash::error('Event not found');

            return redirect(route('events.index'));
        }

        $this->eventRepository->delete($id);

        Flash::success('Event deleted successfully.');

        return redirect(route('events.index'));
    }
}

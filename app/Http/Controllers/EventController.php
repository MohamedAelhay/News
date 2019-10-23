<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests\events\EventStoreRequest;
use App\Services\EventService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EventController extends Controller
{
    protected $eventService;

    public function __construct(EventService $service)
    {
        $this->eventService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            return $this->eventService->eventIndexByDataTables();
        }

        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('events.create', [
            'visitors' => $this->eventService->getVisitorUsers()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EventStoreRequest $request
     * @return Response
     */
    public function store(EventStoreRequest $request)
    {
        $this->eventService->store($request->input());

        return redirect()->route('events.index')->with(
            [
                'success' => 'Event: "'.$request->main_title.'" has been Created.'
            ]
        );
    }


    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Response
     */
    public function edit(Event $event)
    {
        return view('events.edit', [
           'event' => $event,
           'visitors' => $this->eventService->getVisitorUsers(),
           'eventVisitors' => $this->eventService->getVisitorsId($event)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Event $event
     * @return Response
     */
    public function update(Request $request, Event $event)
    {
        $this->eventService->updateEvent($request, $event);

        return redirect()->route('events.index')->with(
            [
                'success' => 'Event: "'.$request->main_title.'" has been Updated.'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return Response
     * @throws Exception
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with(
            [
                'success' => 'Event "'.$event->main_title .'" has been Deleted.'
            ]
        );
    }
}

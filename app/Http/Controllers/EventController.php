<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::query()
            ->with('user', 'tags')
            ->published()
            ->isNotFinished()
            ->withCount([
                'attendees' => fn ($query) => $query->where('status', 'going'),
            ])
            ->get();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $slug)
    {

        $event = Event::query()
            ->where('slug', $slug)
            ->with('user')
            ->published()
            ->checkIfIsAttendeed()
            // ->withPeopopleWhoIsGoing()
            ->first();

        return view('event.single', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Event $event)
    {
        abort_if(!($event->status == 'active') || !($event->user_id === auth()->id()), 403);

        return view('event.update', compact('event'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    public function goingto()
    {
        $events = Event::query()
            ->eventIAmGoingTo()
            ->get();

        return view('event.goingto', compact('events'));
    }

    public function myevents()
    {
        $events = Event::query()
            ->where('user_id', auth()->id())
            ->get();

        return view('event.myevent', compact('events'));
    }
}

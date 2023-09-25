<?php

namespace App\Http\Controllers;

use App\Models\Event;

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
            ->countAttendees()
            ->get(1);

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
     * Display the specified resource.
     */
    public function show(string $slug)
    {

        $event = Event::query()
            ->whereSlug($slug)
            ->with('user')
            ->when('user_id' == auth()->id(), function ($query) {
                $query->published();
            })
            ->checkIfIsAttendeed()
            // ->withPeopopleWhoIsGoing()
            ->first();

        abort_if(! $event, 404);

        return view('event.single', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Event $event)
    {
        abort_if(! ($event->status == 'active') || auth()->user()->cannot('update', $event), 403);

        return view('event.update', compact('event'));
    }

    public function goingTo()
    {
        $events = Event::query()
            ->eventIAmGoingTo()
            ->get();

        return view('event.goingto', compact('events'));
    }

    public function myEvents()
    {
        $events = Event::query()
            ->myEvents()
            ->get();

        return view('event.myevent', compact('events'));
    }
}

<?php
use function Livewire\Volt\{state, on};

state(['event_id'])->locked();

on(['event-toggle' => fn() => state(['event_id' => null])]);


$peoples = function () {
    // return $this->event_id;
    return App\Models\Attendee::query()
        ->withWhereHas('user', function ($query) {
            $query->select('id', 'name');
        })
        ->where('event_id', $this->event_id)
        ->where('status', 'going')
        ->latest()
        ->get();
    // ->map(function ($attendee) {
    //     return $attendee->user->name;
    // });
};
?>
<div>
    @forelse ($this->peoples() as $people)
        <span>
            {{ $people->user->name }} <br>
        </span>
    @empty
        NUK KA njerz per kete event
    @endforelse
</div>

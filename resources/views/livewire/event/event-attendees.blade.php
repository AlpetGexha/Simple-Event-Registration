<?php

use function Livewire\Volt\{state, on};

state(['event_id'])->locked();

on(['event-toggle' => fn() => state(['event_id' => null])]);


$peoples = function () {
    // return $this->event_id;
    return App\Models\Attendee::query()
        ->with('user')
        ->withWhereHas('user', function ($query) {
            $query->select('id', 'name');
        })
        ->where('event_id', $this->event_id)
        ->where('status', 'going')
        ->latest()
        ->get();
};

use function Livewire\Volt\{computed};

$count = computed(function () {
    return App\Models\Attendee::query()
        ->where('event_id', $this->event_id)
        ->where('status', 'going')
        ->count();
});
?>
<div>
    <h1>People going: {{ $this->count }}</h1>
    @forelse ($this->peoples() as $people)
        <span>
           <i> {{ $people->user->name }} </i>
            @if($people->user->id === auth()->id())
                (me)
            @endif

            <br>

        </span>
    @empty
        {{ __('No people found') }}
    @endforelse
</div>

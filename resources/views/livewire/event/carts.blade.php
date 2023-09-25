<?php

use function Livewire\Volt\{state, placeholder, on};

state('events');
// placeholder('components.skeleton-load');

// on(['eventDeleted' => fn() => state(['events' => null])]);
// refresh the component
on(['eventDeleted' => fn() => session()->flash('status', 'Event Deleted')]);

?>

<div>

    @if (session()->has('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    @forelse ($events as $event)
        <livewire:event.cart :event="$event" :key="$event->id" />
    @empty
        NUK KA EVENTE
    @endforelse


</div>

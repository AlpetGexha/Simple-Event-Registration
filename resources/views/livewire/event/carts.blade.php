<?php

use function Livewire\Volt\{state};

state('events')
?>

<div>

    @forelse($events as $event)
        <livewire:event.cart :event="$event" :key="$event->id" />
    @empty
        NUK KA EVENTE
    @endforelse


</div>

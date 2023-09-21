<?php

use function Livewire\Volt\{state};

state(['event']);

?>
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <b>
                <h3><a wire:navigate href="{{ route('event.single', ['event' => $event->slug]) }}">{{ $event->title }}</a></h3>
            </b>

            {{ $event->body }}
            <br>
            <b>Host: <i>{{ $event->user->name }}</i></b>

            <br>
            {{ \Carbon\Carbon::parse($event->start_date)->isoFormat('MMM Do YYYY h:mm') }} -
            {{ \Carbon\Carbon::parse($event->end_date)->isoFormat('MMM Do YYYY h:mm') }}
            <br>
            Starting in: {{ $event->start_date->diffForHumans() }}

        </div>
    </div>
</div>

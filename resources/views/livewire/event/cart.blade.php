<?php

use function Livewire\Volt\{state};

state(['event']);
?>

{{-- @dd($event->getTagsValue()) --}}

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-5">
    <div class="p-6 text-gray-900">
        <b>
            <h3>
                <a wire:navigate href="{{ route('event.single', ['event' => $event->slug]) }}">{{ $event->title }}</a>
            </h3>
        </b>
        {{-- @dd($event) --}}
        tags:
        @forelse ($event->tags as $tag)
            <span
                class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                {{ $tag->name }}
            </span>

        @empty
        @endforelse
        <br>

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

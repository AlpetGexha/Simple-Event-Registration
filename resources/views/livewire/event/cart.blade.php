<?php

use Carbon\Carbon;
use function Livewire\Volt\{state};

state(['event']);

$delete = function () {
    $this->event->delete();

    $this->dispatch('eventDeleted');
};
?>

{{-- @dd($event->getTagsValue()) --}}

<x-cart class="mt-5 mb-1">
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
    {{ App\Service\EventService::dateRange($event->start_date, $event->end_date) }}
    <br>

    Starting in: {{ $event->start_date->diffForHumans() }}
    <br>
    (test) Status: <b>{{ App\Service\EventService::eventStatusDate($event->start_date, $event->end_date) }}</b>
    <br>
    People going: {{ $event->attendees_count }}

    @if ($event->user_id === auth()->id())
        <br><br><br>
        <a wire:navigate href="{{ route('event.update', ['event' => $event->id]) }}">Update</a>
        <br>
        <x-danger-button wire:click='delete'>
            {{ __('Delete') }}
        </x-danger-button>
    @endif
</x-cart>

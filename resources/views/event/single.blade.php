<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($event->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- @dd($event) --}}
        Title: {{ $event->title }}
        <br>
        Description: {{ $event->description }}
        <br>
        Location: {{ $event->place }}
        <br>
        Start Date: {{ $event->start_date }}
        to
        End Date: {{ $event->end_date }}
        <br>

        START TIME: {{ $event->start_date->diffForHumans() }}
        <br>

        HOST: {{ $event->user->name }}

        <br><br><br>

        <livewire:event.action :event="$event" />

        People Who are going <br>

        <livewire:event.event-attendees :event_id="$event->id" />

    </div>
</x-app-layout>

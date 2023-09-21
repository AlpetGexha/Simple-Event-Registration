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
        @forelse ($event->attendees as $event)
            <i>{{ $event->user->name }}</i> <br>
        @empty
            NUK KA njerz per kete event
        @endforelse

    </div>
</x-app-layout>

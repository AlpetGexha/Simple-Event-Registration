<?php

use function Livewire\Volt\{state, placeholder, on, usesPagination};

//usesPagination();

state('events');
// placeholder('components.skeleton-load');
on(['eventDeleted' => fn() => session()->flash('status', 'Event Deleted')]);

?>

<div>
    @if (session()->has('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    @forelse ($events as $event)
{{--        @can('view', $event)--}}
            <livewire:event.cart :event="$event" :key="$event->id"/>
{{--        @endcan--}}
    @empty
        {{ __('No events found')}}
    @endforelse

{{--    {{ $events->links() }}--}}

</div>

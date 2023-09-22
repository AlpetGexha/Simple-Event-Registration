<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    {{-- @can('viewAny', \App\Models\Event::class) --}}
        <livewire:event.carts :events="$events" />
    {{-- @endcan --}}

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update an Event') }}
        </h2>
    </x-slot>

    <livewire:event.update :event="$event" />

</x-app-layout>

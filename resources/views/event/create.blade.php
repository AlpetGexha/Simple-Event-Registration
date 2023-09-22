<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create an Event') }}
        </h2>
    </x-slot>

    <livewire:event.create  />

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Events That I am Going to') }}
        </h2>
    </x-slot>

    
        <livewire:event.carts :events="$events" lazy />

</x-app-layout>

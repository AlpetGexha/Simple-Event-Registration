<?php

use function Livewire\Volt\{state};
use function Livewire\Volt\{computed};


state(['event']);
state(['isAttendee' => fn($event) => $event->is_attended]);

$attendee = function () {
    $this->event->attendees()->create([
        'user_id' => auth()->id(),
        'event_id' => $this->event->id,
        'status' => 'going',
    ]);

    $this->dispatch('attendee');
};

$unAttendee = function () {
    $this->event
        ->attendees()
        ->where('user_id', auth()->id())
        ->delete();

    $this->dispatch('unAtendee');
};

$userHasAttendee = function () {
    return $this->event
        ->attendees()
        ->where('user_id', auth()->id())
        ->exists();
};

$toggle = function () {
    if ($this->userHasAttendee()) {
        $this->unAttendee();
    } else {
        $this->attendee();
    }

    $this->dispatch('toggle');
};


?>

<span class="inline-flex items-center text-sm">
    ARE U GOING :
    @volt
        <form wire:submit="toggle">
            <x-primary-button class="ml-3" wire:loading.attr='disable'>
                {{ $isAttendee ? 'I CHANGE MY MIND' : 'YES' }}
            </x-primary-button>
        </form>
    @endvolt
</span>

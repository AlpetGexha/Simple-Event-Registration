<?php

use function Livewire\Volt\{state};
use function Livewire\Volt\{computed};
use Livewire\Attributes\On;

state(['event']);
state(['isAttendee' => fn($event) => $event->is_attended]);

$attendee = function () {
    $this->event->attendees()->create([
        'user_id' => auth()->id(),
        'event_id' => $this->event->id,
        'status' => 'going',
    ]);
};

$unAttendee = function () {
    $this->event
        ->attendees()
        ->where('user_id', auth()->id())
        ->delete();
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

    $this->isAttendee = !$this->isAttendee;
};

?>

<span class="inline-flex items-center text-sm">
    ARE U GOING :
    @volt('attendee')
        <form wire:submit.prevent="toggle">
            <x-primary-button class="ml-3" wire:loading.attr='disable' wire:loading.class='bg-gray-400'>
                {{ $isAttendee ? 'I CHANGE MY MIND' : 'YES' }}
            </x-primary-button>
        </form>
    @endvolt
</span>

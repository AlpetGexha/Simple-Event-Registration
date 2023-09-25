<?php

namespace App\Livewire\Event;

use App\Models\Attendee;
use Livewire\Component;

class Action extends Component
{
    public $event;
    public $isAttendee = false;

    protected $listeners = [
        'unAtendee' => '$refresh',
        'attendee' => '$refresh',
    ];

    public function mount($event)
    {
        $this->event = $event;
        $this->isAttendee = $this->userHasAttendee();
    }

    public function toggle()
    {
        if ($this->isAttendee) {
            return $this->unAtendee();
        }

        return $this->attendee();
    }

    public function userHasAttendee(): bool
    {
        return $this->event->attendees()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function render()
    {
        return view('livewire.event.action');
    }

    private function attendee()
    {
        // check if user
        $this->authorize('create', Attendee::class);

        $this->event->attendees()->create([
            'user_id' => auth()->id(),
            'event_id' => $this->event->id,
            'status' => 'going',
        ]);

        $this->dispatch('attendee');
    }

    private function unAtendee()
    {
        $this->event
            ->attendees()
            ->where('user_id', auth()->id())
            ->delete();

        $this->dispatch('attendee');
    }
}

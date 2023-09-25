<?php

namespace App\Livewire\Event;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Action extends Component
{
    public Event $event;
    public bool $isAttendee = false;

    public function mount($event): void
    {
        $this->event = $event;
        $this->isAttendee = $this->userHasAttendee();
    }

    public function userHasAttendee(): bool
    {
        return $this->event->attendees()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function toggle(): void
    {
        if ($this->isAttendee) {
            $this->unAttendee();

            return;
        }

        $this->attendee();
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.event.action');
    }

    private function unAttendee(): void
    {
        $this->event
            ->attendees()
            ->where('user_id', auth()->id())
            ->delete();

        $this->dispatch('attendee');
    }

    private function attendee(): void
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
}

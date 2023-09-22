<?php

namespace App\Livewire\Event;

use App\Livewire\Forms\EventForm;
use App\Models\Event;
use App\Traits\WithAuthRedirects;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Create extends Component
{
    use WithAuthRedirects;
    public EventForm $form;

    public function create()
    {
        if (!auth()->check()) {
            return $this->redirectToLogin();
        }
        // dd($this->form);
        // DB::transaction(function (EventForm $form) {
        $event = Event::create(
            $this->form->all()
        );
        return $this->redirect(route('event.update', ['event' => $event->id]));
        // create an Attendee form this event
        // $event->attendees()->create([
        //     'status' => 'going',
        // ]);
        // });
        // dd($event);


        // $this->reset($this->form->all());
    }

    public function render()
    {
        return view('livewire.event.create');
    }
}

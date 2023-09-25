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

    public function create(): \Illuminate\Http\RedirectResponse
    {
        if (! auth()->check()) {
            return $this->redirectToLogin();
        }
        // dd($this->form);
        // DB::transaction(function (EventForm $form) {
        $this->form->validate();

        $event = Event::create(
            $this->form->all()
        );

        $tags = explode(',', $this->form->tags);
        $event->attachTags($tags);

        // $event->tags()->create($tags);

        return to_route('event.update', ['event' => $event->id]);
        // create an Attendee form this event
        // $event->attendees()->create([
        //     'status' => 'going',
        // ]);
        // });
        // dd($event);

        // $this->reset($this->form->all());
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.event.create');
    }
}

<?php

namespace App\Livewire\Event;

use App\Livewire\Forms\EventForm;
use App\Models\Event;
use Livewire\Component;

class Update extends Component
{
    public Event $event;

    public EventForm $form;

    public function mount($event): void
    {
        $this->form->setEvent($event);
    }

    public function update()
    {
        $this->event->update(
            $this->form->all()
        );

        return $this->redirect(route('event.single', $this->event->slug));
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.event.update');
    }
}

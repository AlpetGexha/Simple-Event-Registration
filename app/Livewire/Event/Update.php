<?php

namespace App\Livewire\Event;

use App\Livewire\Forms\EventForm;
use Livewire\Component;

class Update extends Component
{
    public $event;

    public EventForm $form;

    public function mount($event)
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

    public function render()
    {
        return view('livewire.event.update');
    }
}

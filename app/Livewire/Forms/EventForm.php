<?php

namespace App\Livewire\Forms;

use App\Models\Event;
use Livewire\Attributes\Rule;
use Livewire\Form;

class EventForm extends Form
{
    #[Rule('required|min:2|max:255')]
    public $title;

    #[Rule('required|min:3|max:2000')]
    public $body;

    #[Rule('required|min:2|max:255')]
    public $place;

    // #[Rule('required|before:end_date')]
    #[Rule('required')]
    public $start_date;

    #[Rule('required')]
    public $end_date;

    #[Rule('nullable')]
    public $price;

    #[Rule('nullable')]
    public $tags;


    public function setEvent(Event $event)
    {
        $this->title = $event->title;
        $this->body = $event->body;
        $this->place = $event->place;
        $this->start_date = $event->start_date;
        $this->end_date = $event->end_date;
        $this->price = $event->price;
    }
}

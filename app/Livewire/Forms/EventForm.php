<?php

namespace App\Livewire\Forms;

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

    #[Rule('required')]
    public $start_date;

    #[Rule('required')]
    public $end_date;

    #[Rule('nullable')]
    public $price;
}

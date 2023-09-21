<?php
use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public $events;

    public function mount($events)
    {
        $this->events = $events;
    }

    public function placeholder()
    {
        return view('components.skeleton-load');
    }
}; ?>

<div>

    @forelse($events as $event)
        <livewire:event.cart :event="$event" :key="$event->id" />
    @empty
        NUK KA EVENTE
    @endforelse


</div>

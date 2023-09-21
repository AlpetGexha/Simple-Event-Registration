<?php
use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $peoples;

    public function mount($peoples)
    {
        $this->peoples = $peoples;
    }

    public function updatedPeoples()
    {
        if ($this->peoples->first()->user?->name == auth()->user()->name) {
            $this->peoples->shift();
        } else {
            $this->peoples->prepend(auth()->user());
        }
    }
};
?>
<div>
    {{-- @dd($peoples) --}}
    @forelse ($peoples as $people)
        <span>
            {{ $people->user->name }} <br>
        </span>
    @empty
        NUK KA njerz per kete event
    @endforelse
</div>

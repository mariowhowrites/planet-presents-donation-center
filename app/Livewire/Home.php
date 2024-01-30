<?php

namespace App\Livewire;

use App\Models\Charity;
use Illuminate\Support\Collection;
use Livewire\Component;

class Home extends Component
{
    public Collection $charities;

    public function render()
    {
        return view('livewire.home');
    }

    public function mount()
    {
        $this->charities = Charity::all();
    }
}

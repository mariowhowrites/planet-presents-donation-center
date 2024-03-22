<?php

namespace App\Livewire;

use App\Models\Charity;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Home extends Component
{
    public Collection $charities;

    public string $search = '';

    #[Computed]
    public function filteredCharities()
    {
        return $this->charities->filter(fn ($charity) => str_contains(strtolower($charity->name), strtolower($this->search)));
    }

    public function render()
    {
        return view('livewire.home');
    }

    public function mount()
    {
        $this->charities = Charity::all();
    }
}

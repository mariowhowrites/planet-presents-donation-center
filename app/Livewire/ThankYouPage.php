<?php

namespace App\Livewire;

use App\Models\Charity;
use Livewire\Component;

class ThankYouPage extends Component
{
    public $charity;

    public function render()
    {
        return view('livewire.thank-you-page');
    }

    public function mount()
    {
        $this->charity = Charity::find(request()->input('charity'));

        $this->dispatch('pledge-created', ['url' => $this->charity->donation_url]);
    }
}

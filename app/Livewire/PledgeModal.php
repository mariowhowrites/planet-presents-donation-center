<?php

namespace App\Livewire;

use App\Models\Pledge;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class PledgeModal extends Component
{
    // props
    public $wishlist;
    public $charity;

    // state
    public $name;
    public $message;
    public $tier = 1;

    protected $rules = [
        'name' => 'required',
        'tier' => 'required',
    ];

    public function render()
    {
        return view('livewire.pledge-modal');
    }

    public function createPledge()
    {
        Log::info([
            'message' => $this->message,
            'tier' => $this->tier,
            'wishlist' => $this->wishlist,
        ]);

        $this->validate();

        Pledge::create([
            'message' => $this->message,
            'tier_id' => $this->tier,
            'wishlist_id' => $this->wishlist->id,
        ]);
        
        redirect($this->charity->donation_url);
    }
}
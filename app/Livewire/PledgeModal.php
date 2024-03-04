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
    public $tier_id;
    public $amount = 0;

    protected $rules = [
        'name' => 'required',
        'tier_id' => 'required',
    ];
    
    public function mount()
    {
        $this->tier_id = $this->wishlist->getSelectedTiersByCharity($this->charity->id)->first()->id;
    }

    public function render()
    {
        return view('livewire.pledge-modal');
    }

    public function createPledge()
    {
        $this->validate();

        $this->wishlist->createPledge([
            'name' => $this->name,
            'message' => $this->message,
            'tier_id' => $this->tier_id,
            'amount' => $this->shouldShowAmountInput() ? $this->amount : $this->tierAmount(),
        ]);
        
        redirect($this->charity->donation_url);
    }

    public function shouldShowAmountInput()
    {
        $selected_tier = $this->charity->tiers->firstWhere('id', $this->tier_id);

        return $selected_tier->amount === 0;
    }

    public function tierAmount()
    {
        return $this->charity->tiers->firstWhere('id', $this->tier_id)->amount;
    }

    public function selectTier($tier_id)
    {
        $this->tier_id = $tier_id;
    }
}
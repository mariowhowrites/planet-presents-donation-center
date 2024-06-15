<?php

namespace App\Livewire;

use App\Models\WishlistItem;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PledgeModal extends Component
{
    // props
    public $wishlist;
    public $charity;

    // state
    public $name;
    public $message;
    public $item_id;
    public $amount = 0;

    protected $rules = [
        'name' => 'required',
        'item_id' => 'required',
        'amount' => 'required|numeric|min:1',
    ];
    
    public function mount()
    {
        $defaultItem = $this->wishlist->getWishlistItemsByCharity($this->charity->id)->first();

        $this->item_id = $defaultItem->id;
        $this->amount = $defaultItem->tier->amount;
    }

    public function render()
    {
        return view('livewire.pledge-modal');
    }

    #[Computed]
    public function wishlistItem()
    {
        return WishlistItem::firstWhere('id', $this->item_id);
    }

    public function createPledge()
    {
        $this->validate();

        $this->wishlistItem->createPledge([
            'name' => $this->name,
            'message' => $this->message,
            'amount' => $this->shouldShowAmountInput() ? $this->amount : $this->tierAmount(),
        ]);
        

        redirect(route('thank-you', ['charity' => $this->charity->id]));
    }

    public function shouldShowAmountInput()
    {
        return $this->wishlistItem->tier->amount === 0;
    }

    public function tierAmount()
    {
        return $this->wishlistItem->tier->amount;
    }

    public function selectTier($item_id)
    {
        $this->item_id = $item_id;
    }
}
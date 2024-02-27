<?php

namespace App\Livewire;

use App\Models\Charity;
use App\Models\Tier;
use App\Models\Wishlist;
use Livewire\Component;
use Livewire\Attributes\On;

class CharityView extends Component
{
    public Charity $charity;
    public Wishlist $currentWishlist;

    #[On('wishlist-updated')]
    public function wishlistUpdated()
    {
        $this->currentWishlist->refresh();
    }

    public function mount($id)
    {
        $this->charity = Charity::findOrFail($id);

        $this->currentWishlist = Wishlist::current();
    }

    public function render()
    {
        return view('livewire.charity-view');
    }

    public function addToWishlist(Tier $tier)
    {
        $this->currentWishlist->wishlistItems()->firstOrCreate([
            'tier_id' => $tier->id,
        ]);

        $this->dispatch('wishlist-updated', $tier->id);
    }

    public function removeFromWishlist(Tier $tier)
    {
        $this->currentWishlist->wishlistItems()->where('tier_id', $tier->id)->delete();

        $this->dispatch('wishlist-updated', $tier->id);
    }

    public function toggleFromWishlist(Tier $tier)
    {
        $this->currentWishlist->hasTier($tier)
            ? $this->removeFromWishlist($tier)
            : $this->addToWishlist($tier);
    }

    public function wishlistButtonText($tier)
    {
        return $this->currentWishlist->hasTier($tier) ? 'Remove from Wishlist' : 'Add to Wishlist';
    }

    public function tierButtonClasses($tier)
    {
        return [
            'relative block cursor-pointer rounded-lg bg-white border border-gray-300 p-4 focus:outline-none',
            'ring-2 ring-indigo-500' => $this->currentWishlist->hasTier($tier),
        ];
    }
}

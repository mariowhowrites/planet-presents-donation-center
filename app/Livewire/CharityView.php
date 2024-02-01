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
        $user = auth()->user();

        $wishlist = Wishlist::firstorCreate([
            'user_id' => $user->id,
        ]);

        $wishlist->wishlistItems()->where('tier_id', $tier->id)->delete();

        $this->dispatch('wishlist-updated', $tier->id);
    }
}

<?php

namespace App\Livewire;

use App\Enums\WishlistStatus;
use App\Models\Wishlist;
use Livewire\Component;
use Livewire\Attributes\On;

class WishlistView extends Component
{
    public Wishlist $wishlist;

    public function mount()
    {
        $wishlist = Wishlist::current();

        $this->wishlist = $wishlist;
    }
    #[On('wishlist-updated.{wishlist.id}')]
    public function refreshWishlist()
    {
        $this->wishlist->refresh();
    }

    public function render()
    {
        return view('livewire.wishlist-view');
    }

    public function publishWishlist()
    {
        $this->wishlist->status = WishlistStatus::Published;

        $this->wishlist->save();

        $this->dispatch('wishlist-updated', $this->wishlist->id);
    }

    public function unpublishWishlist()
    {
        $this->wishlist->status = WishlistStatus::Private;

        $this->wishlist->save();

        $this->dispatch('wishlist-updated', $this->wishlist->id);
    }
}

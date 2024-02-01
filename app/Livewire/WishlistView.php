<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistView extends Component
{
    public Wishlist $wishlist;

    public function mount()
    {
        $wishlist = Wishlist::current();

        $this->wishlist = $wishlist;
    }

    public function render()
    {
        return view('livewire.wishlist-view');
    }
}

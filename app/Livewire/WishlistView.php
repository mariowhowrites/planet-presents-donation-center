<?php

namespace App\Livewire;

use App\Enums\WishlistStatus;
use App\Models\Wishlist;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;

class WishlistView extends Component
{
    use AuthorizesRequests;

    public Wishlist $wishlist;

    public function mount($id = null)
    {
        $wishlist = $id ? Wishlist::find($id) : Wishlist::current();

        // if we've received an ID from the router, we're trying to visit a published wishlist.
        // if the wishlist is not published, we should redirect to the home page.
        if ($id && $wishlist->status !== WishlistStatus::Public) {
            return redirect()->to(route('home'));
        }

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
        $this->wishlist->status = WishlistStatus::Public;

        $this->wishlist->save();

        $this->dispatch('wishlist-updated', $this->wishlist->id);
    }

    public function unpublishWishlist()
    {
        $this->wishlist->status = WishlistStatus::Private;

        $this->wishlist->save();

        $this->dispatch('wishlist-updated', $this->wishlist->id);
    }

    public function canEditWishlist()
    {
        $is_user_wishlist = auth()->check() && auth()->user()->id == $this->wishlist->user_id;
        $is_session_wishlist = $this->wishlist->session_id == session()->getId();

        return $is_user_wishlist || $is_session_wishlist;
    }

    public function beginPledge()
    {
        $this->dispatch('open-modal', 'pledge-modal');
    }
}
<?php

namespace App\Livewire;

use App\Models\Wishlist;
use Illuminate\Auth\Access\AuthorizationException;
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
        // expect admins. admins can see
        if ($id) {
            try {
                $this->authorize('view', $wishlist);
            } catch (AuthorizationException $e) {
                Log::info('User is not authorized to view wishlist');
                return redirect()->to(route('home'));
            }
        }

        $this->wishlist = $wishlist;
    }

    public function render()
    {
        return view('livewire.wishlist-view');
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

    public function showCopyLinkToast()
    {
        $this->dispatch('show-toast', 'Link copied to clipboard!', type: 'success');
    }
}
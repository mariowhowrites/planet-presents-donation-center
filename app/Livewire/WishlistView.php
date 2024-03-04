<?php

namespace App\Livewire;

use App\Enums\WishlistStatus;
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

    public bool $isEditingName = false;
    public bool $isEditingDescription = false; 
    public string $newName = '';
    public string $newDescription = '';


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
        $this->newName = $wishlist->name;
        $this->newDescription = $wishlist->description;
    }

    public function render()
    {
        return view('livewire.wishlist-view');
    }

    public function publishWishlist()
    {
        $this->wishlist->status = WishlistStatus::Public;

        $this->wishlist->save();

        $this->wishlist->refresh();
    }

    public function unpublishWishlist()
    {
        $this->wishlist->status = WishlistStatus::Private;

        $this->wishlist->save();

        $this->wishlist->refresh();
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

    public function toggleEditingName()
    {
        $this->isEditingName = !$this->isEditingName;
    }

    public function startEditingDescription()
    {
        $this->isEditingDescription = true;
    }

    public function startEditingName()
    {
        $this->isEditingName = true;
    }

    public function stopEditingName()
    {
        $validated = $this->validate([
            'newName' => 'required|string|max:255',
        ]);

        if ($validated) {
            $this->wishlist->update([
                'name' => $validated['newName'],
            ]);

            $this->wishlist->refresh();
        }

        $this->isEditingName = false;
    }

    public function stopEditingDescription()
    {
        $validated = $this->validate([
            'newDescription' => 'required|string',
        ]);

        if ($validated) {
            $this->wishlist->update([
                'description' => $validated['newDescription'],
            ]);
            
            $this->wishlist->refresh();
        }

        $this->isEditingDescription = false;
    }
}
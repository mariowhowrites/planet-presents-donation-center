<?php 

namespace App\Livewire;

use App\Models\Wishlist;
use Livewire\Component;

class WishlistEdit extends Component
{
    public Wishlist $wishlist;

    public bool $isEditingName = false;
    public bool $isEditingDescription = false;
    public string $newName = '';
    public string $newDescription = '';

    public string $currentView = 'Analytics';

    public function mount($id = null)
    {
        $wishlist = $id ? Wishlist::find($id) : Wishlist::current();

        $this->wishlist = $wishlist;
        $this->newName = $wishlist->name;
        $this->newDescription = $wishlist->description;
    }

    public function render()
    {
        return view('livewire.wishlist-edit');
    }

    public function changeView($view)
    {
        $this->currentView = $view;
    }

    public function toggleWishlistPublished()
    {
        $this->wishlist->isPublic() ? $this->unpublishWishlist() : $this->publishWishlist();
    }

    public function publishWishlist()
    {
        $this->wishlist->publish();

        $this->wishlist->refresh();

        $this->showPublishToast();
    }

    public function unpublishWishlist()
    {
        $this->wishlist->unpublish();

        $this->wishlist->refresh();

        $this->showPublishToast();
    }

    public function showPublishToast()
    {
        $this->dispatch('show-toast', $this->wishlist->isPublic() ? 'Wishlist published!' : 'Wishlist unpublished!', type: $this->wishlist->isPublic() ? 'success' : 'warning');
    }

    public function publishButtonText()
    {
        return $this->wishlist->isPublic() ? 'Unpublish' : 'Publish';
    }
}

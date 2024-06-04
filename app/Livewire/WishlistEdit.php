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

    public function publishWishlist()
    {
        $this->wishlist->publish();

        $this->wishlist->refresh();
    }

    public function unpublishWishlist()
    {
        $this->wishlist->unpublish();

        $this->wishlist->refresh();
    }

    public function publishButtonText()
    {
        return $this->wishlist->isPublic() ? 'Unpublish' : 'Publish';
    }
}

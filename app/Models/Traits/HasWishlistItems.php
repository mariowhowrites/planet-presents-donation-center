<?php

namespace App\Models\Traits;

use App\Models\WishlistItem;

trait HasWishlistItems
{
    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function itemCount()
    {
        return $this->wishlistItems->count();
    }
}
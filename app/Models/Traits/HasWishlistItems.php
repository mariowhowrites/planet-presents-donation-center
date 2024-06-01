<?php

namespace App\Models\Traits;

use App\Models\WishlistItem;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasWishlistItems
{
    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function itemCount(): Attribute
    {
        return Attribute::make(
            get: fn (null $value) => $this->wishlistItems->count()
        );
    }
}
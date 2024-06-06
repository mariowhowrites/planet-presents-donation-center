<?php

namespace App\Models\Traits;

use App\Models\Tier;
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

    public function hasTier(Tier $tier)
    {
        return $this->wishlistItems->contains('tier_id', $tier->id);
    }

    public function getSelectedCharities()
    {
        return $this->wishlistItems->map(function ($item) {
            return $item->tier->charity;
        })->unique();
    }

    public function getWishlistItemsByCharity($charity_id)
    {
        return $this->wishlistItems->filter(function ($item) use ($charity_id) {
            return $item->tier->charity_id == $charity_id;
        });
    }

    public function getSelectedTiersByCharity($charity_id)
    {
        return $this->getWishlistItemsByCharity($charity_id)->map(function ($item) {
            return $item->tier;
        });
    }

    public function itemIDs()
    {
        return $this->wishlistItems->pluck('id');
    }
}
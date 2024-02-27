<?php

namespace App\Models;

use App\Enums\WishlistStatus;
use App\Models\Traits\HasPledges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Wishlist extends Model
{
    use HasFactory, HasPledges;

    protected $casts = [
        'status' => WishlistStatus::class
    ];

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasTier(Tier $tier)
    {
        return $this->wishlistItems->contains('tier_id', $tier->id);
    }

    public static function current()
    {
        if (auth()->check()) {
            return auth()->user()->wishlist->first();
        }

        return Wishlist::firstOrCreateFromSession();
    }

    public static function firstOrCreateFromSession()
    {
        return Wishlist::firstOrCreate(
            ['session_id' => session()->getId()],
            ['description' => 'Welcome to my wishlist! Read about some of my selected charities below, and please consider pledging your support. Thank you!']
        );
    }

    public static function getFromSession()
    {
        return Wishlist::first(
            'session_id',
            session()->getId(),
        );
    }

    public function getSelectedCharities()
    {
        return $this->wishlistItems->map(function ($item) {
            return $item->tier->charity;
        })->unique();
    }

    public function getSelectedTiersByCharity($charity_id)
    {
        return $this->wishlistItems->filter(function ($item) use ($charity_id) {
            return $item->tier->charity_id == $charity_id;
        })->map(function ($item) {
            return $item->tier;
        });
    }
}

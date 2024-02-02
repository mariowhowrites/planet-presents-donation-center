<?php

namespace App\Models;

use App\Enums\WishlistStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Wishlist extends Model
{
    use HasFactory;

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

        return Wishlist::firstOrCreate([
            'session_id' => session()->getId(),
        ]);
    }

    public static function getFromSession()
    {
        return Wishlist::first(
            'session_id',
            session()->getId(),
        );
    }
}

<?php

namespace App\Models;

use App\Enums\WishlistStatus;
use App\Models\Traits\HasWishlistItems;
use App\Models\Traits\HasWishlistStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory, HasWishlistItems, HasWishlistStatus;

    protected $casts = [
        'status' => WishlistStatus::class
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function current()
    {
        if (auth()->check()) {
            return auth()->user()->currentWishlist() ?? Wishlist::firstOrCreateFromSession(auth()->id());
        }

        return Wishlist::firstOrCreateFromSession();
    }

    public static function firstOrCreateFromSession($user_id = null)
    {
        $wishlist = Wishlist::firstOrNew(
            ['session_id' => session()->getId()],
            ['description' => 'Welcome to my wishlist! Read about some of my selected charities below, and please consider pledging your support. Thank you!']
        );

        if ($user_id) {
            $wishlist->user_id = $user_id;
        }

        $wishlist->save();

        return $wishlist;
    }

    public static function getFromSession()
    {
        return Wishlist::first(
            'session_id',
            session()->getId(),
        );
    }
}

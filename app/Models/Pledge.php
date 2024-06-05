<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    use HasFactory;

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }

    public static function countByWishlist(Wishlist $wishlist)
    {
        return self::where('wishlist_id', $wishlist->id)->count();
    }

    public static function countByWishlistThisWeek(Wishlist $wishlist)
    {
        return self::where('wishlist_id', $wishlist->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    }

    public static function totalPledgedByWishlist(Wishlist $wishlist)
    {
        return self::where('wishlist_id', $wishlist->id)->sum('amount');
    }

    public static function mostRecentByWishlist(Wishlist $wishlist)
    {
        return self::where('wishlist_id', $wishlist->id)->latest()->first();
    }
}

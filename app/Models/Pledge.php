<?php

namespace App\Models;

use App\Events\PledgeCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pledge extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => PledgeCreated::class,
    ];

    public function wishlistItem()
    {
        return $this->belongsTo(WishlistItem::class);
    }

    public static function byWishlist(Wishlist $wishlist)
    {
        return self::whereIn('wishlist_item_id', $wishlist->itemIDs());
    }

    public static function countByWishlist(Wishlist $wishlist)
    {
        return self::whereIn('wishlist_item_id', $wishlist->itemIDs())->count();
    }

    public static function countByWishlistThisWeek(Wishlist $wishlist)
    {
        return self::whereIn('wishlist_item_id', $wishlist->itemIDs())
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
    }

    public static function totalPledgedByWishlist(Wishlist $wishlist)
    {
        return self::whereIn('wishlist_item_id', $wishlist->itemIds())->sum('amount');
    }

    public static function mostRecentByWishlist(Wishlist $wishlist)
    {
        return self::whereIn('wishlist_item_id', $wishlist->itemIDs())->latest()->first();
    }
}

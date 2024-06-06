<?php

namespace App\Models;

use App\Models\Traits\HasPledges;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    use HasFactory, HasPledges;

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }

    public function pledges()
    {
        return $this->hasMany(Pledge::class);
    }

    public function totalAmountPledged()
    {
        return;
    }
}

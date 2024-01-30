<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    use HasFactory;

    public function wishlistItems()
    {
        return $this->hasMany(WishlistItem::class);
    }

    public function charity()
    {
        return $this->belongsTo(Charity::class);
    }
}

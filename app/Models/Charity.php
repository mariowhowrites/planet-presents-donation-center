<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charity extends Model
{
    use HasFactory;

    public function tiers()
    {
        return $this->hasMany(Tier::class);
    }

    public function previewImageURL()
    {
        return asset('storage/' . $this->preview_image);
    }
}

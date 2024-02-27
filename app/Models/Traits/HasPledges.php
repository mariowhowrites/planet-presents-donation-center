<?php

namespace App\Models\Traits;

use App\Models\Pledge;
use App\Models\Tier;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPledges
{
    public function pledges()
    {
        return $this->hasMany(Pledge::class);
    }
    
    public function createPledge($attributes)
    {
        return $this->pledges()->create([
            'name' => $attributes['name'],
            'message' => $attributes['message'],
            'tier_id' => $attributes['tier_id'],
            'amount' => $this->getPledgeAmount($attributes['amount'], $attributes['tier_id']),
        ]);
    }

    // this should either be amount value if provided. otherwise, default to tier amount
    protected function getPledgeAmount($amount, $tier_id)
    {
        return $amount > 0 ? $amount : Tier::find($tier_id)->amount;
    }
}
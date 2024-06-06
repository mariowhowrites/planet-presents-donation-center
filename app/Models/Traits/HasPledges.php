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
            'amount' => $this->getPledgeAmount($attributes['amount']),
        ]);
    }

    // this should either be amount value if provided. otherwise, default to tier amount
    protected function getPledgeAmount($amount)
    {
        return $amount > 0 ? $amount : $this->tier->amount;
    }
}
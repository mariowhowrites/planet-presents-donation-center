<?php

namespace App\Models\Traits;

use App\Enums\WishlistStatus;

trait HasWishlistStatus
{
    // Status fns
    public function isPublic()
    {
        return $this->status == WishlistStatus::Public;
    }

    public function isPrivate()
    {
        return $this->status == WishlistStatus::Private;
    }

    public function publish()
    {
        $this->status = WishlistStatus::Public;

        $this->save();
    }

    public function unpublish()
    {
        $this->status = WishlistStatus::Private;

        $this->save();
    }
}
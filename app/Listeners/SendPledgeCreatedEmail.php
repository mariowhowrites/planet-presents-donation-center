<?php

namespace App\Listeners;

use App\Events\PledgeCreated;
use App\Notifications\PledgeCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPledgeCreatedEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PledgeCreated $event): void
    {
        $pledge = $event->pledge;

        if ($pledge->wishlistItem->wishlist->user) {
            $pledge->wishlistItem->wishlist->user->notify(new PledgeCreatedNotification($pledge));
        }
    }
}

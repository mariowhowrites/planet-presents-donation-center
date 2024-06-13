<?php

namespace Tests\Feature;

use App\Events\PledgeCreated;
use App\Listeners\SendPledgeCreatedEmail;
use App\Models\Charity;
use App\Models\Wishlist;
use App\Notifications\PledgeCreatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PledgeTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_that_creating_pledges_sends_email_notifications()
    {
        Notification::fake();

        $wishlist = Wishlist::factory()->withUser()->create();

        $charity = Charity::factory()->create();

        $wishlistItem = $wishlist->wishlistItems()->create([
            'tier_id' => $charity->tiers->first()->id,
        ]);

        $wishlistItem->createPledge([
            'name' => $this->faker->name(),
            'message' => $this->faker->sentence(),
            'amount' => $wishlistItem->tier->amount,
        ]);

        Notification::assertSentTo([$wishlist->user], PledgeCreatedNotification::class);
    }
}

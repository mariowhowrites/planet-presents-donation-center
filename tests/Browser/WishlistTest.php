<?php

namespace Tests\Browser;

use App\Models\Charity;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Traits\HasAuth;
use Tests\DuskTestCase;

class WishlistTest extends DuskTestCase
{
    use HasAuth;
    /**
     * A Dusk test example.
     */
    public function test_that_clicking_on_a_wishlist_item_adds_it_to_your_wishlist()
    {
        $charity = Charity::where('name', 'Marine Mammal Care Center')
            ->limit('1')
            ->get()
            ->first();

        $this->browse(function (Browser $browser) use ($charity) {
            $browser->visit(route('charity.show', ['id' => $charity->id]))
                ->assertSee($charity->name)
                ->assertSee($charity->description)
                ->click('#tier-button-9')
                ->waitForTextIn('#wishlist-item-count-badge', '1')
                ->assertSeeIn('#wishlist-item-count-badge', '1');
        });
    }
    // public function test_auth()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $user = User::factory()->create();
    //         $this->login($browser, $user);
    //     });
    // }
}

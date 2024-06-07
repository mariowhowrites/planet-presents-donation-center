<?php

namespace Tests\Browser\Traits;

use Laravel\Dusk\Browser;

trait HasAuth
{
    public function login(Browser $browser, $user)
    {
        $browser->visit(route('login'))->assertSee('Login')
            ->assertSee('Email')
            ->assertSee('Password')
            ->type('email', $user->email)
            ->type('password', 'password')
            ->press('#login-button')
            ->assertPathIs('/my-wishlist');
    }
}
<?php

namespace App\Providers;

use App\Events\PledgeCreated;
use App\Listeners\SendPledgeCreatedEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();

        Event::listen(PledgeCreated::class, SendPledgeCreatedEmail::class);
    }
}

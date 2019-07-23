<?php

namespace App\Providers;

use Idea\Listeners\LoggedIn;
use Illuminate\Auth\Events\Login;
use Idea\Listeners\LogVerifiedUser;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Login::class => [
            LoggedIn::class,
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Verified::class => [
            LogVerifiedUser::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}

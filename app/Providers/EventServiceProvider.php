<?php

namespace App\Providers;

use App\Events\OfferCreated;
use App\Events\PurchaseOrderCreated;
use App\Listeners\ProcessOfferCreated;
use App\Listeners\ProcessPurchaseOrderCreated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OfferCreated::class => [
            ProcessOfferCreated::class,
        ],
        PurchaseOrderCreated::class => [
            ProcessPurchaseOrderCreated::class,
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

        //
    }
}

<?php

namespace App\Providers;

use App\Events\OfferCreated;
use App\Events\OfferUpdateCreated;
use App\Events\OfferUpdated;
use App\Events\PurchaseOrderCreated;
use App\Events\RevisionCreated;
use App\Listeners\ProcessOfferCreated;
use App\Listeners\ProcessOfferUpdated;
use App\Listeners\ProcessPurchaseOrderCreated;
use App\Listeners\ProcessRevisionCreated;
use App\Listeners\ProcessUpdateOfferCreated;
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
        OfferUpdated::class => [
            ProcessOfferUpdated::class,
        ],
        RevisionCreated::class => [
            ProcessRevisionCreated::class,
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

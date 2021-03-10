<?php

namespace App\Listeners;

use App\Events\OfferUpdated;
use App\Jobs\SendUpdateOfferNotification;


class ProcessOfferUpdated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(OfferUpdated $event)
    {
        SendUpdateOfferNotification::dispatch($event->offer);
    }
}

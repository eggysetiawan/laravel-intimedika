<?php

namespace App\Listeners;

use App\Events\RevisionCreated;
use App\Jobs\SendRevisionOfferNotification;
use App\Offer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessRevisionCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(RevisionCreated $event)
    {
        SendRevisionOfferNotification::dispatch($event->offer);
    }
}

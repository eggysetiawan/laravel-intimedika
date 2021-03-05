<?php

namespace App\Listeners;

use App\Events\PurchaseOrderCreated;
use App\Jobs\SendPurchaseOrderNotification;


class ProcessPurchaseOrderCreated
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
    public function handle(PurchaseOrderCreated $event)
    {
        SendPurchaseOrderNotification::dispatch($event->offer);
    }
}

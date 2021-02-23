<?php

namespace App\Observers;

use App\Notifications\Offer\NewOfferNotification as OfferNewOfferNotification;

use App\User;
use App\Offer;

class OfferObserver
{
    /**
     * Handle the offer "created" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function created(Offer $offer)
    {
        $admin = User::where('id', 13)->first();
        $admin->notify(new OfferNewOfferNotification($offer));
    }

    /**
     * Handle the offer "updated" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function updated(Offer $offer)
    {
        //
    }

    /**
     * Handle the offer "deleted" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function deleted(Offer $offer)
    {
        //
    }

    /**
     * Handle the offer "restored" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function restored(Offer $offer)
    {
        //
    }

    /**
     * Handle the offer "force deleted" event.
     *
     * @param  \App\Offer  $offer
     * @return void
     */
    public function forceDeleted(Offer $offer)
    {
        //
    }
}

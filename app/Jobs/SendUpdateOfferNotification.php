<?php

namespace App\Jobs;

use App\Notifications\Offer\UpdateOfferNotification as OfferUpdateOfferNotification;
use App\Offer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendUpdateOfferNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $offer;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin = User::emailToDirector();
        $admin->notify(new OfferUpdateOfferNotification($this->offer));
    }
}

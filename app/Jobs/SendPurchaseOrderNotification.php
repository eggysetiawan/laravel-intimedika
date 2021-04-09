<?php

namespace App\Jobs;

use App\Notifications\Progress\PurchaseOrderNotification;
use App\Offer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendPurchaseOrderNotification implements ShouldQueue
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
        $admin->notify(new PurchaseOrderNotification($this->offer));
    }
}

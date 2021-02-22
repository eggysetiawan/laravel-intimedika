<?php

namespace App\Mail\Offer;

use App\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateOfferEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('portal@intimedika.co')
            ->subject('Penawaran telah dibuat!')
            ->view('offers.email.create')
            ->with([
                'offer' => $this->offer,
            ]);
    }
}

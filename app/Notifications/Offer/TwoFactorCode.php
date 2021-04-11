<?php

namespace App\Notifications\Offer;

use App\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TwoFactorCode extends Notification implements ShouldQueue
{
    use Queueable;
    public $offer, $otp;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Offer $offer, $otp)
    {
        $this->offer = $offer;
        $this->otp = $otp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $slug = $this->offer->slug;
        $otp = $this->otp;
        // $otp = $this->offer->otp;
        return (new MailMessage)
            ->line('Your two factor code is ' . $otp)
            ->line('The code will expire in 10 minutes')
            ->line('If you have not tried to make descision, ignore this message.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications\Offer;

use App\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RevisionOfferNotification extends Notification
{
    use Queueable;
    public $offer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
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
        if ($this->offer->revision->is_called == 1) :
            $called = 'Anda diminta untuk menemui Direktur untuk melakukan diskusi lebih lanjut';
        else :
            $called = '';
        endif;
        if (strlen($this->offer->revision->reason) > 1) :
            $reason = 'Pesan Direktur : "' . $this->offer->revision->reason . '"';
        else :
            $reason = '';
        endif;

        return (new MailMessage)
            ->from('portal@intimedika.co', 'IPI Portal')
            ->greeting('Direktur meminta penawaran di revisi!')
            ->line($reason)
            ->line($called)
            ->subject('Revisi Penawaran!')
            ->action('Revisi Penawaran', route('invoices.order', $this->offer->slug))
            ->line('Terimakasih sudah menggunakan aplikasi kami!');
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

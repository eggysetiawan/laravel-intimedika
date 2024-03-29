<?php

namespace App\Notifications\Offer;

use App\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateOfferNotification extends Notification
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
        return (new MailMessage)
            ->from('portal@intimedika.co', 'IPI Portal')
            ->greeting($this->offer->author->name . ' telah memperbarui No. Penawaran ' . $this->offer->offer_no . ' !')
            ->line('Segera berikan tanggapan berupa persetujuan/pembatalan untuk Penawaran yang di perbarui!')
            ->subject('No. Penawaran ' . $this->offer->offer_no . ' telah di perbarui!')
            ->action('Lihat Penawaran', route('invoices.order', $this->offer->slug))
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

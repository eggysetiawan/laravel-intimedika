<?php

namespace App\Notifications\Progress;

use App\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseOrderNotification extends Notification implements ShouldQueue
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
        $customer_name = @$this->offer->customer->hospitals->first()->name ?  $this->offer->customer->hospitals->first()->name : $this->offer->customer->name;
        return (new MailMessage)
            ->from('portal@intimedika.co', 'IPI Portal')
            ->greeting('Purchase Order telah dibuat oleh ' . $customer_name)
            ->line('Segera berikan tanggapan berupa persetujuan/pembatalan untuk Purchase Order yang dibuat!')
            ->subject('Pengajuan Purchase Order!')
            ->action('Lihat detail order', route('invoices.toOrder', $this->offer->slug))
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

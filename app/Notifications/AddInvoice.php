<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class AddInvoice extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $invoiceData;
    public function __construct($invoice)
    {
        $this->invoiceData = $invoice;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = 'http://127.0.0.1:8000/invoices/details/'.$this->invoiceData->id;
        return (new MailMessage)
                    ->subject('لقد اضفت فاتورة جديدة...')
                    ->line('يمكنك رؤيتها من خلال الضغط علي هذا الرابط')
                    ->action('عرض الفاتورة', $url)
                    ->line('شكرا لاستخدامك موقعنا');
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
            'invoice_id' => $this->invoiceData->id,
            'user' => Auth::user()->name,
            'title' => 'تم اضافة فاتورة جديدة بواسطة ' ,

        ];
    }
}

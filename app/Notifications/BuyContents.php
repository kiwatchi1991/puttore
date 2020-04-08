<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class BuyContents extends Notification
{
    use Queueable;

    protected $title = 'ぷっとれ:商品を購入しました。';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $order = Order::join('products', 'orders.product_id', 'products.id')
            ->join('users', 'products.user_id', 'users.id')
            ->where('orders.id', $notifiable->o_id)
            ->select('products.id', 'products.name', 'products.detail', 'users.account_name', 'orders.sale_price', 'orders.created_at',)
            ->first();

        //購入者の名前
        $user_name = $notifiable->account_name;

        return (new MailMessage)
            ->subject($this->title)
            ->action('Notification Action', url('/'))
            ->view(
                'emails.buyEmail',
                [
                    'user_name' => $user_name,
                    'order' => $order,
                ]
            );
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

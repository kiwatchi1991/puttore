<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class ChangeEmail extends Notification
{
    use Queueable;
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        Log::debug('<<  この処理 3  >>>>');

        return (new MailMessage)
            ->subject('メールアドレス変更') // 件名
            ->view('emails.changeEmail') // メールテンプレートの指定
            ->action(
                'メールアドレス変更',
                url('reset', $this->token) //アクセスするURL
            );
        Log::debug('<<  この処理 4  >>>>');
    }

    public function toArray($notifiable)
    {
        Log::debug('<<  この処理 5   >>>>');

        return [
            //
        ];
    }
}

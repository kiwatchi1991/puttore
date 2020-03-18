<?php

namespace App;

use App\Notifications\ChangeEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\Notifiable;

class EmailReset extends Model
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'new_email',
        'token',
    ];
    /**
     * メールアドレス確定メールを送信
     *
     * @param [type] $token
     * 
     */
    public function sendEmailResetNotification($token)
    {
        // use \Illuminate\Notifications\Notifiable;
        Log::debug('<<  この処理 1  >>>>');
        Log::debug('$this');
        Log::debug($this);
        Notification::send($this, new ChangeEmail($token));
        Log::debug('<<  この処理 2  >>>>');
    }

    /**
     * 新しいメールアドレスあてにメールを送信する
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->new_email;
    }
}

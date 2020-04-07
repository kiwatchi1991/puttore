<?php

namespace App;

use App\Notifications\BuyContents;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Notifiable;



    protected $dates = [
        'created_at',
        'msg_updated_at',
        'deleted_at'
    ];

    // 1対多のリレーションを作る
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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

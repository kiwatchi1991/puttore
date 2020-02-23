<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bord extends Model
{
    // 1対多のリレーションを作る
    public function messages()
    {
        return $this->hasMany('App\Lesson');
    }
}

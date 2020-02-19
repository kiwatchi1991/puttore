<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Difficulty extends Model
{
    //多対多のリレーションを作る
    protected $table = 'difficulties';

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}

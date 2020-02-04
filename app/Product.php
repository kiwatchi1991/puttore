<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'detail', 'lesson', 'default_price'];
    
    //多対多のリレーションを作る
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function difficulties()
    {
        return $this->belongsToMany('App\Difficulty');
    }
}


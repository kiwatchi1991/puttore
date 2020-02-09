<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name', 'detail', 'lesson', 'default_price'];

    //多対多のリレーションを作る
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
<<<<<<< HEAD
    protected $fillable = ['name', 'detail', 'lesson'];
=======
    protected $fillable = ['name', 'detail', 'lesson', 'default_price'];
>>>>>>> refs/heads/feature/ユーザー登録設定各種
    
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


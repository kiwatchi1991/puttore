<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'detail', 'lesson', 'default_price', 'pic1' ];
    
    //多対多のリレーションを作る
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function difficulties()
    {
        return $this->belongsToMany('App\Difficulty');
    }

    // 検索機能
    public function scopeTagFilter($query, ?string $tag)
    {
        if (!is_null($tag)) {
                return $query->where('categorie ', $tag);
            }
        return $query;
    }
}


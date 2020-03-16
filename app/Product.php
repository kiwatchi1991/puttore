<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    protected $fillable = ['name', 'detail', 'default_price', 'pic1', 'pic2', 'pic3', 'pic4', 'pic5', 'skills'];


    /**
     * 削除済みユーザー以外を表示する
     */
    use SoftDeletes;

    protected $table = 'products';
    protected $dates = ['deleted_at'];

    //多対多のリレーションを作る
    //カテゴリー
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    //難易度
    public function difficulties()
    {
        return $this->belongsToMany('App\Difficulty');
    }

    // 1対多のリレーションを作る
    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }



    // 検索機能
    // public function scopeTagFilter($query, ?string $tag)
    // {
    //     if (!is_null($tag)) {
    //             return $query->where('categorie ', $tag);
    //         }
    //     return $query;
    // }
}

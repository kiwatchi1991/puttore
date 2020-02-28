<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
  protected $table = 'discount_price';

  protected $fillable = ['sale_price', 'sale_price_from', 'sale_price_to'];

  public function products()
  {
      return $this->hasMany('App\Product');
  }
}

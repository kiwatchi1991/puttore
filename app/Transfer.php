<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $casts = [
        'paid_date' => 'date'
    ];
    // protected $dates = [
    //     'paid_date',
    // ];
}

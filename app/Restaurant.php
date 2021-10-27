<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurant extends Model
{
    protected $table = 'restaurant';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'restaurant_name',
        'restaurant_code',
        'restaurant_desc',
        'restaurant_number',
        'email',
    ];
    
}

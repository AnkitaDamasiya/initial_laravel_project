<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RestaurantImage extends Model
{
    protected $table = 'restaurant_image';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'restaurant_id',
        'image ',
    ];

    public function image()
    {
        return $this->hasOne(Restaurant::class);
    }
}

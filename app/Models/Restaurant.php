<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    //
    protected $fillable = [
        'name',
        'direction',
        'number',
        'whatsappNumber',
        'image',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'tiktok'
    ];

    public function schedules(){
        return $this->hasMany('App\Models\Schedule');
    }

    public function mesas(){
        return $this->hasMay('App\Models\Mesa');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category','restaurant_category')
        ->withPivot('category_id','active');
    }

    public function dishes(){
        return $this->belongsToMany(\App\Models\Dish::class)
            ->withPivot('active');
    }
}

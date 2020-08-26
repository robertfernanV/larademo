<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'image',
        'active'
    ];

    public function restaurants(){
        return $this->belongsToMany('App\Models\Restaurant','restaurant_category')
        ->withPivot('restaurant_id','active');
    }
}

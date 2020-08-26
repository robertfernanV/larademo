<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    //
    protected $fillable =  [
        'name',
        'capacity',
        'active',
        'busy',
        'restaurant_id'
    ];

    public function restaurants(){
        return $this->belongsTo('App\Models\Restaurant');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    //
    protected $fillable =[
        'dayFrom',
        'dayUntil',
        'timeFrom',
        'timeUntil',
        'restaurant_id'
    ];

    public function restaurants(){
        return $this->belongsTo('App\Models\Restaurant');
    }
}

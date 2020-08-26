<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    //

    public function restaurants(){
        return $this->belongsToMany(\App\Models\Restaurant::class)
            ->withPivot('active');
    }

    public function ingredients(){
        return $this->belongsToMany(\App\Models\Ingredient::class,'dish_ingredient_unit','dish_id','ingredient_id')
            ->withPivot('quantity');
    }

    public function units(){
        return $this->belongsToMany(\App\Models\Unit::class,'dish_ingredient_unit','dish_id','unit_id')
            ->withPivot('quantity');
    }
}

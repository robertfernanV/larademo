<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //
    protected  $fillable =['name'];

    public function dishes(){
        return $this->belongsToMany(\App\Models\Dish::class,'dish_ingredient_unit','ingredient_id','dish_id')
        ->withPivot('quantity');
    }

    public function units(){
        return $this->belongsToMany(\App\Models\Unit::class,'dish_ingredient_unit','ingredient_id','unit_id')
            ->withPivot('quantity');
    }
}

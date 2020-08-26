<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected  $fillable =['name','abbreviation'];
    
    public function dishes(){
        return $this->belongsToMany(\App\Models\Dish::class,'dish_ingredient_unit','unit_id','dish_id')
        ->withPivot('quantity');
    }

    public function ingredients(){
        return $this->belongsToMany(\App\Models\Ingredient::class,'dish_ingredient_unit','unit_id','ingredient_id')
            ->withPivot('quantity');
    }
}

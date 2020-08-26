<?php

use Illuminate\Database\Seeder;

class DishIngredientUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('dish_ingredient_unit')->insert([
            'id'=>1,
            'quantity'=>'100',
            'dish_id'=>1,
            'ingredient_id' =>1,
            'unit_id'=>1
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class DishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('dishes')->insert([
            'id'=>1,
            'name'=>'Quesillo',
            'description'=>'Quesillo Venezolano con la mejor azucar',
            'portions' =>'1'
        ]);

        DB::table('dish_restaurant')->insert([
            'id'=>1,
            'dish_id'=>1,
            'restaurant_id'=>1,
            'active'=>1
        ]);
    }
}

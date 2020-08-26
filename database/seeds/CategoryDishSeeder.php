<?php

use Illuminate\Database\Seeder;

class CategoryDishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('category_dish')->insert([
            'id'=>1,
            'category_id'=>1,
            'dish_id'=>1
        ]);
    }
}

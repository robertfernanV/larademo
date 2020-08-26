<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'name'=>'Dulces',
            'description'=>'Los mejores dulces'
        ]);

        DB::table('restaurant_category')->insert([
            'restaurant_id'=>1,
            'category_id'=>1
        ]);
    }
}

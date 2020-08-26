<?php

use Illuminate\Database\Seeder;

class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ingredients')->insert([
            'id'=>1,
            'name'=>'Azucar'
        ]);
    }
}

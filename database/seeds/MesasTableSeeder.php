<?php

use Illuminate\Database\Seeder;

class MesasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('mesas')->insert([
            'name'=>'Mesa 1',
            'capacity' =>'4',
            'restaurant_id'=>1
        ]);
    }
}

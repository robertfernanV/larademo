<?php

use Illuminate\Database\Seeder;

class RestaurnatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('restaurants')->insert([
            'name'=>'Mey Rest',
            'direction'=>'Lejos'
        ]);
    }
}

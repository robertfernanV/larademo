<?php

use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('schedules')->insert([
            'dayFrom'=>'Lunes',
            'dayUntil'=>'Viernes',
            'timeFrom'=>'08:00:00',
            'timeUntil'=>'20:00:00',
            'restaurant_id'=>1
        ]);
    }
}

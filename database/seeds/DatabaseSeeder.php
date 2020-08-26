<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(RestaurnatTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(MesasTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(DishTableSeeder::class);
        $this->call(IngredientTableSeeder::class);
        $this->call(UnitTableSeeder::class);
        $this->call(DishIngredientUnitSeeder::class);
        $this->call(CategoryDishSeeder::class);
    }
}

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
        Eloquent::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            CountryTableSeeder::class,
            UserTableSeeder::class,
            RoleTableSeeder::class,
            PageTableSeeder::class,
            MenuTableSeeder::class,
            MenuItemTableSeeder::class,
            UnitTableSeeder::class,
            SettingTableSeeder::class,
            //SliderTableSeeder::class,
            PageCategoryTableSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

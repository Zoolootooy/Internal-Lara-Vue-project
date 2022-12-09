<?php

use Illuminate\Database\Seeder;

use App\Models\Menu;
use App\Models\User;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::truncate();

        $adminUser = User::find(1);

        $adminUser->menus()->saveMany([
            new Menu([
                'type' => Menu::TYPE_SYSTEM,
                'name' => 'Main',
                'slug' => 'main',
            ]),
        ]);
    }
}
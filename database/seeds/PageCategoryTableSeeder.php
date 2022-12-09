<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PageCategory;

class PageCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PageCategory::truncate();

        $adminUser = User::find(1);

        $adminUser->pages()->saveMany([
            new PageCategory([
                'id' => 1,
                'name' => 'Blog',
                'slug' => 'blog',
                'visible' => true,
                'sorting' => 1,
            ]),
        ]);
    }
}

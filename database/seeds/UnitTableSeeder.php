<?php

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::truncate();

        $i = 1;

        Unit::create([
            'parent_id' => null,
            'name' => 'Dashboard',
            'slug' => 'dashboard',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Users',
            'slug' => 'user',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null, // not null
            'name' => 'Roles',
            'slug' => 'role',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null, // not null
            'name' => 'Permissions',
            'slug' => 'permission',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Pages',
            'slug' => 'page',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null, // not null
            'name' => 'Page Categories',
            'slug' => 'pageCategory',
            'visible' => false,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null, // not null
            'name' => 'Snippets',
            'slug' => 'snippet',
            'visible' => false,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null, // not null
            'name' => 'Menus',
            'slug' => 'menu',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null, // not null
            'name' => 'Menu Items',
            'slug' => 'menuItem',
            'visible' => false,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Media Files',
            'slug' => 'mediaFile',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null, // not null
            'name' => 'Media Categories',
            'slug' => 'mediaCategory',
            'visible' => false,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Slider',
            'slug' => 'slider',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'FAQ Items',
            'slug' => 'faqItem',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null, // not null
            'name' => 'FAQ Categories',
            'slug' => 'faqCategory',
            'visible' => false,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Quotes',
            'slug' => 'quote',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Emails',
            'slug' => 'mail',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Countries',
            'slug' => 'country',
            'visible' => true,
            'sorting' => $i++,
        ]);


        Unit::create([
            'parent_id' => null,
            'name' => 'Settings',
            'slug' => 'setting',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Units',
            'slug' => 'unit',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Translations',
            'slug' => 'translation',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Articles',
            'slug' => 'article',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Benefits',
            'slug' => 'benefit',
            'visible' => true,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Orders',
            'slug' => 'order',
            'visible' => false,
            'sorting' => $i++,
        ]);

        /*Unit::create([
            'parent_id' => null,
            'name' => 'Catalog',
            'slug' => 'catalog',
            'visible' => false,
            'sorting' => $i++,
        ]);

        Unit::create([
            'parent_id' => null,
            'name' => 'Themes',
            'slug' => 'theme',
            'visible' => false,
            'sorting' => $i++,
        ]);*/
    }
}

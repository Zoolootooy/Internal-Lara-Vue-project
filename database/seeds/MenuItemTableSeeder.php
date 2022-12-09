<?php

use Illuminate\Database\Seeder;

use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;

class MenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuItem::truncate();

        $item1 = new MenuItem([
            'id' => 1,
            'page_id' => null,
            'type' => MenuItem::TYPE_LINK,
            'link_name' => 'Home',
            'url' => '#slider',
            'sorting' => 1,
            'inherited' => true,
        ]);

        $item2 = new MenuItem([
            'id' => 2,
            'page_id' => null,
            'type' => MenuItem::TYPE_LINK,
            'link_name' => 'Features',
            'url' => '#quotes',
            'sorting' => 2,
            'inherited' => true,
        ]);

        $item3 = new MenuItem([
            'id' => 3,
            'page_id' => null,
            'type' => MenuItem::TYPE_LINK,
            'link_name' => 'Blog',
            'url' => '#posts',
            'sorting' => 3,
            'inherited' => true,
        ]);

        $item4 = new MenuItem([
            'id' => 4,
            'page_id' => null,
            'type' => MenuItem::TYPE_LINK,
            'link_name' => 'Team',
            'url' => '#users',
            'sorting' => 4,
            'inherited' => true,
        ]);

        $item5 = new MenuItem([
            'id' => 5,
            'page_id' => null,
            'type' => MenuItem::TYPE_LINK,
            'link_name' => 'Gallery',
            'url' => '#media',
            'sorting' => 5,
            'inherited' => true,
        ]);

        $item6 = new MenuItem([
            'id' => 6,
            'page_id' => null,
            'type' => MenuItem::TYPE_LINK,
            'link_name' => 'Faq',
            'url' => '#faqs',
            'sorting' => 6,
            'inherited' => true,
        ]);

        $item7 = new MenuItem([
            'id' => 7,
            'page_id' => null,
            'type' => MenuItem::TYPE_LINK,
            'link_name' => 'Contacts',
            'url' => '#contacts',
            'sorting' => 7,
            'inherited' => true,
        ]);

        $item8 = new MenuItem([
            'id' => 8,
            'page_id' => 4,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Register',
            'url' => null,
            'sorting' => 8,
            'inherited' => true,
        ]);

        $item9 = new MenuItem([
            'id' => 9,
            'page_id' => 7,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Login',
            'url' => null,
            'sorting' => 9,
            'inherited' => true,
        ]);

        $item10 = new MenuItem([
            'id' => 10,
            'page_id' => 9,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'My profile',
            'url' => null,
            'sorting' => 10,
            'inherited' => true,
        ]);

        $item11 = new MenuItem([
            'id' => 11,
            'page_id' => 9,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'My Profile',
            'url' => null,
            'sorting' => 11,
            'inherited' => true,
        ]);

        $item12 = new MenuItem([
            'id' => 12,
            'page_id' => 10,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Edit Profile',
            'url' => null,
            'sorting' => 12,
            'inherited' => true,
        ]);

        $item13 = new MenuItem([
            'id' => 13,
            'page_id' => 8,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Logout',
            'url' => null,
            'sorting' => 13,
            'inherited' => true,
        ]);

        /*$item1 = new MenuItem([
            'id' => 1,
            'page_id' => 1,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Main',
            'url' => null,
            'sorting' => 1,
            'inherited' => true,
        ]);

        $item2 = new MenuItem([
            'id' => 2,
            'page_id' => 2,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Company',
            'url' => null,
            'sorting' => 2,
            'inherited' => true,
        ]);

        $item3 = new MenuItem([
            'id' => 3,
            'page_id' => 11,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Blog',
            'url' => null,
            'sorting' => 8,
            'inherited' => true,
        ]);

        $item4 = new MenuItem([
            'id' => 4,
            'page_id' => 13,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Gallery',
            'url' => null,
            'sorting' => 9,
            'inherited' => true,
        ]);

        $item5 = new MenuItem([
            'id' => 5,
            'page_id' => 14,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Faq',
            'url' => null,
            'sorting' => 10,
            'inherited' => true,
        ]);

//        $item6 = new MenuItem([
//            'id' => 6,
//            'page_id' => 15,
//            'type' => MenuItem::TYPE_PAGE,
//            'link_name' => 'Catalog',
//            'url' => null,
//            'sorting' => 11,
//            'inherited' => true,
//        ]);
//
//        $item7 = new MenuItem([
//            'id' => 7,
//            'page_id' => 18,
//            'type' => MenuItem::TYPE_PAGE,
//            'link_name' => 'Cart',
//            'url' => null,
//            'sorting' => 12,
//            'inherited' => true,
//        ]);

        $item6 = new MenuItem([
            'id' => 6,
            'page_id' => 3,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Contacts',
            'url' => null,
            'sorting' => 3,
            'inherited' => true,
        ]);

        $item7 = new MenuItem([
            'id' => 7,
            'page_id' => 4,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Register',
            'url' => null,
            'sorting' => 4,
            'inherited' => true,
        ]);

        $item8 = new MenuItem([
            'id' => 8,
            'page_id' => 7,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Login',
            'url' => null,
            'sorting' => 5,
            'inherited' => true,
        ]);

        $item9 = new MenuItem([
            'id' => 9,
            'page_id' => 9,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'My profile',
            'url' => null,
            'sorting' => 6,
            'inherited' => true,
        ]);

        $item10 = new MenuItem([
            'id' => 10,
            'page_id' => 9,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'My Profile',
            'url' => null,
            'sorting' => 1,
            'inherited' => true,
        ]);

        $item11 = new MenuItem([
            'id' => 11,
            'page_id' => 10,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Edit Profile',
            'url' => null,
            'sorting' => 2,
            'inherited' => true,
        ]);

        $item12 = new MenuItem([
            'id' => 12,
            'page_id' => 6,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Reset Password',
            'url' => null,
            'sorting' => 3,
            'inherited' => true,
        ]);

//        $item13 = new MenuItem([
//            'id' => 13,
//            'page_id' => 11,
//            'type' => MenuItem::TYPE_PAGE,
//            'link_name' => 'Social Accounts',
//            'url' => null,
//            'sorting' => 4,
//            'inherited' => true,
//        ]);
//
//        $item14 = new MenuItem([
//            'id' => 14,
//            'page_id' => 17,
//            'type' => MenuItem::TYPE_PAGE,
//            'link_name' => 'Orders',
//            'url' => null,
//            'sorting' => 5,
//            'inherited' => true,
//        ]);

        $item13 = new MenuItem([
            'id' => 13,
            'page_id' => 8,
            'type' => MenuItem::TYPE_PAGE,
            'link_name' => 'Logout',
            'url' => null,
            'sorting' => 7,
            'inherited' => true,
        ]);*/

        $items = [
            $item1,
            $item2,
            $item3,
            $item4,
            $item5,
            $item6,
            $item7,
            $item8,
            $item9,
            $item10,
            $item11,
            $item12,
            $item13,
        ];

        $menu = Menu::find(1);
        $menu->items()->saveMany($items);

        $adminUser = User::find(1);
        $adminUser->menuItems()->saveMany($items);

        $item10->appendNode($item11);
        $item10->appendNode($item12);
    }
}

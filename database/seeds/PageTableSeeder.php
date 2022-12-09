<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::truncate();

        $adminUser = User::find(1);

        $i = 1;

        $adminUser->pages()->saveMany([
            new Page([
                'id' => 1,
                'link_name' => 'Main',
                'slug' => 'index',
                'sorting' => $i++,
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            ]),
            new Page([
                'id' => 2,
                'link_name' => 'Company',
                'slug' => 'company',
                'sorting' => $i++,
                'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
            ]),
            new Page([
                'id' => 3,
                'link_name' => 'Contacts',
                'slug' => 'contact',
                'sorting' => $i++,
            ]),
            new Page([
                'id' => 4,
                'link_name' => 'Register',
                'slug' => 'register',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_GUEST,
            ]),
            new Page([
                'id' => 5,
                'link_name' => 'Reset Password',
                'slug' => 'profile/request-password-reset',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_GUEST,
            ]),
            new Page([
                'id' => 6,
                'link_name' => 'Reset Password',
                'slug' => 'profile/password',
                'sorting' => $i++,
            ]),
            new Page([
                'id' => 7,
                'link_name' => 'Login',
                'slug' => 'login',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_GUEST,
            ]),
            new Page([
                'id' => 8,
                'link_name' => 'Logout',
                'slug' => 'logout',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_LOGGED,
            ]),
            new Page([
                'id' => 9,
                'link_name' => 'My Profile',
                'slug' => 'profile',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_LOGGED,
            ]),
            new Page([
                'id' => 10,
                'link_name' => 'Edit Profile',
                'slug' => 'profile/edit',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_LOGGED,
            ]),
            /*new Page([
                'id' => 11,
                'link_name' => 'Social Accounts',
                'slug' => 'profile/social',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_NO,
            ]),*/
            new Page([
                'id' => 11,
                'link_name' => 'Blog',
                'slug' => 'blog',
                'sorting' => $i++,
            ]),
            new Page([
                'id' => 12,
                'link_name' => 'Blog Post',
                'slug' => 'blog/post',
                'sorting' => $i++,
            ]),
            new Page([
                'id' => 13,
                'link_name' => 'Gallery',
                'slug' => 'gallery/index',
                'sorting' => $i++,
                'visible' => 0,
            ]),
            new Page([
                'id' => 14,
                'link_name' => 'Faq',
                'slug' => 'faq/index',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_NO,
            ]),
            /*new Page([
                'id' => 15,
                'link_name' => 'Catalog',
                'slug' => 'catalog/index',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_NO,
            ]),
            new Page([
                'id' => 16,
                'link_name' => 'Product',
                'slug' => 'catalog/product',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_NO,
            ]),
            new Page([
                'id' => 17,
                'link_name' => 'Orders',
                'slug' => 'order/index',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_NO,
            ]),
            new Page([
                'id' => 18,
                'link_name' => 'Cart',
                'slug' => 'order/cart',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_NO,
            ]),
            new Page([
                'id' => 19,
                'link_name' => 'Checkout',
                'slug' => 'order/checkout',
                'sorting' => $i++,
                'visible' => Page::VISIBLE_NO,
            ]),
            new Page([
                'id' => 20,
                'link_name' => 'Thank You',
                'slug' => 'order/thank',
                'sorting' => $i++,
                'content' => '<p>You have successfully completed your order.</p><p>Our team will contact you as soon as possible.</p>',
                'visible' => Page::VISIBLE_NO,
            ]),
            new Page([
                'id' => 21,
                'link_name' => 'Cancel Order',
                'slug' => 'order/cancel',
                'sorting' => $i++,
                'content' => '<p>You have canceled your order.</p>',
                'visible' => Page::VISIBLE_NO,
            ]),*/
        ]);
    }
}

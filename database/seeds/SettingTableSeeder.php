<?php

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        $adminUser = User::find(1);

        $adminUser->settings()->saveMany([
            Setting::create([
                'type' => Setting::TYPE_SYSTEM,
                'title' => 'Default Site Title',
                'key' => 'site_title',
                'value' => 'Company Site',
            ]),
            Setting::create([
                'type' => Setting::TYPE_SYSTEM,
                'title' => 'Default Meta Keywords',
                'key' => 'site_meta_keywords',
                'value' => 'Company Site',
            ]),
            Setting::create([
                'type' => Setting::TYPE_SYSTEM,
                'title' => 'Default Meta Description',
                'key' => 'site_meta_description',
                'value' => 'Company Site',
            ]),
            Setting::create([
                'type' => Setting::TYPE_SYSTEM,
                'title' => 'Administrator Email',
                'key' => 'admin_email',
                'value' => 'admin@gmail.com',
            ]),
            Setting::create([
                'type' => Setting::TYPE_SYSTEM,
                'title' => 'Administrator Name',
                'key' => 'admin_name',
                'value' => 'Admin Name',
            ]),
            Setting::create([
                'type' => Setting::TYPE_CUSTOM,
                'title' => 'Organization Name',
                'key' => 'contact_name',
                'value' => 'Organization Name',
            ]),
            Setting::create([
                'type' => Setting::TYPE_CUSTOM,
                'title' => 'Organization Address',
                'key' => 'contact_address',
                'value' => 'Organization Address',
            ]),
            Setting::create([
                'type' => Setting::TYPE_CUSTOM,
                'title' => 'Organization Phone',
                'key' => 'contact_phone',
                'value' => '+1-234-567890',
            ]),
            Setting::create([
                'type' => Setting::TYPE_CUSTOM,
                'title' => 'Organization Mail',
                'key' => 'contact_email',
                'value' => 'organization@gmail.com',
            ]),
            Setting::create([
                'type' => Setting::TYPE_CUSTOM,
                'title' => 'Organization Fax',
                'key' => 'contact_fax',
                'value' => '+1-234-567890',
            ]),
            Setting::create([
                'type' => Setting::TYPE_CUSTOM,
                'title' => 'Organization Twitter',
                'key' => 'contact_twitter',
                'value' => 'https://twitter.com/',
            ]),
            Setting::create([
                'type' => Setting::TYPE_CUSTOM,
                'title' => 'Organization Web-Site',
                'key' => 'contact_site',
                'value' => 'http://website.com/',
            ]),
            Setting::create([
                'type' => Setting::TYPE_CUSTOM,
                'title' => 'Organization Skype',
                'key' => 'contact_skype',
                'value' => 'organization_skype',
            ]),
        ]);
    }
}

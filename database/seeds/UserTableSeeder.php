<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws Exception
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $date = new \DateTime();

        User::create([
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('qwerty'),
            'first_name' => 'Super',
            'last_name' => 'Admin',
            //'country_id' => 1,
            'zip' => '12345',
            'city' => 'New York',
            'address' => 'Times Square',
            'phone' => '+1234567890',
            //'birthday' => now(),
            'gender' => false,
            'status' => 1,
            //'last_login_at' => $date,
            'email_verified_at' => $date,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        $date = $date->add(new \DateInterval('PT1S'));

        User::create([
            'username' => 'tanya',
            'email' => 'tanya.v.nazarchuk@gmail.com',
            'password' => bcrypt('qwerty'),
            'first_name' => 'Tanya',
            'last_name' => 'Nazarchuk',
            //'country_id' => 1,
            'zip' => '6900',
            'city' => 'Zaporozie',
            'address' => 'Ivanova, 11/12',
            'phone' => '+380968308708',
            //'birthday' => now(),
            'gender' => true,
            'status' => 1,
            //'last_login_at' => $date,
            'email_verified_at' => $date,
            'created_at' => $date,
            'updated_at' => $date,
        ]);

        $date = $date->add(new \DateInterval('PT1S'));

        User::create([
            'username' => 'demo',
            'email' => 'demo@demo.com',
            'password' => bcrypt('qwerty'),
            'first_name' => 'Demo',
            'last_name' => 'User',
            //'country_id' => 1,
            'zip' => '12345',
            'city' => 'New York',
            'address' => 'Times Square',
            'phone' => '+1234567890',
            //'birthday' => now(),
            'gender' => false,
            'status' => 1,
            //'last_login_at' => $date,
            'email_verified_at' => $date,
            'created_at' => $date,
            'updated_at' => $date,
        ]);
    }
}

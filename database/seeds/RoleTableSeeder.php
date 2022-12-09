<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        $adminRole = Role::create([
            'name' => 'Admin',
            'type' => Role::TYPE_SYSTEM,
        ]);

        $editorRole = Role::create([
            'name' => 'Editor',
            'type' => Role::TYPE_SYSTEM,
        ]);

        $authorRole = Role::create([
            'name' => 'Author',
            'type' => Role::TYPE_SYSTEM,
        ]);

        $userRole = Role::create([
            'name' => 'User',
            'type' => Role::TYPE_SYSTEM,
        ]);

        $demoRole = Role::create([
            'name' => 'Demo',
            'type' => Role::TYPE_SYSTEM,
        ]);

        $teamRole = Role::create([
            'name' => 'Team',
            'type' => Role::TYPE_SYSTEM,
        ]);

        $adminUser1 = User::find(1);
        $adminUser2 = User::find(2);
        $demoUser = User::find(3);

        $adminUser1->addedRoles()->saveMany([
            $adminRole,
            $editorRole,
            $authorRole,
            $userRole,
            $demoRole,
            $teamRole,
        ]);

        $adminRole->users()->attach($adminUser1);
        $adminRole->users()->attach($adminUser2);
        $adminRole->users()->attach($demoUser);
        $demoRole->users()->attach($demoUser);
    }
}

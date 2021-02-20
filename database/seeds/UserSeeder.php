<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['name' => 'Tun Tun', 'email' => 'tuntun@gmail.com', 'password' => Hash::make('password')]);
        $role = Role::create(['name' => 'creator']);
        $permission = Permission::create(['name' => 'create contacts']);

        $user->assignRole($role);
        $role->givePermissionTo($permission);
    }
}

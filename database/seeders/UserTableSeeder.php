<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'fname' => 'Hardik Savani',
            'lname' => 'Hardik Savani',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('11111111')
        ]);

        $role = Role::create(['name' => 'super_administrator']); // 1-create role

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions); // 2- assign permisssions to role super_adminstrator

        $user->assignRole([$role->id]);  // 3- assign role to user
    }
}

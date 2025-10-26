<?php

namespace Database\Seeders;

use App\Models\Priveleges;
use App\Models\RolePriveleges;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserManagement extends Seeder
{
    public function run()
    {
        $role = Roles::updateOrCreate(['name' => 'Guru']);
        $murid = Roles::updateOrCreate(['name' => 'Murid']);

        $privilege = Priveleges::updateOrCreate([
            'module' => 'DEVELOPER',
            'sub_module' => 'ALL ACCESS',
            'namespace' => '*',
        ], [
            'module_name' => 'All Access',
            'ordering' => 1
        ]);

        RolePriveleges::updateOrCreate(
            [
                'role' => $role->id,
                'namespace' => '*'
            ],
            [
                'role' => $role->id,
                'namespace' => '*'
            ]
        );

        RolePriveleges::updateOrCreate(
            [
                'role' => $murid->id,
                'namespace' => '*'
            ],
            [
                'role' => $murid->id,
                'namespace' => '*'
            ]
        );

        // Temporary Commented
        User::updateOrCreate([
            'username' => 'superadmin'
        ], [
            'photo' => null,
            'name' => 'Guru',
            'username' => 'superadmin',
            'email' => 'superadmin@mail.com',
            'gender' => 'Male',
            'address' => 'Jakarta',
            'phone_number' => '08191100000',
            'password' => bcrypt('password'),
            'role' => $role->id
        ]);
    }
}

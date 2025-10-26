<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleGuru = Roles::where('name', 'Guru')->first();
        if (!$roleGuru) {
            $roleGuru = Roles::create(['name' => 'Guru']);
        }
        $users = [
            'photo' => null,
            'name' => 'Guru',
            'username' => 'guru',
            'email' => 'guru@mail.com',
            'gender' => 'Male',
            'address' => 'Jakarta',
            'phone_number' => '08191100000',
            'password' => bcrypt('password'),
            'role' => $roleGuru->id
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }
}

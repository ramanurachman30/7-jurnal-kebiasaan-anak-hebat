<?php

namespace Database\Seeders;

use App\Models\Priveleges;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $privilege = [
            'module' => 'DEVELOPER',
            'sub_module' => 'ALL ACCESS',
            'module_name' => 'All Access',
            'namespace' => '*',
            'ordering' => 1
        ];

        Priveleges::firstOrCreate(
            [
                'module' => 'DEVELOPER',
                'sub_module' => 'ALL ACCESS',
                'namespace' => '*'
            ],
            [
                'module_name' => 'All Access',
                'ordering' => 1
            ]
        );
    }
}

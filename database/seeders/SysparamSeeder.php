<?php

namespace Database\Seeders;

use App\Models\Sysparams;
use Illuminate\Database\Seeder;

class SysparamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'groups' => 'Gender',
                'key' => 'Male',
                'value' => 'Male',
                'ordering' => '1'
            ],
            [
                'groups' => 'Gender',
                'key' => 'Famale',
                'value' => 'Famale',
                'ordering' => '2'
            ],
        ];

        foreach ($data as $item) {
            Sysparams::updateOrCreate(
                [
                    'groups' => $item['groups'],
                    'key' => $item['key']
                ],
                [
                    'value' => $item['value'],
                    'ordering' => $item['ordering']
                ]
            );
        }
    }
}

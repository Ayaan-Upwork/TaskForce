<?php

namespace Database\Seeders;

use App\Models\Employe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employes = [
            [
                'id' => 1,
                'employe_name'    => 'ali',
                'employe_email'           => 'ali@gmail.com',
                'employe_number'          => '042445542',
                'employe_address'       => 'Test adress abc 123',
                'employe_status' => 1
            ], [
                'id' => 2,
                'employe_name'    => 'zafar',
                'employe_email'           => 'zafar@gmail.com',
                'employe_number'          => '0424455432',
                'employe_address'       => 'Test adress abc 123',
                'employe_status' => 1
            ],
        ];
        Employe::insert($employes);
    }
}

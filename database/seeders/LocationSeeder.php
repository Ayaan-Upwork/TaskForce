<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            [
                'id'             => 1,
                'city'           => 'Karachi',
                'state'          => 'Sindh',
                'client_name' => 'client first',
                'address'       => 'Test adress abc 123'
            ],[
                'id'             => 2,
                'city'           => 'MPK',
                'client_name' => 'client second',
                'state'          => 'Sindh',
                'address'       => 'Test adress abc 123'
            ],
        ];
        Location::insert($locations);
    }
}

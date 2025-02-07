<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id'             => 10,
                'name'           => 'Ali',
                'email'          => 'ali@gmail.com',
                'password'       => Hash::make('11223344'),
                'role_as'          => '1'
            ],[
                'id'             => 11,
                'name'           => 'Admin',
                'email'          => 'sadmin@gmail.com',
                'password'       => Hash::make('11223344'),
                'role_as'          => '1'
            ],
        ];
        User::insert($users);
    }
}

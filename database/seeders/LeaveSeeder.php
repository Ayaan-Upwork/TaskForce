<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $leaves = [
            [
                'id'            =>  1,
                'employe_id'        =>  1,
                'start_date'     =>  '2022-06-02',
                'description'   =>  'Test description abc 123',
                'end_date'       =>  '2022-06-08',
                'total_leave_days'   =>  6
            ],[
                'id'            =>  2,
                'employe_id'        =>  2,
                'start_date'     =>  '2022-06-08',
                'description'   =>  'Test description abc 123',
                'end_date'       =>  '2022-06-25',
                'total_leave_days'   =>  5
            ],
        ];
        Leave::insert($leaves);
    }
}

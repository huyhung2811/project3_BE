<?php

namespace Database\Seeders;

use App\Models\AttendanceTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AttendanceTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'student_attendance_id' => 1,
                'day' => Carbon::now()->format('Y-m-d'),
                'time' => Carbon::now()->format('H:i:s'),
                'bluetooth_address' => 'TEST_SEEDER',
                'type' => 'start_time'
            ],
            [
                'student_attendance_id' => 1,
                'day' => Carbon::now()->format('Y-m-d'),
                'time' => Carbon::now()->format('H:i:s'),
                'bluetooth_address' => 'TEST_SEEDER',
                'type' => 'end_time'
            ],
        ];

        AttendanceTime::insert($data);
    }
}

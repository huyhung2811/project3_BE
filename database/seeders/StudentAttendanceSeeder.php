<?php

namespace Database\Seeders;

use App\Models\StudentAttendance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'student_class_id' => 3,
                'day' => '2024-05-29',
                'status' => 'Đi học'
            ]
        ];

        StudentAttendance::insert($data);
    }
}

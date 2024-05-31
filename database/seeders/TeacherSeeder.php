<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teacher;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'teacher_code'=>'TC1',
                'name'=>'Teacher 1',
                'email'=>'teacher1@hust.edu.vn',
                'unit_id'=>5,
                'avatar' => '',
            ],
            [
                'teacher_code'=>'TC2',
                'name'=>'Teacher 2',
                'email'=>'teacher2@hust.edu.vn',
                'unit_id'=>5,
                'avatar' => '',
            ],
            [
                'teacher_code'=>'TC3',
                'name'=>'Teacher 3',
                'email'=>'teacher3@hust.edu.vn',
                'unit_id'=>5,
                'avatar' => '',
            ],
            [
                'teacher_code'=>'TC4',
                'name'=>'Teacher 4',
                'email'=>'teacher4@hust.edu.vn',
                'unit_id'=>5,
                'avatar' => '',
            ],
            [
                'teacher_code'=>'TC5',
                'name'=>'Teacher 5',
                'email'=>'teacher5@hust.edu.vn',
                'unit_id'=>5,
                'avatar' => '',
            ],
            [
                'teacher_code'=>'TC6',
                'name'=>'Teacher 6',
                'email'=>'teacher6@hust.edu.vn',
                'unit_id'=>9,
                'avatar' => '',
            ],
            [
                'teacher_code'=>'TC7',
                'name'=>'Teacher 7',
                'email'=>'teacher7@hust.edu.vn',
                'unit_id'=>9,
                'avatar' => '',
            ],
            [
                'teacher_code'=>'TC8',
                'name'=>'Teacher 8',
                'email'=>'teacher8@hust.edu.vn',
                'unit_id'=>5,
                'avatar' => '',
            ],
        ];

        Teacher::insert($data);
    }
}

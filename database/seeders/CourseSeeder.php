<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'course_code' => 'MI1144',
                'name' => 'Đại số tuyến tính',
                'number_of_credit' => 3,
                'type' => 'Lớp',
                'unit_id' => 9,
            ],
            [
                'course_code' => 'IT5022',
                'name' => 'Nghiên cứu tốt nghiệp 2',
                'number_of_credit' => 2,
                'type' => 'Đồ án',
                'unit_id' => 5,
            ],
            [
                'course_code' => 'IT4652',
                'name' => 'Mạng Internet',
                'number_of_credit' => 2,
                'type' => 'Lớp',
                'unit_id' => 5,
            ],
            [
                'course_code' => 'IT4948',
                'name' => 'Thực tập công nghiệp',
                'number_of_credit' => 2,
                'type' => 'Thực tập',
                'unit_id' => 5,
            ],
            [
                'course_code' => 'IT4542',
                'name' => 'Quản trị phát triển phần mềm',
                'number_of_credit' => 2,
                'type' => 'Lớp',
                'unit_id' => 5,
            ],
            [
                'course_code' => 'IT3382',
                'name' => 'Kỹ năng ITSS học bằng tiếng Nhật 2',
                'number_of_credit' => 2,
                'type' => 'Lớp',
                'unit_id' => 5,
            ],
            [
                'course_code' => 'IT4212',
                'name' => 'Hệ thống thời gian thực',
                'number_of_credit' => 2,
                'type' => 'Lớp',
                'unit_id' => 5,
            ],
            [
                'course_code' => 'IT4362',
                'name' => 'Kỹ nghệ tri thức',
                'number_of_cred it' => 2,
                'type' => 'Lớp',
                'unit_id' => 5,
            ],
        ];

        Course::insert($data);
    }
}

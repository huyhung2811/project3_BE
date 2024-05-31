<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SystemsCourses;

class SystemsCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'system_id' => 1,
                'course_code' => 'MI1144',
            ],
            [
                'system_id' => 2,
                'course_code' => 'MI1144',
            ],
            [
                'system_id' => 6,
                'course_code' => 'MI1144',
            ],
            [
                'system_id' => 1,
                'course_code' => 'IT5022',
            ],
            [
                'system_id' => 6,
                'course_code' => 'IT5022',
            ],
            [
                'system_id' => 6,
                'course_code' => 'IT4652',
            ],
            [
                'system_id' => 6,
                'course_code' => 'IT4542',
            ],
            [
                'system_id' => 6,
                'course_code' => 'IT3382',
            ],
            [
                'system_id' => 6,
                'course_code' => 'IT4212',
            ],
            [
                'system_id' => 6,
                'course_code' => 'IT4362',
            ],
        ];

        SystemsCourses::insert($data);
    }
}

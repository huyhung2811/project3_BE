<?php

namespace Database\Seeders;

use App\Models\CourseClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'class_code' => 139959,
                'semester_id' => 6,
                'course_code' => 'MI1144',
                'teacher_code' => 'TC6',
                'room_id' => 32,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => 'BT',
                'school_day' => 'Monday',
                'start_time' => '8:25:00',
                'end_time' => '10:05:00',
            ],
            [
                'class_code' => 143700,
                'semester_id' => 6,
                'course_code' => 'IT5022',
                'teacher_code' => 'TC1',
                'room_id' => null,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => "DA",
                'school_day' => null,
                'start_time' => null,
                'end_time' => null,
            ],  
            [
                'class_code' => 139956,
                'semester_id' => 6,
                'course_code' => 'MI1144',
                'teacher_code' => 'TC7',
                'room_id' => 29,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => 'LT',
                'school_day' => 'Wednesday',
                'start_time' => '16:00:00',
                'end_time' => '17:30:00',
            ],  
            [
                'class_code' => 736509,
                'semester_id' => 6,
                'course_code' => 'IT4948',
                'teacher_code' => 'TC3',
                'room_id' => null,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => "TT",
                'school_day' => null,
                'start_time' => null,
                'end_time' => null,
            ],
            [
                'class_code' => 143527,
                'semester_id' => 6,
                'course_code' => 'IT4542',
                'teacher_code' => 'TC4',
                'room_id' => 22,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => "LT + BT",
                'school_day' => "Tuesday",
                'start_time' => "10:15:00",
                'end_time' => "11:45:00",
            ],
            [
                'class_code' => 143528,
                'semester_id' => 6,
                'course_code' => 'IT3382',
                'teacher_code' => 'TC5',
                'room_id' => 53,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => "LT + BT",
                'school_day' => "Tuesday",
                'start_time' => "14:10:00",
                'end_time' => "17:30:00",
            ],
            [
                'class_code' => 143525,
                'semester_id' => 6,
                'course_code' => 'IT4212',
                'teacher_code' => 'TC1',
                'room_id' => 31,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => "LT + BT",
                'school_day' => "Wednesday",
                'start_time' => "10:15:00",
                'end_time' => "11:45:00",
            ],
            [
                'class_code' => 143521,
                'semester_id' => 6,
                'course_code' => 'IT4652',
                'teacher_code' => 'TC2',
                'room_id' => 75,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => "LT + BT",
                'school_day' => "Tuesday",
                'start_time' => "12:30:00",
                'end_time' => "14:00:00",
            ],
            [
                'class_code' => 143526,
                'semester_id' => 6,
                'course_code' => 'IT4362',
                'teacher_code' => 'TC8',
                'room_id' => 31,
                'education_format' => 'offline',
                'description' => null,
                'class_type' => "LT + BT",
                'school_day' => "Wednesday",
                'start_time' => "8:25:00",
                'end_time' => "10:05:00",
            ],
        ];
        CourseClass::insert($data);
    }
}

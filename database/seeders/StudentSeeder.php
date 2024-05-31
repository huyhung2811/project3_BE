<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'student_code' => 20194579,
                'name' => 'Lê Huy Hùng',
                'birth_date' => '2001-11-28',
                'phone' => '0987654321',
                'address' => 'Yên Hòa, Cầu Giấy, Hà Nội',
                'home_town' => 'Hương Sơn, Hà Tĩnh',
                'email' => 'hung.lh194579@sis.hust.edu.vn',
                'avatar' => '',
                'student_course' => 64,
                'class_id' => 1,
            ],
            [
                'student_code' => 20194483,
                'name' => 'Trịnh Huy Bằng',
                'birth_date' => '2001-04-12',
                'phone' => '0987654320',
                'address' => 'Yên Hòa, Cầu Giấy, Hà Nội',
                'home_town' => 'Hương Sơn, Hà Tĩnh',
                'email' => 'bang.th194483@sis.hust.edu.vn',
                'avatar' => '',
                'student_course' => 64,
                'class_id' => 2,
            ],
        ];
        Student::insert($data);
    }
}

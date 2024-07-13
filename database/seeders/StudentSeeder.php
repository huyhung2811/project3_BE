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
                'class_id' => 1,
            ],
            [
                'student_code' => 20194574,
                'name' => 'Phạm Huy Hoàng',
                'birth_date' => '2001-04-02',
                'phone' => '0987654322',
                'address' => 'Yên Hòa, Cầu Giấy, Hà Nội',
                'home_town' => 'Hương Sơn, Hà Tĩnh',
                'email' => 'hoang.ph194574@sis.hust.edu.vn',
                'avatar' => '',
                'student_course' => 64,
                'class_id' => 1,
            ],
            [
                'student_code' => 20194504,
                'name' => 'Nguyễn Tiến Đạt',
                'birth_date' => '2001-03-03',
                'phone' => '0987654323',
                'address' => 'Trương Định, Hai Bà Trưng, Hà Nội',
                'home_town' => 'Vĩnh Tường, Vĩnh Phúc',
                'email' => 'dat.nt194504@sis.hust.edu.vn',
                'avatar' => '',
                'student_course' => 64,
                'class_id' => 1,
            ],
            [
                'student_code' => 20194584,
                'name' => 'Lê Tuấn Hưng',
                'birth_date' => '2001-05-12',
                'phone' => '0987654324',
                'address' => 'Định Công, Hoàng Mai, Hà Nội',
                'home_town' => 'Hương Sơn, Hà Tĩnh',
                'email' => 'hung.lt194584@sis.hust.edu.vn',
                'avatar' => '',
                'student_course' => 64,
                'class_id' => 2,
            ],
            [
                'student_code' => 20194594,
                'name' => 'Lê Ngọc Khoa',
                'birth_date' => '2001-07-12',
                'phone' => '0987654325',
                'address' => 'Định Công, Hoàng Mai, Hà Nội',
                'home_town' => 'Yên Lạc, Vĩnh Phúc',
                'email' => 'khoa.ln194594@sis.hust.edu.vn',
                'avatar' => '',
                'student_course' => 64,
                'class_id' => 2,
            ],
        ];
        Student::insert($data);
    }
}

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
        //1, 6, 4, 7, 9, 8, 3  
        $data = [
            ['student_class_id' => 1,'day' => '2024-07-01','status' => 'Đi học'],
            ['student_class_id' => 6,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 4,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 7,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 9,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 8,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 3,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 1,'day' => '2024-07-08','status' => 'Đi học'],
            ['student_class_id' => 6,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 4,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 7,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 9,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 8,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 3,'day' => '2024-07-10','status' => 'Đi học'],
            
            ['student_class_id' => 10,'day' => '2024-07-01','status' => 'Đi học'],
            ['student_class_id' => 15,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 13,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 16,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 18,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 17,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 12,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 10,'day' => '2024-07-08','status' => 'Đi học'],
            ['student_class_id' => 15,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 13,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 16,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 18,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 17,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 12,'day' => '2024-07-10','status' => 'Đi học'],

            ['student_class_id' => 19,'day' => '2024-07-01','status' => 'Đi học'],
            ['student_class_id' => 24,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 22,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 25,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 27,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 26,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 21,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 19,'day' => '2024-07-08','status' => 'Đi học'],
            ['student_class_id' => 24,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 22,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 25,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 27,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 26,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 21,'day' => '2024-07-10','status' => 'Đi học'],
            
            ['student_class_id' => 28,'day' => '2024-07-01','status' => 'Đi học'],
            ['student_class_id' => 33,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 31,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 34,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 36,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 35,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 30,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 28,'day' => '2024-07-08','status' => 'Đi học'],
            ['student_class_id' => 33,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 31,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 34,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 36,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 35,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 30,'day' => '2024-07-10','status' => 'Đi học'],

            ['student_class_id' => 37,'day' => '2024-07-01','status' => 'Đi học'],
            ['student_class_id' => 42,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 40,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 43,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 45,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 44,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 39,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 37,'day' => '2024-07-08','status' => 'Đi học'],
            ['student_class_id' => 42,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 40,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 43,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 45,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 44,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 39,'day' => '2024-07-10','status' => 'Đi học'],

            ['student_class_id' => 46,'day' => '2024-07-01','status' => 'Đi học'],
            ['student_class_id' => 51,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 49,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 52,'day' => '2024-07-02','status' => 'Đi học'],
            ['student_class_id' => 54,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 53,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 48,'day' => '2024-07-03','status' => 'Đi học'],
            ['student_class_id' => 46,'day' => '2024-07-08','status' => 'Đi học'],
            ['student_class_id' => 51,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 49,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 52,'day' => '2024-07-09','status' => 'Đi học'],
            ['student_class_id' => 54,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 53,'day' => '2024-07-10','status' => 'Đi học'],
            ['student_class_id' => 48,'day' => '2024-07-10','status' => 'Đi học'],
        ];

        StudentAttendance::insert($data);
    }
}

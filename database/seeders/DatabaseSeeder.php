<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UnitSeeder::class);
        $this->call(EducationalSystemsSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(TeacherSeeder::class);
        $this->call(ClassSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(SystemsCoursesSeeder::class);
        $this->call(CourseClassesSeeder::class);
        $this->call(StudentsClassesSeeder::class);
        $this->call(StudentAttendanceSeeder::class);
        $this->call(AttendanceTimeSeeder::class);
        $this->call(HolidaySeeder::class);
    }
}

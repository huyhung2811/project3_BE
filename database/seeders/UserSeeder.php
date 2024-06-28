<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'email' => 'admin@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'admin',
            ],
            [
                'email' => 'hung.lh194579@sis.hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'student',
            ],
            [
                'email' => 'bang.th194483@sis.hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'student',
            ],
            [
                'email' => 'teacher1@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
            [
                'email' => 'teacher2@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
            [
                'email' => 'teacher3@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
            [
                'email' => 'teacher4@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
            [
                'email' => 'teacher5@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
            [
                'email' => 'teacher6@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
            [
                'email' => 'teacher7@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
            [
                'email' => 'teacher8@hust.edu.vn',
                'password' => bcrypt('123456'),
                'role' => 'teacher',
            ],
        ];

        User::insert($data);
    }
}

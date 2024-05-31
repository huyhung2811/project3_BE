<?php

namespace Database\Seeders;

use App\Models\EducationalSystem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EducationalSystemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Kỹ sư chính quy',
                'enrollment_code' => 'KS',
            ],
            [
                'name' => 'Kỹ sư chất lượng cao',
                'enrollment_code' => 'CLC',
            ],
            [
                'name' => 'Kỹ thuật cơ điện tử',
                'enrollment_code' => 'ME1',
            ],
            [
                'name' => 'Kỹ thuật cơ khí',
                'enrollment_code' => 'ME2',
            ],
            [
                'name' => 'Kỹ thuật Ô tô',
                'enrollment_code' => 'TE1',
            ],
            [
                'name' => 'Công nghệ thông tin (Việt - Nhật)',
                'enrollment_code' => 'IT-E6',
            ],
            [
                'name' => 'Công nghệ thông tin (Global ICT)',
                'enrollment_code' => 'IT-E7',
            ],
            [
                'name' => 'Khoa học Dữ liệu và Trí tuệ Nhân tạo',
                'enrollment_code' => 'IT-E10',
            ],
        ];

        EducationalSystem::insert($data);
    }
}

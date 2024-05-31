<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Holiday;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'description' => 'Tết dương lịch',
                'start_date' => '2024-01-01',
                'end_date' => '2024-01-01',
            ],
            [
                'description' => 'Tết âm lịch',
                'start_date' => '2024-02-08',
                'end_date' => '2024-02-14',
            ],
            [
                'description' => 'Ngày Giỗ tổ Hùng Vương',
                'start_date' => '2024-04-18',
                'end_date' => '2024-04-18',
            ],
            [
                'description' => 'Ngày giải phóng miền Nam',
                'start_date' => '2024-04-30',
                'end_date' => '2024-04-30',
            ],
            [
                'description' => 'Ngày Quốc tế lao động',
                'start_date' => '2024-05-01',
                'end_date' => '2024-05-01',
            ],
            [
                'description' => 'Ngày Quốc khánh',
                'start_date' => '2024-09-02',
                'end_date' => '2024-09-02',
            ],
        ];

        Holiday::insert($data);
    }
}

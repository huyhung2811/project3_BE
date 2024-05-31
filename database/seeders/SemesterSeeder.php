<?php

namespace Database\Seeders;

use App\Models\Semester;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'semester' => '2022.1',
                'start_date' => '2022-10-05',
                'end_date' => '2023-02-24',
            ],
            [
                'semester' => '2022.2',
                'start_date' => '2023-03-20',
                'end_date' => '2023-07-20',
            ],
            [
                'semester' => '2022.3',
                'start_date' => '2023-08-01',
                'end_date' => '2023-09-01',
            ],
            [
                'semester' => '2023.1',
                'start_date' => '2023-09-11',
                'end_date' => '2024-01-10',
            ],
            [
                'semester' => '2023.2',
                'start_date' => '2024-02-19',
                'end_date' => '2024-06-30',
            ]
        ];

        Semester::insert($data);
    }
}

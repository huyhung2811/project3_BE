<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudentClass;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Application Specialist 01-K64',
                'unit_id' => 5,
                'system_id' => 6,
            ],
            [
                'name' => 'Physics',
                'unit_id' => 2, 
                'system_id' => 6,
            ],
            [
                'name' => 'Chemistry',
                'unit_id' => 3,
                'system_id' => 2,
            ],
        ];

        StudentClass::insert($data);
    }
}

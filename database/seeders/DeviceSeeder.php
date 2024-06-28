<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'room_id' => 22,
                'MAC_address' => '08:B6:1F:BE:4C:44',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' =>23,
                'MAC_address' => '08:B6:1F:BE:4C:45',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 24,
                'MAC_address' => '08:B6:1F:BE:4C:46',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 25,
                'MAC_address' => '08:B6:1F:BE:4C:47',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 26,
                'MAC_address' => '08:B6:1F:BE:4C:48',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 27,
                'MAC_address' => '08:B6:1F:BE:4C:49',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 28,
                'MAC_address' => '08:B6:1F:BE:4C:50',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 29,
                'MAC_address' => '08:B6:1F:BE:4C:51',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 30,
                'MAC_address' => '08:B6:1F:BE:4C:52',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 31,
                'MAC_address' => '08:B6:1F:BE:4C:53',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 32,
                'MAC_address' => '08:B6:1F:BE:4C:54',
                'updated_time' => Carbon::now(),
            ],
            [
                'room_id' => 33,
                'MAC_address' => '08:B6:1F:BE:4C:55',
                'updated_time' => Carbon::now(),
            ],
        ];

        Device::insert($data);
    }
}

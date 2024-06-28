<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        for ($floor = 1; $floor <= 5; $floor++) {
            for ($room = 1; $room <= 7; $room++) {
                $data[] = [
                    'building' => 'D9',
                    'room' => sprintf('%d%02d', $floor, $room),
                ];
            }
        }

        for ($floor = 1; $floor <= 5; $floor++) {
            for ($room = 1; $room <= 6; $room++) {
                $data[] = [
                    'building' => 'D5',
                    'room' => sprintf('%d%02d', $floor, $room),
                ];
            }
        }

        for ($floor = 1; $floor <= 5; $floor++) {
            for ($room = 1; $room <= 7; $room++) {
                $data[] = [
                    'building' => 'D7',
                    'room' => sprintf('%d%02d', $floor, $room),
                ];
            }
        }

        Room::insert($data);
    }
}

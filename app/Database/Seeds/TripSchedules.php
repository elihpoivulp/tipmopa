<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TripSchedules extends Seeder
{
    public function run()
    {
        $data = [
            [
                'boat_id' => '1',
                'schedule_id' => '1',
                'start_location_id' => '2',
                'schedule_date' => date('Y-m-d'),
                'departed_1' => 0,
                'departed_2' => 0
            ],
            [
                'boat_id' => '2',
                'schedule_id' => '2',
                'start_location_id' => '3',
                'schedule_date' => date('Y-m-d'),
                'departed_1' => 0,
                'departed_2' => 0
            ],
            [
                'boat_id' => '3',
                'schedule_id' => '3',
                'start_location_id' => '4',
                'schedule_date' => date('Y-m-d'),
                'departed_1' => 0,
                'departed_2' => 0
            ],
            [
                'boat_id' => '4',
                'schedule_id' => '4',
                'start_location_id' => '5',
                'schedule_date' => date('Y-m-d'),
                'departed_1' => 0,
                'departed_2' => 0
            ],
            [
                'boat_id' => '5',
                'schedule_id' => '5',
                'start_location_id' => '1',
                'schedule_date' => date('Y-m-d'),
                'departed_1' => 0,
                'departed_2' => 0
            ],
            [
                'boat_id' => '6',
                'schedule_id' => '6',
                'start_location_id' => '1',
                'schedule_date' => date('Y-m-d'),
                'departed_1' => 0,
                'departed_2' => 0
            ],
            [
                'boat_id' => '7',
                'schedule_id' => '7',
                'start_location_id' => '1',
                'schedule_date' => date('Y-m-d'),
                'departed_1' => 0,
                'departed_2' => 0
            ],
            [
                'boat_id' => '8',
                'schedule_id' => '8',
                'start_location_id' => '1',
                'schedule_date' => date('Y-m-d'),
                'departed_1' => 0,
                'departed_2' => 0
            ],
        ];
        foreach ($data as $row) {
            $this->db->table('trip_schedules')->insert($row);
        }
    }
}

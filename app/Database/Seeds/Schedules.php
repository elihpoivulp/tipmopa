<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Schedules extends Seeder
{
    public function run()
    {
        $data = [
            [
                'itt_start' => '02:00:00',
                'itt_end' => '03:00:00',
                'tti_start' => '10:00:00',
                'tti_end' => '11:00:00',
            ],
            [
                'itt_start' => '03:00:00',
                'itt_end' => '04:00:00',
                'tti_start' => '11:00:00',
                'tti_end' => '12:00:00',
            ],
            [
                'itt_start' => '04:00:00',
                'itt_end' => '05:00:00',
                'tti_start' => '12:00:00',
                'tti_end' => '13:00:00',
            ],
            [
                'itt_start' => '05:00:00',
                'itt_end' => '06:00:00',
                'tti_start' => '13:00:00',
                'tti_end' => '14:00:00',
            ],
            [
                'itt_start' => '08:00:00',
                'itt_end' => '09:00:00',
                'tti_start' => '06:00:00',
                'tti_end' => '07:00:00',
            ],
            [
                'itt_start' => '09:00:00',
                'itt_end' => '10:00:00',
                'tti_start' => '07:00:00',
                'tti_end' => '08:00:00',
            ],
            [
                'itt_start' => '16:00:00',
                'itt_end' => '17:00:00',
                'tti_start' => '08:00:00',
                'tti_end' => '09:00:00',
            ],
            [
                'itt_start' => '17:00:00',
                'itt_end' => '18:00:00',
                'tti_start' => '09:00:00',
                'tti_end' => '10:00:00',
            ],
        ];
        foreach ($data as $row) {
            $this->db->table('schedules')->insert($row);
        }
    }
}

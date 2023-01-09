<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Boats extends Seeder
{
    public function run()
    {
        $data = [
            [
                'boat_name' => 'Jonathan',
                'boat_img' => 'bangka.jpg',
                'license' => '11235',
                'operator_id' => '2',
                'passenger_capacity' => '60',
                'weight_capacity' => '250'
            ],
            [
                'boat_name' => 'Mariluz',
                'boat_img' => 'bangka.jpg',
                'license' => '11236',
                'operator_id' => '2',
                'passenger_capacity' => '60',
                'weight_capacity' => '250'
            ],
            [
                'boat_name' => 'Lowell',
                'boat_img' => 'bangka.jpg',
                'license' => '11234',
                'operator_id' => '2',
                'passenger_capacity' => '60',
                'weight_capacity' => '250'
            ],
            [
                'boat_name' => 'King Louie',
                'boat_img' => 'bangka.jpg',
                'license' => '11237',
                'operator_id' => '2',
                'passenger_capacity' => '60',
                'weight_capacity' => '250'
            ],
            [
                'boat_name' => 'B1',
                'boat_img' => 'bangka.jpg',
                'license' => '11238',
                'operator_id' => '2',
                'passenger_capacity' => '60',
                'weight_capacity' => '250'
            ],
            [
                'boat_name' => 'B2',
                'boat_img' => 'bangka.jpg',
                'license' => '11239',
                'operator_id' => '2',
                'passenger_capacity' => '60',
                'weight_capacity' => '250'
            ],
            [
                'boat_name' => 'B3',
                'boat_img' => 'bangka.jpg',
                'license' => '11240',
                'operator_id' => '2',
                'passenger_capacity' => '60',
                'weight_capacity' => '250'
            ],
            [
                'boat_name' => 'B4',
                'boat_img' => 'bangka.jpg',
                'license' => '11241',
                'operator_id' => '2',
                'passenger_capacity' => '60',
                'weight_capacity' => '250'
            ],
        ];
        foreach ($data as $row) {
            $this->db->table('boats')->insert($row);
        }
    }
}

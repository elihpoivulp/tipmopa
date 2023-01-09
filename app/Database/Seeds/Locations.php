<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Locations extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Terminal',
                'is_terminal' => '1',
            ],
            [
                'name' => 'Kalinawan',
                'is_terminal' => '0',
                'fare_price_in_peso' => '30',
                'fare_discount_in_peso' => '25'
            ],
            [
                'name' => 'Pipindan',
                'is_terminal' => '0',
                'fare_price_in_peso' => '30',
                'fare_discount_in_peso' => '25'
            ],
            [
                'name' => 'Navotas',
                'is_terminal' => '0',
                'fare_price_in_peso' => '40',
                'fare_discount_in_peso' => '35'
            ],
            [
                'name' => 'Ticulio',
                'is_terminal' => '0',
                'fare_price_in_peso' => '40',
                'fare_discount_in_peso' => '35'
            ]
        ];
        foreach ($data as $row) {
            $this->db->table('locations')->insert($row);
        }
    }
}

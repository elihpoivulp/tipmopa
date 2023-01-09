<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Ramcel Gamboa',
                'email' => 'ramcel@gamboa.com',
                'address' => 'Neverland, Morong, Rizal',
                'gender' => 'f',
                'weight' => '10.00',
                'height' => '5.5',
                'age' => '20',
                'contact_number' => '09156556556',
                'gcash_account_number' => '09156556556',
                'gcash_account_name' => 'Ramcel Gamboa',
                'emergency_contact_person' => 'My Mother',
                'emergency_contact_person_contact_number' => '09156556556',
                'password' => '$2y$10$Ek2FPbnaL5sCbFobXjUmeOkjQWzPe2ARg.m4UQUBWHK8TK7jRmc5m',
                'role' => 1
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@operator.com',
                'address' => 'Neverland, Morong, Rizal',
                'gender' => 'm',
                'weight' => '10.00',
                'height' => '5.5',
                'age' => '20',
                'contact_number' => '09156556556',
                'gcash_account_number' => '09156556556',
                'gcash_account_name' => 'John Doe',
                'emergency_contact_person' => 'My Mother',
                'emergency_contact_person_contact_number' => '09156556556',
                'password' => '$2y$10$Ek2FPbnaL5sCbFobXjUmeOkjQWzPe2ARg.m4UQUBWHK8TK7jRmc5m',
                'role' => 2
            ],
            [
                'name' => 'john Doe',
                'email' => 'john@doe.com',
                'address' => 'Neverland, Morong, Rizal',
                'gender' => 'm',
                'weight' => '10.00',
                'height' => '5.5',
                'age' => '20',
                'contact_number' => '09156556556',
                'gcash_account_number' => '09156556556',
                'gcash_account_name' => 'John Doe',
                'emergency_contact_person' => 'My Mother',
                'emergency_contact_person_contact_number' => '09156556556',
                'password' => '$2y$10$Ek2FPbnaL5sCbFobXjUmeOkjQWzPe2ARg.m4UQUBWHK8TK7jRmc5m',
            ],
        ];
        foreach ($data as $row) {
            $this->db->table('users')->insert($row);
        }
    }
}

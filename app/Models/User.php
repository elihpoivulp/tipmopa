<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;
use Faker\Generator;

class User extends Model
{
    protected $table = 'users';
    protected $allowedFields = [
        'name',
        'email',
        'address',
        'gender',
        'weight',
        'height',
        'age',
        'contact_number',
        'gcash_account_number',
        'gcash_account_name',
        'emergency_contact_person',
        'emergency_contact_person_contact_number',
        'password',
        'role',
        'updated_at'
    ];

    public function get_accounting_account()
    {
        return $this->select('gcash_account_name as name, gcash_account_number as number')->where('role', '1')->first();
    }

    /**
     * @throws Exception
     */
    public function fake(Generator &$faker): array
    {
        $data = [
            'name' => $faker->firstName . ' ' . $faker->lastName,
            'email'  => $faker->email,
            'address'  => $faker->address,
            'gender'   => $faker->randomElement(['M', 'F']),
            'weight' => $faker->randomFloat(2, 20, 100),
            'height' => $faker->randomFloat(2, 20, 200),
            'age' => $faker->numberBetween(10, 100),
            'contact_number' => $faker->regexify('09[0-9]{9}'),
            'gcash_account_number' => $faker->regexify('09[0-9]{9}'),
            'gcash_account_name' => $faker->firstName . ' ' . $faker->lastName,
            'emergency_contact_person' => $faker->firstName . ' ' . $faker->lastName,
            'emergency_contact_person_contact_number' => $faker->regexify('09[0-9]{9}'),
            'password' => '$2y$10$Ek2FPbnaL5sCbFobXjUmeOkjQWzPe2ARg.m4UQUBWHK8TK7jRmc5m',
            'role' => 3,
        ];
        $this->save($data);
        return $data;
    }
}

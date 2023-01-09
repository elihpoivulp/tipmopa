<?php

namespace App\Models;

use CodeIgniter\Model;

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
}

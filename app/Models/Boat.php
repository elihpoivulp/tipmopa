<?php

namespace App\Models;

use CodeIgniter\Model;

class Boat extends Model
{
    protected $allowedFields = ['boat_name', 'boat_img', 'license', 'operator_id', 'passenger_capacity', 'weight_capacity'];

    protected $table = 'boats';
}

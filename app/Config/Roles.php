<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Roles extends BaseConfig
{
    public $roles = [
      1 => 'Admin',
      2 => 'Boat_Operator',
      3 => 'Customer'
    ];

    public $role_uri_assignments = [
        1 => 'admin-dashboard',
        2 => 'operator-dashboard',
        3 => 'customer-dashboard'
    ];
}

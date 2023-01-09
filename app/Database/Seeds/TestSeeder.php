<?php

namespace App\Database\Seeds;

use App\Controllers\Logout;
use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        $this->call(User::class);
        $this->call(Boats::class);
        $this->call(Locations::class);
        $this->call(Schedules::class);
        $this->call(TripSchedules::class);
    }
}

<?php

namespace App\Controllers;

use App\Models\Reservation;
use App\Models\TripSchedule;
use App\Models\User;
use CodeIgniter\Test\Fabricator;

class GenerateTestData extends BaseController
{
    public function index()
    {
        $this->generate_users();
        $this->generate_schedules();
        $this->generate_reservations();
    }

    private function generate_users()
    {
        $f = new Fabricator(User::class);
        $f->make(10);
    }

    private function generate_reservations()
    {
        $f = new Fabricator(Reservation::class);
        $f->make(10);

    }

    private function generate_schedules()
    {
        $f = new Fabricator(TripSchedule::class);
        $f->make();
    }
}

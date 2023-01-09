<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\TripSchedule;

class Admin extends BaseController
{
    public function index()
    {
        $trip_schedule_model = model(TripSchedule::class);
        $reservation_model = model(Reservation::class);
        $location_model = model(Location::class)->findAll();
        $upcoming = $trip_schedule_model->get_upcoming();
        $itt = $trip_schedule_model->get_scheduled_today();
        $tti = $trip_schedule_model->get_scheduled_today(1);
        $reservations = $reservation_model->get_customer_reservations();
        return view('includes/page-header') .
            $this->get_heading() .
            view('includes/sidebar') .
            view('account/customer/dashboard', [
                'scheduled' => $upcoming,
                'itt' => $itt,
                'tti' => $tti,
                'locations' => $location_model,
                'reservations' => $reservations,
                'reservation_columns' => array_column($reservations, 'schedule_id')
            ]) .
            view('includes/footer');
    }
}

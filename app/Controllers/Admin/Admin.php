<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\TripSchedule;

class Admin extends BaseController
{
    public function index(): string
    {
        $reservation_model = model(Reservation::class);
        $trip_schedule_model = model(TripSchedule::class);
        $itt = $trip_schedule_model->get_scheduled_today();
        $tti = $trip_schedule_model->get_scheduled_today(1);
        $total_sales_today = $reservation_model->get_total_sales();
        $total_customers_today = $reservation_model->get_total_customers();
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/admin/dashboard', [
                'itt' => $itt,
                'tti' => $tti,
                'total_sales_today' => $total_sales_today['total'],
                'total_customers_today' => $total_customers_today['total']
            ]) .
            view('includes/footer');
    }
}

<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\TripSchedule;

class Schedules extends BaseController
{
    public function index(): string
    {
        $trip_schedule_model = model(TripSchedule::class);
        if ($this->request->getGet('all_time')) {
            $itt = $trip_schedule_model->get_customer_schedules(session()->get('id'));
            $tti = $trip_schedule_model->get_customer_schedules(session()->get('id'), 1);
            $filtered = true;
        } else {
            $itt = $trip_schedule_model->get_customer_scheduled_today(session()->get('id'));
            $tti = $trip_schedule_model->get_customer_scheduled_today(session()->get('id'), 1);
            $filtered = false;
        }
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/customer/schedules', [
                'itt' => $itt,
                'tti' => $tti,
                'filtered' => $filtered
            ]) .
            view('includes/footer');
    }
}

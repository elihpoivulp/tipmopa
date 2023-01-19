<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Boat;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\SailingBoat;
use App\Models\TripSchedule;

class Customer extends BaseController
{
    public function index(): string
    {
        $trip_schedule_model = model(TripSchedule::class);
        $reservation_model = model(Reservation::class);
        $location_model = model(Location::class)->findAll();
        $upcoming = $trip_schedule_model->get_upcoming();
        $itt = $trip_schedule_model->get_scheduled_today();
        $tti = $trip_schedule_model->get_scheduled_today(1);
        $reservations = $reservation_model->get_customer_reservations();
        $my_upcoming = $trip_schedule_model->get_upcoming(session()->get('id'), true);
        $minutes = 9999999;
        if ($my_upcoming) {
            $minutes = get_time_diff(strtotime($my_upcoming[$my_upcoming['origin'] ? 'tti_start' : 'itt_start']));
        }
        $journey = $this->get_journey_view();
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/customer/dashboard', [
                'scheduled' => $upcoming,
                'my_upcoming' => $my_upcoming,
                'minutes' => $minutes,
                'itt' => $itt,
                'tti' => $tti,
                'locations' => $location_model,
                'reservations' => $reservations,
                'reservation_columns' => array_column($reservations, 'schedule_id'),
                'journey' => $journey
            ]) .
            view('includes/footer');
    }

    public function get_journey_view(): string
    {
        $journey = '';
        if (session()->has('reservation_data') && (session()->has('sailing')) && session()->get('sailing') == 1) {
            $reserve_data = session()->get('reservation_data');
            $sail_data = model(SailingBoat::class)->where('trip_schedule_id', $reserve_data['trip_schedule_id'])->first();
            $location_model = model(Location::class);
            $a = explode(',', rtrim($sail_data['location_points_arrival_sequence'] ?? '', ','));
            if (count($a) < 4) {
                for ($i = count($a); $i < 4; $i++) {
                    $a[] = null;
                }
            }
            $trip_schedule_id = $reserve_data['trip_schedule_id'];
            $locations = $location_model->get_destination_locations($trip_schedule_id);
            $started_at = $location_model->get_starting_point($trip_schedule_id);
            $journey = view('includes/sailing_journey', [
                'locations' => $locations,
                'started_at' => $started_at,
                'sailing_data' => $sail_data,
                'date_arrival_assignment' => array_combine($a, ['point_a_date_arrived', 'point_b_date_arrived', 'point_c_date_arrived', 'last_point_date_arrived'])
            ]);
        }
        return $journey;
    }
}

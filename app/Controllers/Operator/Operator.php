<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Location;
use App\Models\Reservation;
use App\Models\TripSchedule;
use CodeIgniter\Database\RawSql;

class Operator extends BaseController
{
    public function index(): string
    {
        $reservation_model = model(Reservation::class);
        $trip_schedule_model = model(TripSchedule::class);
        $upcoming = $trip_schedule_model->get_upcoming(session()->get('id'));
        $minutes = 9999999;
        if ($upcoming) {
            $minutes = get_time_diff(strtotime($upcoming[$upcoming['origin'] ? 'tti_start' : 'itt_start']));
        }
        $journey = $this->get_journey_view();
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/operator/dashboard', [
                'reservations' => $reservation_model->get_operator_reservations(),
                'upcoming' => $upcoming,
                'minutes' => $minutes,
                'journey' => $journey ?? ''
            ]) .
            view('includes/footer');
    }

    /**
     * @return string
     */
    public function get_journey_view(): string
    {
        $journey = '';
        if (session()->has('sailing') && session()->get('sailing') === true) {
            $location_model = model(Location::class);
            $sail_data = session()->get('sailing_boat_data');
            $a = explode(',', rtrim($sail_data['location_points_arrival_sequence'] ?? '', ','));
            if (count($a) < 4) {
                for ($i = count($a); $i < 4; $i++) {
                    $a[] = null;
                }
            }
            $trip_schedule_id = $sail_data['trip_schedule_id'];
            if ($sail_data['depart_type'] == 1) {
                $started_at = $location_model->get_starting_point(1);
            } else {
                $started_at = $location_model->get_starting_point($trip_schedule_id);
            }
            $locations = $location_model->get_destination_locations($trip_schedule_id);
            $journey = view('includes/sailing_journey', [
                'locations' => $locations,
                'started_at' => $started_at,
                'sailing_data' => $sail_data,
                'date_arrival_assignment' => array_combine($a, ['point_a_date_arrived', 'point_b_date_arrived', 'point_c_date_arrived', 'last_point_date_arrived']),
                'operator' => true
            ]);
        }
        return $journey;
    }
}

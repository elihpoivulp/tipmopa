<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Reservation;
use App\Models\SailingBoat;
use App\Models\TripSchedule;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class Schedules extends BaseController
{
    private SailingBoat $sailing_boat;

    public function __construct()
    {
        $this->sailing_boat = model(SailingBoat::class);
    }

    public function index()
    {
        //
    }

    public function set_status(): RedirectResponse
    {
        $status = $this->request->getPost('status');
        $id = $this->request->getPost('id');
        $operator_id = session()->get('id');
        $column = $this->request->getPost('depart_type');
        $trip_schedule_model = model(TripSchedule::class);
        $trip_schedule_model->set_status($id, $status, $column);
        try {
            $this->sailing_boat->save(['trip_schedule_id' => $id, 'depart_type' => $column === 'departed_1' ? '1' : '2']);
        } catch (ReflectionException $e) {
            exit($e->getMessage());
        }
        return redirect()->back();
    }

    public function set_arrived(): RedirectResponse
    {
        $location_id = $this->request->getGet('location_id');
        $sail_id = $this->request->getGet('sail_id');
        try {
            $sail_data = $this->sailing_boat->find($sail_id);
            $points = ['a', 'b', 'c', 'x'];
            $point = is_null($sail_data['location_points_arrival_sequence']) ? 0 : count(explode(',', rtrim($sail_data['location_points_arrival_sequence'] ?? '', ',')));
            $point_key = 'point_' . $points[$point] . '_date_arrived';
            $trip_schedule_id = $sail_data['trip_schedule_id'];
            $reservation_model = model(Reservation::class);
            if ($point == 3) {
                $point_key = 'last_point_date_arrived';
                $this->notification->create_notification(
                    session()->get('id'),
                    'Schedule has been fulfilled.',
                    0,
                    'reservation-fulfilled'
                );
                model(TripSchedule::class)->update($trip_schedule_id, [session()->get('sailing_boat_data')['depart_type'] == 1 ? 'departed_1' : 'departed_2' => 1]);
            }
            $update_data = [
                'location_points_arrival_sequence' => $sail_data['location_points_arrival_sequence'] . $location_id . ',',
                $point_key => date('Y-m-d H:i:s')
            ];
            $this->sailing_boat->update($sail_id, $update_data);
            $users = $reservation_model->select('user_id, reference_no')
                ->where('trip_schedule_id', $trip_schedule_id)
                ->where('destination', $location_id)
                ->findAll();
            foreach ($users as $user) {
                $this->notification->create_notification(
                    $user['user_id'],
                    'You have arrived',
                    $user['reference_no'],
                    'reservation-fulfilled'
                );
            }
            $user_ids = array_column($users, 'user_id');
            if (!empty($user_ids)) {
                $updated = $reservation_model->set([
                    'fulfilled' => 1,
                    'date_fulfilled' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ])->whereIn('user_id', $user_ids)->update();
            }
        } catch (ReflectionException $e) {
            exit($e->getMessage());
        }
        return redirect()->back();
    }
}

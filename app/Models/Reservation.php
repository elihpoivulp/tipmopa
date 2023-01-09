<?php

namespace App\Models;

use CodeIgniter\Model;
use ReflectionException;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $allowedFields = [
        'reference_no',
        'accepted',
        'fulfilled',
        'boarded',
        'cancelled',
        'updated_at',
        'receipt_img',
        'date_refunded',
        'created_at',
        'destination',
        'origin',
        'user_id',
        'date_cancelled',
        'payment',
        'date_accepted',
        'date_fulfilled',
        'trip_schedule_id',
        'refunded',
        'date_boarded',
    ];

    private string $select_string = '
           reservations.id as reservation_id,
           reservations.*,
           l.name as destination,
           ll.name as origin,
           ts.departed_1,
           ts.departed_2,
           ts.schedule_date,
           b.boat_name,
           b.license,
           b.boat_img,
           s.id as schedule_id,
           s.itt_start,
           s.itt_end,
           s.tti_start,
           s.tti_end';

    public function get_customer_reservations($user_id = null, $date = null): array
    {
        if (is_null($user_id)) {
            $user_id = session()->get('id');
        }
        if (is_null($date)) {
            $date = date('Y-m-d');
        }
        return $this->select($this->select_string)
            ->join('locations l', 'l.id = reservations.destination')
            ->join('locations ll', 'll.id = reservations.origin')
            ->join('trip_schedules ts', 'ts.id = reservations.trip_schedule_id')
            ->join('boats b', 'b.id = ts.boat_id')
            ->join('schedules s', 's.id = ts.schedule_id')
            ->where('reservations.user_id', $user_id)
            ->orderBy('reservations.id', 'desc')
            ->findAll();
    }

    public function get_operator_reservations($user_id = null, $date = null): array
    {
        if (is_null($user_id)) {
            $user_id = session()->get('id');
        }
        if (is_null($date)) {
            $date = date('Y-m-d');
        }
        return $this->select($this->select_string . ', c.name as customer, c.id as customer_id')
            ->join('locations l', 'l.id = reservations.destination')
            ->join('locations ll', 'll.id = reservations.origin')
            ->join('trip_schedules ts', 'ts.id = reservations.trip_schedule_id')
            ->join('boats b', 'b.id = ts.boat_id')
            ->join('schedules s', 's.id = ts.schedule_id')
            ->join('users u', 'u.id = b.operator_id')
            ->join('users c', 'c.id = reservations.user_id')
            ->where('u.id', $user_id)
            ->where('reservations.accepted', 0)
            ->orderBy('reservations.id', 'asc')
            ->findAll();
    }

    public function accept_reservation($id): bool
    {
        try {
            return $this->update($id, ['accepted' => 1, 'date_accepted' => date('Y-m-d H:i:s')]);
        } catch (ReflectionException $e) {
            return false;
        }
    }

    public function make_reservation($data)
    {
        if ($this->still_has_slot($data['trip_schedule_id'])) {
            try {
                return $this->save($data);
            } catch (ReflectionException $e) {
                return false;
            }
        } else {
            return [
                'error' => true,
                'message' => 'No more slots available. Either your weight exceeds the weight capacity or all slots have been accommodated.'
            ];
        }
    }

    public function get_slot_information(int $id): array
    {
        return $this->selectCount('reservations.id', 'slots_taken')
            ->selectSum('u.weight', 'total_weight')
            ->select('passenger_capacity as available_slots')
            ->select('weight_capacity as available_weight')
            ->join('trip_schedules ts', 'ts.id = reservations.trip_schedule_id')
            ->join('boats b', 'b.id = ts.boat_id')
            ->join('users u', 'u.id = reservations.user_id')
            ->where('reservations.trip_schedule_id', intval($id))
            ->first();
    }

    public function still_has_slot($id): bool
    {
        if ($result = $this->get_slot_information($id)) {
            return $result['slots_taken'] < $result['available_slots']
                &&
                $result['total_weight'] < $result['available_weight'];
        }
        return true;
    }

    public function set_reservation_status($id, $column, $status): bool
    {
        try {
            return $this->update($id, [$column => $status]);
        } catch (ReflectionException $e) {
            return false;
        }
    }
}

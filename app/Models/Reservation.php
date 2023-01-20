<?php

namespace App\Models;

use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;
use CodeIgniter\Test\Fabricator;
use Exception;
use Faker\Generator;
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

    public function get_all_reservations($today = true): array
    {
        $query = $this->select($this->select_string . ', u.name as customer_name')
            ->join('locations l', 'l.id = reservations.destination')
            ->join('locations ll', 'll.id = reservations.origin')
            ->join('trip_schedules ts', 'ts.id = reservations.trip_schedule_id')
            ->join('boats b', 'b.id = ts.boat_id')
            ->join('schedules s', 's.id = ts.schedule_id')
            ->join('users u', 'u.id = reservations.user_id')
            ->orderBy('reservations.id', 'desc');
            if ($today) {
                $query->where('date(reservations.created_at) = ', date('Y-m-d'));
            }
            return $query->findAll();
    }

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
            ->where('date(reservations.created_at) = ', $date)
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
            ->where('date(reservations.created_at) = ', $date)
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

    public function get_total_sales($today = true, $id = null)
    {
        $query = $this->selectSum('payment', 'total');
        if ($id) {
            $query->join('trip_schedules ts', 'ts.id = reservations.trip_schedule_id')
                ->join('boats b', 'b.id = ts.boat_id')
                ->join('users u', 'u.id = b.operator_id')
                ->where('u.id', $id);
        }
        if ($today) {
            $query->where('date(date_accepted) =', date('Y-m-d'));
        }
        return $query->first();
    }

    public function get_total_customers($today = true, $id = null)
    {
        $query = $this->selectCount('id', 'total');
        if ($id) {
            $query->join('trip_schedules ts', 'ts.id = reservations.trip_schedule_id')
                ->join('boats b', 'b.id = ts.boat_id')
                ->join('users u', 'u.id = b.operator_id')
                ->where('u.id', $id);
        }
        if ($today) {
            $query->where('date(created_at) =', date('Y-m-d'));
        }
        return $query->first();
    }

    public function get_travel_history($id = null): array
    {
        $sql = 'reservations.reference_no, u.name, b.boat_name, ts.schedule_date as schedule_date';
        $sql .= new RawSql(', (select name from locations where id = reservations.origin) as origin');
        $sql .= new RawSql(', (select name from locations where id = reservations.destination) as destination');
        $sql .= new RawSql(', if(reservations.origin = 1, concat(s.tti_start, \'-\', s.tti_end), concat(s.itt_start, \'-\', s.itt_end)) as time
        ');
        $query = $this->select($sql)
            ->join('users u', 'reservations.user_id = u.id')
            ->join('trip_schedules ts', 'reservations.trip_schedule_id = ts.id')
            ->join('boats b', 'ts.boat_id = b.id')
            ->join('schedules s', 's.id = ts.schedule_id');
        if (!is_null($id)) {
            $query->where('u.id', $id);
        }
        $query->where('reservations.fulfilled', 1);
        $query->orderBy('ts.schedule_date', 'desc');
        return $query->findAll();
    }

    /**
     * @throws Exception
     */
    public function fake(Generator &$faker): array
    {
        $price_per_location = [
            2 => 30,
            3 => 30,
            4 => 40,
            5 => 40,
        ];
        $inserted = [];
        $user_id = random_int(1, \model(User::class)->countAllResults());
        $trip_schedules_model = \model(TripSchedule::class);
        for ($i = 1; $i <= $trip_schedules_model->countAllResults(); $i++) {
            $schedule = $trip_schedules_model->find($i);
            if ($schedule['schedule_date'] != date('Y-m-d')) {
                $parent_schedule = \model(Schedule::class)->find($schedule['schedule_id']);
                $start_id = $schedule['start_location_id'];
                $origin = 1;
                $reference = make_reference();
                $destination = mt_rand(2, 5);
                $payment = $price_per_location[$destination];
                $time_start = $parent_schedule['tti_start'];
                $time_end = $parent_schedule['tti_end'];
                if ($start_id > 1) {
                    $origin = mt_rand(2, 5);
                    $destination = 1;
                    $payment = $price_per_location[$origin];
                    $time_start = $parent_schedule['itt_start'];
                    $time_end = $parent_schedule['itt_end'];
                }
                $date_start = $schedule['schedule_date'] . ' ' . $time_start;
                $date_end = $schedule['schedule_date'] . ' ' . $time_end;
                $img = '1673581108_b3ed7b7bacc2af55ae8a.jpg';
                $data = [
                    'reference_no' => $reference,
                    'accepted' => 1,
                    'fulfilled' => 1,
                    'boarded' => 1,
                    'cancelled' => 0,
                    'updated_at' => $date_end,
                    'receipt_img' => $img,
                    'date_refunded' => null,
                    'created_at' => $date_start,
                    'destination' => $destination,
                    'origin' => $origin,
                    'user_id' => $user_id,
                    'date_cancelled' => null,
                    'payment' => $payment,
                    'date_accepted' => $date_start,
                    'date_fulfilled' => $date_end,
                    'trip_schedule_id' => $i,
                    'refunded' => 0,
                    'date_boarded' => $date_start,
                ];
                $this->save($data);
                $inserted[] = $data;
            }
        }
       return $inserted;
    }
}

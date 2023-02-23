<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Database\RawSql;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;
use Exception;
use Faker\Generator;
use ReflectionException;

class TripSchedule extends Model
{
    protected $allowedFields = [
        'boat_id',
        'schedule_id',
        'start_location_id',
        'departed_1',
        'departed_2',
        'schedule_date'
    ];

    protected $table = 'trip_schedules';

    private string $select_string = "
        trip_schedules.id as schedule_id,
        trip_schedules.schedule_date,
        trip_schedules.departed_1,
        trip_schedules.departed_2,
        trip_schedules.start_location_id,
        b.id as boat_id,
        b.boat_name,
        b.license,
        b.boat_img,
        s.itt_start,
        s.itt_end,
        s.tti_start,
        s.tti_end,
        u.name as operator,
        u.id as operator_id, ";

    public function __construct(?ConnectionInterface $db = null, ?ValidationInterface $validation = null)
    {
        parent::__construct($db, $validation);
        $this->select_string .= new RawSql(", if(abs(s.itt_start - time(now())) < abs(s.tti_start - time(now())), 0, 1) origin");
        // $this->select_string .= new RawSql(", if(now() <= concat(date_add(now(), interval 1 day), ' 01:59:59'), 1, 0) for_tomorrow");
    }

    public function get_scheduled_today($to_terminal = 0, $id = null): array
    {
        $order = 's.itt_start';
        if ($to_terminal) {
            $order = 's.tti_start';
        }
        $select = $this->select_string;
        $select .= new RawSql(', if(start_location_id = 1, "Terminal", l.name) as origin_location');
        $select .= new RawSql(', if(start_location_id != 1, "Terminal", "Isla") as destination_location');
        $q = $this->select($select)
            ->join('boats b', 'b.id = trip_schedules.boat_id')
            ->join('schedules s', 's.id = trip_schedules.schedule_id')
            ->join('locations l', 'l.id = start_location_id')
            ->join('users u', 'u.id = b.operator_id')
            ->where('trip_schedules.schedule_date', date('Y-m-d'))
            ->orderBy($order);
        if ($id) {
            $q->where('b.operator_id', $id);
        }
        return $q->findAll();
    }
    public function get_customer_scheduled_today($id, $to_terminal = 0): array
    {
        $order = 's.itt_start';
        if ($to_terminal) {
            $order = 's.tti_start';
        }
        $select = $this->select_string;
        $select .= new RawSql(', if(start_location_id = 1, "Terminal", l.name) as origin_location');
        $select .= new RawSql(', if(start_location_id != 1, "Terminal", "Isla") as destination_location');
        return $this->select($select)
            ->join('boats b', 'b.id = trip_schedules.boat_id')
            ->join('schedules s', 's.id = trip_schedules.schedule_id')
            ->join('locations l', 'l.id = start_location_id')
            ->join('users u', 'u.id = b.operator_id')
            ->join('reservations r', 'r.trip_schedule_id = trip_schedules.id')
            ->where('trip_schedules.schedule_date', date('Y-m-d'))
            ->where('r.user_id', $id)
            ->orderBy($order)->findAll();
    }

    public function get_schedule_info_for_booking($schedule_id): array
    {
        $select = $this->select_string;
        $select .= ', u.contact_number, u.gcash_account_number, u.gcash_account_name, b.passenger_capacity, b.weight_capacity';
        return $this->select($select)
            ->join('boats b', 'b.id = trip_schedules.boat_id')
            ->join('schedules s', 's.id = trip_schedules.schedule_id')
            ->join('locations l', 'l.id = trip_schedules.start_location_id')
            ->join('users u', 'u.id = b.operator_id')
            ->where('trip_schedules.id', $schedule_id)
            ->first();
    }

    public function get_schedules($to_terminal = 0, $today = false, $id = null): array
    {
        if ($today) {
            return $this->get_scheduled_today($to_terminal, $id);
        }
        $order = 's.itt_start';
        if ($to_terminal) {
            $order = 's.tti_start';
        }
        $select = $this->select_string;
        $select .= new RawSql(', if(start_location_id = 1, "Terminal", l.name) as origin_location');
        $select .= new RawSql(', if(start_location_id = 1, "Isla", "Terminal") as destination_location');
        $q = $this->select($select)
            ->join('boats b', 'b.id = trip_schedules.boat_id')
            ->join('schedules s', 's.id = trip_schedules.schedule_id')
            ->join('locations l', 'l.id = start_location_id')
            ->join('users u', 'u.id = b.operator_id')
            ->orderBy($order);
        if ($id) {
            $q->where('b.operator_id', $id);
        }
        return $q->findAll();
    }
    public function get_customer_schedules($id, $to_terminal = 0, $today = false): array
    {
        if ($today) {
            return $this->get_customer_scheduled_today($to_terminal, $id);
        }
        $order = 's.itt_start';
        if ($to_terminal) {
            $order = 's.tti_start';
        }
        $select = $this->select_string;
        $select .= new RawSql(', if(start_location_id = 1, "Terminal", l.name) as origin_location');
        $select .= new RawSql(', if(start_location_id = 1, "Isla", "Terminal") as destination_location');
        return $this->select($select)
            ->join('boats b', 'b.id = trip_schedules.boat_id')
            ->join('schedules s', 's.id = trip_schedules.schedule_id')
            ->join('locations l', 'l.id = start_location_id')
            ->join('users u', 'u.id = b.operator_id')
            ->join('reservations r', 'r.trip_schedule_id = trip_schedules.id')
            ->where('r.user_id', $id)
            ->orderBy($order)->findAll();
    }

    public function get_upcoming($id = null, $customer = false): ?array
    {
        $result = $this->_get_upcoming($customer);
        if (!is_null($id)) {
            if ($customer) {
                $result->join('reservations r', 'r.trip_schedule_id = trip_schedules.id')
                    ->join('users c', 'c.id = r.user_id')
                    ->where('c.id', $id)
                    ->where('r.fulfilled', '0');
            } else {
                $result->where('b.operator_id', $id);
            }
            return $result->first();
        }
        return $result->findAll();
    }

    private function _get_upcoming($customer = false): TripSchedule
    {
        $where = new RawSql("if(abs(s.itt_start - time(now())) < abs(s.tti_start - time(now())), abs(s.itt_start - time(now())) < 10000 and departed_2 = 0 and trip_schedules.schedule_date = date(now()), abs(s.tti_start - time(now())) < 10000 and departed_1 = 0 and trip_schedules.schedule_date = date(now()))");
        // $where = new RawSql("if((now() <= concat(date_add(now(), interval 1 day), ' 01:59:59')), trip_schedules.schedule_date = date_add(date(now()), interval 1 day) and s.itt_start = '02:00:00' and trip_schedules.departed_1 = 0, if(abs(s.itt_start - time(now())) < abs(s.tti_start - time(now())), abs(s.itt_start - time(now())) < 10000 and departed_2 = 0 and trip_schedules.schedule_date = date(now()), abs(s.tti_start - time(now())) < 10000 and departed_1 = 0 and trip_schedules.schedule_date = date(now())))");
        if ($customer) {
            $this->select_string .= ', c.name as customer_name, r.id as reservation_id, r.boarded, r.accepted';
        }
        return $this->select($this->select_string)
            ->join('boats b', 'b.id = trip_schedules.boat_id')
            ->join('schedules s', 's.id = trip_schedules.schedule_id')
            ->join('users u', 'u.id = b.operator_id')
            // ->where('trip_schedules.schedule_date', date('Y-m-d'))
            ->where($where);
    }

    public function set_status($id, $status, $column): bool
    {
        try {
            return $this->update($id, [$column => $status]);
        } catch (ReflectionException $e) {
            return false;
        }
    }

    /**
     * @throws Exception
     */
    public function fake(Generator &$faker): array
    {
        $data = [
            [1, 1, 2],
            [2, 2, 3],
            [3, 3, 4],
            [4, 4, 5],
            [5, 5, 1],
            [6, 6, 1],
            [7, 7, 1],
            [8, 8, 1],
        ];
        $inserted = [];
        for ($i = 1; $i < date('d'); $i++) {
            foreach ($data as $row) {
                $record = [
                    'boat_id' => $row[0],
                    'schedule_id' => $row[1],
                    'start_location_id' => $row[2],
                    'departed_1' => 1,
                    'departed_2' => 1,
                    'schedule_date' => '2023-01-' . sprintf('%02d', $i)
                ];
                $inserted[] = $record;
                $this->save($record);
            }
        }

        return $inserted;
    }

    public function get_future_dates_with_schedule(): array
    {
        return $this->select('schedule_date')
            ->where('schedule_date >=', date('Y-m-d'))
            ->groupBy('schedule_date')
            ->orderBy('schedule_date', 'asc')
            ->findAll();
    }
}

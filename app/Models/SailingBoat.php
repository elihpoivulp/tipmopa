<?php

namespace App\Models;

use CodeIgniter\Model;

class SailingBoat extends Model
{
    protected $table = 'sailing_boats';
    protected $allowedFields = [
        'trip_schedule_id',
        'origin_id',
        'location_points_arrival_sequence',
        'date_departed',
        'point_a_date_arrived',
        'point_b_date_arrived',
        'point_c_date_arrived',
        'last_point_date_arrived'
    ];

    public function check_if_sailing($id = null): ?array
    {
        if (is_null($id)) {
            $id = session()->get('id');
        }
        return $this->select('sailing_boats.*')
            ->join('trip_schedules ts', 'ts.id = sailing_boats.trip_schedule_id')
            ->join('boats b', 'b.id = ts.boat_id')
            ->join('users u', 'u.id = b.operator_id')
            ->where('u.id', $id)
            ->where('sailing_boats.last_point_date_arrived', null)
            ->first();
    }
}

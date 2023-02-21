<?php

namespace App\Models;

use CodeIgniter\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    public function get_sched_id($type, $time, $date)
    {
        return $this->select('ts.id')
            ->join('trip_schedules ts', 'ts.schedule_id = schedules.id')
            ->where('schedules.' . $type . '_start', $time)
            ->where('ts.schedule_date', $date)
            ->first();
    }
}

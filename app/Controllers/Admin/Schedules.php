<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TripSchedule;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use ReflectionException;

class Schedules extends BaseController
{
    private const types = ['today', 'range'];

    private bool $has_schedule = false;

    private ?TripSchedule $trip_schedule_model = null;

    public function __construct()
    {
        $this->trip_schedule_model = model(TripSchedule::class);
        $this->has_schedule = $this->trip_schedule_model->where('schedule_date', date('Y-m-d'))->countAllResults() > 0;
    }

    public function index(): string
    {
        $trip_schedule_model = $this->trip_schedule_model;
        if ($this->request->getGet('all_time')) {
            $itt = $trip_schedule_model->get_schedules();
            $tti = $trip_schedule_model->get_schedules(1);
            $filtered = true;
        } else {
            $itt = $trip_schedule_model->get_scheduled_today();
            $tti = $trip_schedule_model->get_scheduled_today(1);
            $filtered = false;
        }
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/admin/schedules', [
                'itt' => $itt,
                'tti' => $tti,
                'filtered' => $filtered
            ]) .
            view('includes/footer');
    }

    public function generate_schedule(): string
    {
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/admin/generate-schedule', [
                'has_schedule' => $this->has_schedule
            ]) .
            view('includes/footer');
    }

    public function generate()
    {
        $type = $this->request->getPost('type');
        if (!in_array($type, self::types)) {
            throw new PageNotFoundException();
        }
        $method = 'generate_' . strtolower($type);
        return $this->$method();
    }

    private function generate_today(): RedirectResponse
    {
        if ($this->has_schedule) {
            return redirect()->back()->with('message', 'There\'s already a schedule for today.')->with('status', 'warning');
        }
        try {
            $this->trip_schedule_model->insertBatch(get_ts_init_data());
        } catch (ReflectionException $e) {
            return redirect()->back()->with('message', 'Fail to create schedule.')->with('status', 'warning');
        }
        return redirect()->back()->with('message', 'Schedule created.')->with('status', 'success');
    }

    private function generate_range(): RedirectResponse
    {
        $start = $this->request->getPost('start_date');
        $end = date('Y-m-d', strtotime($this->request->getPost('end_date') . ' +1 day'));
        $today = date('Y-m-d');
        if ($start == $today || $end == $today || ($start > $end) || ($this->trip_schedule_model->where('schedule_date ', $start)->where('schedule_date <=', $end)->orWhere('schedule_date', $start)->orWhere('schedule_date', $end)->countAllResults())) {
            return redirect()->back()->with('message', 'Invalid date.')->with('status', 'warning');
        }
        try {
            $begin = new DateTime($start);
            $end = new DateTime($end);
        } catch (Exception $e) {
            return redirect()->back()->with('message', 'Error reading dates.')->with('status', 'warning');
        }
        $date_range = new DatePeriod($begin, new DateInterval('P1D'), $end);
        $to_insert = [];
        foreach ($date_range as $date) {
            foreach (get_ts_init_data() as $item) {
                $item['schedule_date'] = $date->format('Y-m-d');
                $to_insert[] = $item;
            }
        }
        try {
            $this->trip_schedule_model->insertBatch($to_insert);
        } catch (ReflectionException $e) {
            return redirect()->back()->with('message', 'Fail to create schedules.')->with('status', 'warning');
        }
        return redirect()->back()->with('message', 'Schedules created.')->with('status', 'success');
    }
}

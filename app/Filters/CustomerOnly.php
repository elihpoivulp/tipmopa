<?php

namespace App\Filters;

use App\Models\Reservation;
use App\Models\SailingBoat;
use App\Models\TripSchedule;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Roles;

class CustomerOnly extends Auth
{
    private ?array $reservation_data = null;

    public function before(RequestInterface $request, $arguments = null)
    {
        $parent = parent::before($request, $arguments);
        if ($parent !== true) {
            return $parent;
        }
        if (session()->has('is_logged_in') && (session()->has('role') && session()->get('role') != 3)) {
            return redirect(config(Roles::class)->role_uri_assignments[session()->get('role')]);
        }
        $this->check_if_has_upcoming();
        if (!empty($this->reservation_data) && $this->reservation_data['boarded'] == 1 && !session()->has('sailing')) {
            if (model(SailingBoat::class)->where('trip_schedule_id', $this->reservation_data['trip_schedule_id'])->first()) {
                session()->set([
                    'sailing' => true,
                    'reservation_data' => $this->reservation_data
                ]);
            }
        }
        return true;
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $this->check_if_has_upcoming();
        if (empty($this->reservation_data) && session()->has('sailing')) {
            session()->set(['sailing' => '', 'reservation_data' => []]);
            session()->remove('sailing');
            session()->remove('reservation_data');
        }
    }

    private function check_if_has_upcoming() {
        $this->reservation_data = model(Reservation::class)->where('user_id', session()->get('id'))->where('boarded', 1)->where('fulfilled', 0)->first();
    }
}

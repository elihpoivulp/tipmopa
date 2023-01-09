<?php

namespace App\Filters;

use App\Models\SailingBoat;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Roles;

class OperatorOnly extends Auth
{
    private ?array $sailing_data = null;

    public function before(RequestInterface $request, $arguments = null)
    {
        $parent = parent::before($request, $arguments);
        if ($parent !== true) {
            return $parent;
        }
        if (session()->has('is_logged_in') && (session()->has('role') && session()->get('role') != 2)) {
            return redirect(config(Roles::class)->role_uri_assignments[session()->get('role')]);
        }
        $this->check_if_sailing();
        if (!empty($this->sailing_data) && !session()->has('sailing') || (!empty($this->sailing_data) && session()->has('sailing') && session()->get('sailing_boat_data')['location_points_arrival_sequence'] !== $this->sailing_data['location_points_arrival_sequence'])) {
            session()->set([
                'sailing' => true,
                'sailing_boat_data' => $this->sailing_data
            ]);
        }
        return true;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        $this->check_if_sailing();
        if (empty($this->sailing_data) && session()->has('sailing') && session()->get('sailing') === true) {
            session()->set(['sailing' => '', 'sailing_boat_data' => []]);
            session()->remove('sailing');
            session()->remove('sailing_boat_data');
        }
    }

    private function check_if_sailing()
    {
        $this->sailing_data = model(SailingBoat::class)->check_if_sailing();
    }
}

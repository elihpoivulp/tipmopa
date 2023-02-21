<?php

namespace App\Controllers\Customer;

use App\Controllers\BaseController;
use App\Models\Location;
use App\Models\Notification;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\TripSchedule;
use App\Models\User;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class Reserve extends BaseController
{
    private string $filename;

    public function index($id): string
    {
        if (!$this->request->getGet('location') && !$this->request->getGet('travel_type')) {
            throw new PageNotFoundException();
        }
        $ts = model(TripSchedule::class);
        $location = model(Location::class);
        $user = model(User::class);
        $destination = $location->find($this->request->getGet('location'));
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/customer/reserve', [
                'current_page' => ucfirst(explode('/', uri_string())[1]),
                'trip_info' => $ts->get_schedule_info_for_booking($id, $location),
                'customer' => $user->where('id', session()->get('id'))->first(),
                'travel_type' => $this->request->getGet('travel_type'),
                'origin' => $this->request->getGet('travel_type') == 'in' ? get_location(1) : $destination['name'],
                'destination' => $this->request->getGet('travel_type') == 'out' ? get_location(1) : $destination['name'],
                'location' => $destination,
                'depart_type' => $this->request->getGet('type')
            ]) .
            view('includes/footer');
    }

    public function process_reservation()
    {
        if ($this->upload_receipt()) {
            $reference_no = make_reference();
            $data = [
                'reference_no' => $reference_no,
                'trip_schedule_id' => $this->request->getPost('trip_schedule_id'),
                'user_id' => $this->request->getPost('user_id'),
                'origin' => $this->request->getPost('origin'),
                'destination' => $this->request->getPost('destination'),
                'payment' => $this->request->getPost('payment'),
                'receipt_img' => $this->filename,
                'type' => $this->request->getPost('type')
            ];
            try {
                $result = model(Reservation::class)->make_reservation($data);
                if ($result) {
                    if (!is_array($result)) {
                        $this->notification->create_notification(
                            $this->request->getPost('operator_id'),
                            'A new reservation has been made.',
                            $reference_no,
                        );
                        $this->notification->create_notification(
                            $this->request->getPost('user_id'),
                            'You have a pending reservation.',
                            $reference_no,
                            'reservation-created',
                        );
                    }
                }
                return redirect()->to(url_to('customer-dashboard'));
            } catch (ReflectionException $e) {
                return redirect()->back()->with('reserve-error', $e->getMessage());
            }
        } else {
            return redirect()->back()->with('reserve-error', 'Could not process your reservation. Please try again later');
        }
    }

    private function upload_receipt(): bool
    {
        $validationRule = [
            'receipt' => [
                'rules' => 'uploaded[receipt]'
                    . '|is_image[receipt]'
                    . '|mime_in[receipt,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[receipt,100]'
                    . '|max_dims[receipt,1024,768]',
            ],
        ];
        $has_error = false;
        if (!$this->validate($validationRule)) {
            $has_error = true;
        }
        $img = $this->request->getFile('receipt');
        if (!$img->hasMoved()) {
            $name = $img->getRandomName();
            $img->store('receipts', $name);
            $this->filename = $name;
        }
        return $has_error;
    }

    public function set_status(): RedirectResponse
    {
        $reservation_id = $this->request->getPost('reservation_id');
        $type = $this->request->getPost('type');
        $status = $this->request->getPost('status');
        try {
            if (model(Reservation::class)->update($reservation_id, [
                $type => $status,
                'date_' . $type => date('Y-m-d H:i:s')
            ])) {
                session()->set([
                    'is_boarded',
                    'reservation_id' => $reservation_id
                ]);
            }
        } catch (ReflectionException $e) {
            throw new PageNotFoundException();
        }
        return redirect()->back();
    }

    public function future(): string
    {
        $trip_schedule_model = model(TripSchedule::class);
        $reservation_model = model(Reservation::class);
        $itt = $trip_schedule_model->get_scheduled_today();
        $tti = $trip_schedule_model->get_scheduled_today(1);
        $reservations = $reservation_model->get_customer_reservations();
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/customer/reserve_future', [
                'dates' => $trip_schedule_model->get_future_dates_with_schedule(),
                'itt' => $itt,
                'tti' => $tti,
                'locations' => model(Location::class)->findAll(),
                'reservation_columns' => array_column($reservations, 'schedule_id'),
            ]) .
            view('includes/footer');
    }

    public function future_redirect(): RedirectResponse
    {
        $schedule_model = model(Schedule::class);

        $type = key_exists('itt', $this->request->getPost()) ? 'itt' : 'tti';
        $depart_type = $type === 'itt' ? 'departed_2' : 'departed_1';
        $travel_type = $type === 'itt' ? 'out' : 'in';
        $time = date('H:i:s', strtotime($this->request->getPost()[$type]));
        $date = $this->request->getPost()['date'];
        $location = $this->request->getPost()['location'];

        $id = $schedule_model->get_sched_id($type, $time, $date)['id'];

        if ($id > 0 || !is_null($id)) {
            $url = url_to('customer-reserve', $id);
            return redirect()->to($url . '?type=' . $depart_type . '&travel_type=' . $travel_type . '&location=' . $location);
        } else {
            throw new PageNotFoundException();
        }
    }
}

<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Notification;
use App\Models\Reservation;
use CodeIgniter\HTTP\RedirectResponse;

class Reserve extends BaseController
{
    public function index()
    {
        //
    }
    public function accept(): RedirectResponse
    {
        $reservation_id = $this->request->getPost('reservation_id');
        $customer_id = $this->request->getPost('customer_id');
        $reference_no = $this->request->getPost('reference_no');
        $reservation_model = model(Reservation::class);
        $reservation_model->accept_reservation($reservation_id);
        $this->notification->mark_seen_by_reference($reference_no);
        $this->notification->create_notification(
            $customer_id,
            'Your reservation has been accepted.',
            $reference_no,
            'reservation-accepted'
        );
        return redirect()->back();
    }
}

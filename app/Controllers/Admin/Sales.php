<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Reservation;

class Sales extends BaseController
{
    public function index(): string
    {
        $reservation_model = model(Reservation::class);
        try {
            $sales_today = $reservation_model->get_sales(true,);
            $sales_alltime = $reservation_model->get_sales();
            $monthly = $reservation_model->get_sales_all_time_grouped();
        } catch (Exception $e) {
            $sales_today = [];
            $sales_alltime = [];
            $monthly = [];
        }
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/admin/sales', [
                'sales_today' => $sales_today,
                'sales_alltime' => $sales_alltime,
                'monthly' => $monthly
            ]) .
            view('includes/footer');
    }
}

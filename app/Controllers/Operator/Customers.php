<?php

namespace App\Controllers\Operator;

use App\Controllers\BaseController;
use App\Models\Reservation;

class Customers extends BaseController
{
    public function index(): string
    {
        $reservation_model = model(Reservation::class);
        $stat = $reservation_model->get_customers_monthly_stat(session()->get('id'));
        $monthly_customers = [];
        $months = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        foreach ($stat as $item) {
            $monthly_customers[$item['location']][$months[$item['mth']]][] = [
              'count' => $item['cnt']
            ];
        }
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/operator/customers_list', [
                'customers' => $reservation_model->get_customers(session()->get('id')),
                'monthly_customers' => $monthly_customers,
                'total_customers' => array_sum(array_column($stat, 'cnt'))
            ]) .
            view('includes/footer');
    }
}

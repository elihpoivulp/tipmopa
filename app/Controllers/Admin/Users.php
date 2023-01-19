<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Reservation;
use App\Models\TripSchedule;
use App\Models\User;

class Users extends BaseController
{
    private array $user_type_roles = [
            'operators' => 2,
            'customers' => 3,
    ];

    public function users_list($user_type): string
    {
        $user_model = model(User::class);
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/admin/user_list', [
                'user_list' => $user_model->where('role', $this->user_type_roles[$user_type])->findAll(),
                'user_type' => $user_type
            ]) .
            view('includes/footer');
    }

    public function create_new(): string
    {
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/admin/user_create', [
                'account_creation_error' => session()->getFlashdata('account-creation-error') ?? null,
            ]) .
            view('includes/footer');
    }

    public function reservations(): string
    {
        $reservation_model = model(Reservation::class);
        $reservations = $reservation_model->get_all_reservations(!$this->request->getGet('today'));
        return view('includes/page-header') .
            $this->get_heading() .
            get_sidebar() .
            view('account/admin/user_reservations', [
                'reservations' => $reservations,
                'today' => !$this->request->getGet('today')
            ]) .
            view('includes/footer');
    }
}

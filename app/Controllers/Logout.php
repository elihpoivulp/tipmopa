<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Logout extends BaseController
{
    public function action(): RedirectResponse
    {
        session()->set(['name' => '', 'email' => '', 'id' => '', 'role' => '', 'is_logged_in' => '',
            'sailing' => '']);
        session()->destroy();
        return redirect('login');
    }
}

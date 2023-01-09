<?php

namespace App\Controllers;

use App\Models\User;
use Config\Roles;

class Login extends BaseController
{
    public function index(): string
    {
        return view('includes/page-header') .
            view('account/login', [
                'success_message' => session()->getFlashdata('success_message') ?? null,
                'login_error' => session()->getFlashdata('login_error') ?? null,
                'email' => session()->getFlashdata('email') ?? null
            ]) .
            view('includes/footer');
    }

    public function action()
    {
        $login_error = false;
        if ($this->request->getPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $userModel = new User();
            $session = session();
            $data = $userModel->where('email', $email)->first();
            if ($data) {
                $pass = $data['password'];
                $authenticatePassword = password_verify($password, $pass);
                if ($authenticatePassword) {
                    $ses_data = [
                        'id' => $data['id'],
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'role' => $data['role'],
                        'is_logged_in' => true
                    ];
                    $session->set($ses_data);
                    return redirect(config(Roles::class)->role_uri_assignments[session()->get('role')]);
                } else {
                    $login_error = true;
                }
            } else {
                $login_error = true;
            }
        }
        return redirect()
            ->back()
            ->with('login_error', $login_error ? 'Log in failed' : '')
            ->with('email', $this->request->getPost('email'));
    }
}

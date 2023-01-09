<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class Register extends BaseController
{
    public function __construct()
    {
        helper('session');
    }

    public function index(): string
    {
        return view('includes/page-header') .
            view('account/register', [
                'account_creation_error' => session()->getFlashdata('account-creation-error') ?? null,
            ]) .
            view('includes/footer');
    }

    public function action(): RedirectResponse
    {
        $userModel = model(User::class);
        if (!empty($this->request->getPost())) {
            try {
                $userModel->save([
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'address' => $this->request->getPost('address'),
                    'gender' => $this->request->getPost('gender'),
                    'weight' => $this->request->getPost('weight'),
                    'height' => $this->request->getPost('height'),
                    'age' => $this->request->getPost('age'),
                    'contact_number' => $this->request->getPost('contact_number'),
                    'emergency_contact_person' => $this->request->getPost('emergency_contact_person'),
                    'emergency_contact_person_contact_number' => $this->request->getPost('emergency_contact_person_contact_number'),
                    'password' => password_hash($this->request->getPost('password1'), 1),
                ]);
            } catch (ReflectionException $e) {
                return redirect()
                    ->to(url_to('register'))
                    ->with('account-creation-error', 'Error creating account. Please try again later')
                    ->with('email', $this->request->getPost('email'));
            }
        }
        return redirect()
            ->to(url_to('login'))
            ->with('success_message', 'Your account has been created. Please login to continue.')
            ->with('email', $this->request->getPost('email'));
    }
}

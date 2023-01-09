<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Roles;

class AdminOnly implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->has('is_logged_in') && (session()->has('role') && session()->get('role') != 1)) {
            return redirect(config(Roles::class)->role_uri_assignments[session()->get('role')]);
        }
        return true;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}

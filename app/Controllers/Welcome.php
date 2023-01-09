<?php

namespace App\Controllers;

class Welcome extends BaseController
{
    public function index()
    {
        return view('includes/page-header') .
            view('welcome') .
            view('includes/footer');
    }
}

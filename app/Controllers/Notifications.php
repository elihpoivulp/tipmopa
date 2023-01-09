<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use ReflectionException;

class Notifications extends BaseController
{
    /**
     * @throws ReflectionException
     */
    public function mark_seen($id): RedirectResponse
    {
        $this->notification->mark_seen($id);
        return redirect()->back();
    }
}

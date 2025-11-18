<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return redirect()->to($this->session->get('isLoggedIn') ? '/' . $this->session->get('role') . '/dashboard' : '/login');
    }
}

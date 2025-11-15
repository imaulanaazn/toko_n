<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function owner_dashboard()
    {
        return view('pages/owner/dashboard/index');
    }
    public function karyawan_dashboard()
    {
        return view('pages/karyawan/dashboard/index');
    }
}

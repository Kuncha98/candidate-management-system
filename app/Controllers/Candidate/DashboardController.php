<?php

namespace App\Controllers\Candidate;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('candidate/dashboard');
    }

}

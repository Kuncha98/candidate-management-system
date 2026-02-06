<?php

namespace App\Controllers\Candidate;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;
use App\Models\CandidateModel;

class RegistrationController extends BaseController
{
    protected $candidateModel;
    protected $userModel;

    public function __construct()
    {
        $this->candidateModel = new CandidateModel();
        $this->userModel = new UserModel();
    }

    // Show candidate register form
    public function register()
    {
        return view('candidate/register');
    }

    // Handle candidate registration
    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Validation failed');
        }

        // Create candidate in user model
        $userId = $this->userModel->insert([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'candidate'
        ]);

        // Create candidate in candidate model
        $this->candidateModel->insert([
            'user_id' => $userId,
            'status_id' => 1 // Applied default
        ]);

        return redirect()->to('/login')->with('success', 'Account created. Please log in.');
    }
}

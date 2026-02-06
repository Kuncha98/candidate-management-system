<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Show user register form
    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/login/redirect');
        }
        return view('auth/register');
    }

    // Handle user registration
    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }

        $this->userModel->save([
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user', // Default role
        ]);

        return redirect()->to('/login')->with('success', 'Registration successful! You can now log in.');
    }

    // Show login form
    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/login/redirect');
        }
        return view('auth/login');
    }

    // Handle login
    public function loginPost()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'user_name' => $user['name'],
                'user_email' => $user['email'],
                'user_role' => $user['role'],
                'logged_in' => true,
            ]);

            // Redirect based on role
            return redirect()->to('/login/redirect');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials.');
        }
    }

    // Handle role base redirection
    public function redirectAfterLogin()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }
        $role = session()->get('user_role');

        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');

            case 'candidate':
                return redirect()->to('/candidate/dashboard');

            case 'user':
            default:
                return redirect()->to('/browse/candidates');
        }
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully.');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {

        if (session()->get('isLoggedIn')) {
            return redirect()->to($this->role == 'owner' ? '/owner/dashboard' : '/karyawan/dashboard');
        }

        return view('pages/auth/form_login');
    }

    /**
     * Process login form
     */
    public function loginProcess()
    {
        $userModel = new UserModel();

        // Validation rules
        $rules = [
            'username' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Username is required',
                ]
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password is required',
                ]
            ],
        ];

        // Validate input
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Find user by username
        $user = $userModel->where('username', $username)->first();

        // Check if user exists
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password');
        }

        // Check if account is active
        if ($user['is_active'] != 1) {
            return redirect()->back()->withInput()->with('error', 'Your account has been deactivated. Please contact administrator.');
        }

        // Verify password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password');
        }

        // Set session data
        $sessionData = [
            'id'         => $user['id'],
            'username'   => $user['username'],
            'role'       => $user['role'],
            'full_name'  => $user['full_name'],
            'email'      => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($sessionData);

        // Redirect based on role
        if ($user['role'] === 'owner') {
            return redirect()->to('/owner/dashboard')->with('success', 'Welcome back, ' . $user['username'] . '!');
        } else {
            return redirect()->to('/karyawan/dashboard')->with('success', 'Welcome back, ' . $user['username'] . '!');
        }
    }

    /**
     * Logout user
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'You have been logged out successfully');
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {
        return view('pages/auth/form_login');
    }

    /**
     * Process login form
     */

    public function loginAs($userId)
    {
        return $this->loginProcess($userId); // pakai method yang sama
    }

    public function loginProcess($asUserId = null) // tambah parameter opsional
    {
        $userModel = new UserModel();

        // Jika ada $asUserId → fitur “Login sebagai user lain” (hanya admin/owner)
        if ($asUserId !== null) {
            $user = $userModel->find($asUserId);

            if (!$user) {
                return redirect()->back()->with('error', 'User tidak ditemukan.');
            }
            if ($user['is_active'] != 1) {
                return redirect()->back()->with('error', 'Akun tersebut tidak aktif.');
            }

            // Hanya owner yang boleh pakai fitur ini
            // if (!session()->get('isLoggedIn') || session()->get('active_user_role') !== 'owner') {
            //     return redirect()->back()->with('error', 'Akses ditolak.');
            // }
        } else {
            // ──────────────── LOGIN BIASA ────────────────
            $rules = [
                'username' => 'required',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $userModel->where('username', $username)->first();

            if (!$user) {
                return redirect()->back()->withInput()->with('error', 'Username atau password salah');
            }
            if ($user['is_active'] != 1) {
                return redirect()->back()->withInput()->with('error', 'Akun Anda dinonaktifkan.');
            }
            if (!password_verify($password, $user['password'])) {
                return redirect()->back()->withInput()->with('error', 'Username atau password salah');
            }
        }

        // ──────────────── PROSES MULTI SESSION ────────────────
        $currentSession = session()->get();

        // Siapkan data user baru
        $newUser = [
            'id'         => $user['id'],
            'username'   => $user['username'],
            'role'       => $user['role'],
            'full_name'  => $user['full_name'] ?? $user['username'],
            'email'      => $user['email'],
        ];

        // Ambil stack user yang sudah ada (jika ada)
        $usersStack = $currentSession['users'] ?? [];

        // Kalau login biasa dan belum ada session → buat baru
        // Kalau “login sebagai” → tambahkan di paling atas (jadi aktif)
        $usersStack = array_filter($usersStack, fn($u) => $u['id'] != $user['id']);
        // Tambahkan di paling atas
        array_unshift($usersStack, $newUser);

        // Simpan ke session
        $sessionData = [
            'users'           => $usersStack,
            'active_user_id'  => $user['id'],
            'active_user_role' => $user['role'],        // biar cepat cek role aktif
            'isLoggedIn'      => true,
        ];

        session()->set($sessionData);

        // ──────────────── REDIRECT SESUAI ROLE AKTIF ────────────────
        $redirectTo = $user['role'] === 'owner'
            ? '/owner/dashboard'
            : '/karyawan/dashboard';

        $message = $asUserId !== null
            ? 'Berhasil login sebagai ' . $user['full_name']
            : 'Selamat datang kembali, ' . $user['username'] . '!';

        return redirect()->to($redirectTo)->with('success', $message);
    }

    /**
     * Logout user
     */
    public function logout()
    {
        $users      = session()->get('users') ?? [];
        $activeId   = session()->get('active_user_id');

        // Jika tidak ada session atau hanya 1 user → logout total
        if (empty($users) || count($users) <= 1) {
            session()->destroy();
            return redirect()->to('/login')
                ->with('success', 'Anda telah keluar dari sistem.');
        }

        // Cari index user yang sedang aktif
        $activeIndex = null;
        foreach ($users as $index => $u) {
            if ($u['id'] == $activeId) {
                $activeIndex = $index;
                break;
            }
        }

        // Hapus user aktif dari stack
        if ($activeIndex !== null) {
            array_splice($users, $activeIndex, 1);
        }

        // Jika masih ada user lain → aktifkan yang paling atas (terbaru sebelumnya)
        if (!empty($users)) {
            $newActive = $users[0]; // yang paling baru sebelumnya

            session()->set([
                'users'           => $users,
                'active_user_id'  => $newActive['id'],
                'active_user_role' => $newActive['role'],
                'user'            => (object)$newActive, // biar filter tetap jalan
            ]);

            return redirect()->to('/login');
        }

        // Jika sudah tidak ada user sama sekali → logout total
        session()->destroy();
        return redirect()->to('/login')
            ->with('success', 'Anda telah keluar dari semua akun.');
    }
}

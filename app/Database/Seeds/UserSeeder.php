<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username'   => 'owner1',
                'password'   => password_hash('password', PASSWORD_DEFAULT),
                'role'       => 'owner',
                'full_name'  => 'John Doe',
                'email'      => 'owner@example.com',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'owner2',
                'password'   => password_hash('password', PASSWORD_DEFAULT),
                'role'       => 'owner',
                'full_name'  => 'Jane Smith',
                'email'      => 'jane.owner@example.com',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'karyawan1',
                'password'   => password_hash('password', PASSWORD_DEFAULT),
                'role'       => 'karyawan',
                'full_name'  => 'Ahmad Rizki',
                'email'      => 'ahmad@example.com',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'karyawan2',
                'password'   => password_hash('password', PASSWORD_DEFAULT),
                'role'       => 'karyawan',
                'full_name'  => 'Siti Nurhaliza',
                'email'      => 'siti@example.com',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'karyawan3',
                'password'   => password_hash('password', PASSWORD_DEFAULT),
                'role'       => 'karyawan',
                'full_name'  => 'Budi Santoso',
                'email'      => 'budi@example.com',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'inactive_user',
                'password'   => password_hash('password', PASSWORD_DEFAULT),
                'role'       => 'karyawan',
                'full_name'  => 'Inactive Employee',
                'email'      => 'inactive@example.com',
                'is_active'  => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Using Query Builder
        $this->db->table('users')->insertBatch($data);

        // Alternative: Using Model
        // $userModel = new \App\Models\UserModel();
        // foreach ($data as $user) {
        //     $userModel->insert($user);
        // }
    }
}

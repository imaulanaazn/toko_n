<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_promo'      => 'Diskon Awal Tahun',
                'tipe'            => 'persen',
                'nilai'           => 15.00, // 15%
                'tanggal_mulai'   => '2025-01-01',
                'tanggal_selesai' => '2025-01-31',
                'status'          => 'aktif',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
            [
                'nama_promo'      => 'Cashback Akhir Bulan',
                'tipe'            => 'nominal',
                'nilai'           => 5000.00, // potongan Rp5000
                'tanggal_mulai'   => '2025-02-25',
                'tanggal_selesai' => '2025-02-28',
                'status'          => 'aktif',
                'created_at'      => date('Y-m-d H:i:s'),
                'updated_at'      => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('promo')->insertBatch($data);
    }
}

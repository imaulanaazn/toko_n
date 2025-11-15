<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TrxPengeluaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_pengeluaran'          => 1, // Daging Ayam
                'tanggal_pengeluaran' => '2025-11-01',
                'nama_pengeluaran'        => 'Daging Ayam',
                'jumlah'            => 10.00,
                'harga_satuan'      => 35000.00,
                'total_harga'       => 350000.00,
            ],
            [
                'id_pengeluaran'          => 2, // Bumbu Marinasi
                'nama_pengeluaran'        => 'Bumbu Marinasi',
                'tanggal_pengeluaran' => '2025-11-02',
                'jumlah'            => 2.00,
                'harga_satuan'      => 25000.00,
                'total_harga'       => 50000.00,
            ],
            [
                'id_pengeluaran'          => 3, // Minyak Goreng
                'nama_pengeluaran'        => 'Minyak Goreng',
                'tanggal_pengeluaran' => '2025-11-03',
                'jumlah'            => 5.00,
                'harga_satuan'      => 20000.00,
                'total_harga'       => 100000.00,
            ],
            [
                'id_pengeluaran'          => 4, // Plastik Bungkus
                'nama_pengeluaran'        => 'Plastik Bungkus',
                'tanggal_pengeluaran' => '2025-11-04',
                'jumlah'            => 100.00,
                'harga_satuan'      => 200.00,
                'total_harga'       => 20000.00,
            ],
            [
                'id_pengeluaran'          => 5, // Gas LPG
                'nama_pengeluaran'        => 'Gas LPG 3kg',
                'tanggal_pengeluaran' => '2025-11-05',
                'jumlah'            => 1.00,
                'harga_satuan'      => 25000.00,
                'total_harga'       => 25000.00,
            ],
        ];

        $this->db->table('trx_pengeluaran')->insertBatch($data);
    }
}

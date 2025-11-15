<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BahanProdukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_produk'  => 1, // contoh: produk Ayam Bakar
                'id_bahan'   => 1, // contoh: bahan Ayam Utuh
                'jumlah'     => 13.00,
                'satuan'     => 'ekor',
                'output'     => 165,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_produk'  => 1, // produk sama (Ayam Bakar)
                'id_bahan'   => 2, // bahan tambahan: Kecap Manis
                'jumlah'     => 50.00,
                'satuan'     => 'ml',
                'output'     => 10,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_produk'  => 1,
                'id_bahan'   => 3, // bahan tambahan: Mentega
                'jumlah'     => 10.00,
                'satuan'     => 'gram',
                'output'     => 100,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_produk'  => 2, // contoh: produk Nasi Uduk
                'id_bahan'   => 4, // bahan: Beras
                'jumlah'     => 150.00,
                'satuan'     => 'gram',
                'output'     => 20,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_produk'  => 2,
                'id_bahan'   => 5, // bahan: Santan
                'jumlah'     => 100.00,
                'satuan'     => 'ml',
                'output'     => 44,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('bahan_produk')->insertBatch($data);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_produk' => 'Ayam Goreng',
                'satuan'      => 'Potong',
                'harga'       => 6000.00,
                'hpp'         => 4000.00,
                'margin'      => 6.00,
                'produksi_harian' => 195,
                'deskripsi'   => 'Ayam goreng renyah dengan bumbu khas tradisional.',
                'id_promo'    => 1, // misal promo id 1 = Diskon Awal Tahun
                'foto'        => 'uploads/produk/ayam_goreng_original.jpg',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'nama_produk' => 'Sate Ayam',
                'satuan'      => 'Porsi',
                'harga'       => 8000.00,
                'hpp'         => 5000.00,
                'margin'      => 6.00,
                'produksi_harian' => 300,
                'deskripsi'   => 'Sate ayam empuk dengan bumbu kacang gurih.',
                'id_promo'    => null, // tanpa promo
                'foto'        => 'uploads/produk/sate_ayam.jpg',
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('produk')->insertBatch($data);
    }
}

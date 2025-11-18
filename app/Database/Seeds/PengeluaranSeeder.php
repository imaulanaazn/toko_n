<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_pengeluaran'  => 'Daging Ayam',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'ekor',
                'harga_satuan'      => 22000.00,
            ],
            [
                'nama_pengeluaran'  => 'Gas 3kg',
                'kategori'          => 'bahan_penolong',
                'satuan'            => '',
                'harga_satuan'      => 20000.00,
            ],
            [
                'nama_pengeluaran'  => 'Tepung Terigu',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'kg',
                'harga_satuan'      => 8000.00,
            ],
            [
                'nama_pengeluaran'  => 'Minyak',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'kg',
                'harga_satuan'      => 18000.00,
            ],
            [
                'nama_pengeluaran'  => 'Saos',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'pack',
                'harga_satuan'      => 5000.00,
            ],
            [
                'nama_pengeluaran'  => 'Garam Daun',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'sachet',
                'harga_satuan'      => 2500.00,
            ],
            [
                'nama_pengeluaran'  => 'Soda Kue Matahari',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'sachet',
                'harga_satuan'      => 2000.00,
            ],
            [
                'nama_pengeluaran'  => 'Sasa',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'sachet',
                'harga_satuan'      => 1000.00,
            ],
            [
                'nama_pengeluaran'  => 'Lada',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'sachet',
                'harga_satuan'      => 1000.00,
            ],
            [
                'nama_pengeluaran'  => 'Masako',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'renceng',
                'harga_satuan'      => 5000.00,
            ],
            [
                'nama_pengeluaran'  => 'Kresek',
                'kategori'          => 'bahan_penolong',
                'satuan'            => 'pack',
                'harga_satuan'      => 5000.00,
            ],
            [
                'nama_pengeluaran'  => 'Kunyit',
                'kategori'          => 'bahan_utama',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
            [
                'nama_pengeluaran'  => 'Ketumbar',
                'kategori'          => 'bahan_utama',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
            [
                'nama_pengeluaran'  => 'Kemiri',
                'kategori'          => 'bahan_utama',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
            [
                'nama_pengeluaran'  => 'Bawang Merah',
                'kategori'          => 'bahan_utama',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
            [
                'nama_pengeluaran'  => 'Bawang Putih',
                'kategori'          => 'bahan_utama',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
            [
                'nama_pengeluaran'  => 'Cabe',
                'kategori'          => 'bahan_utama',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
            [
                'nama_pengeluaran'  => 'Gula Jawa',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'kg',
                'harga_satuan'      => 18000.00,
            ],
            [
                'nama_pengeluaran'  => 'Kacang Tanah',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'kg',
                'harga_satuan'      => 30000.00,
            ],
            [
                'nama_pengeluaran'  => 'Kertas Minyak',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'pack',
                'harga_satuan'      => 24000.00,
            ],
            [
                'nama_pengeluaran'  => 'Mentega 1/4kg',
                'kategori'          => 'bahan_utama',
                'satuan'            => 'sachet',
                'harga_satuan'      => 5000.00,
            ],
            [
                'nama_pengeluaran'  => 'Gaji Karyawan',
                'kategori'          => 'gaji',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
            [
                'nama_pengeluaran'  => 'Listrik',
                'kategori'          => 'operasional',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
            [
                'nama_pengeluaran'  => 'Bensin',
                'kategori'          => 'operasional',
                'satuan'            => '',
                'harga_satuan'      => 1.00,
            ],
        ];

        $this->db->table('pengeluaran')->insertBatch($data);
    }
}

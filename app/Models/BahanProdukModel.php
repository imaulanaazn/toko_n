<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanProdukModel extends Model
{
    protected $table = 'bahan_produk';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_produk', 'id_bahan', 'jumlah', 'satuan', 'output'];
    protected $useTimestamps = true;

    // contoh relasi manual
    public function getBahanByProduk($id_produk)
    {
        return $this->select('bahan_produk.*, bahan_baku.nama_bahan')
            ->join('bahan_baku', 'bahan_baku.id_bahan = bahan_produk.id_bahan')
            ->where('bahan_produk.id_produk', $id_produk)
            ->findAll();
    }
}

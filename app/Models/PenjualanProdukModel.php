<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanProdukModel extends Model
{
    protected $table            = 'penjualan_produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id_penjualan',
        'id_produk',
        'jumlah',
        'harga_satuan',
        'diskon',
        'subtotal',
        'total',
        'tanggal'
    ];

    // protected $useTimestamps = true;

    /**
     * Ambil daftar produk per transaksi (dengan detail nama produk dan promo)
     */
    public function getDetailByPenjualan($id_penjualan)
    {
        return $this->select('penjualan_produk.*, produk.nama_produk, produk.harga, promo.nama_promo, promo.diskon')
            ->join('produk', 'produk.id_produk = penjualan_produk.id_produk', 'left')
            ->join('promo', 'promo.id_promo = produk.id_promo', 'left')
            ->where('penjualan_produk.id_penjualan', $id_penjualan)
            ->findAll();
    }
}

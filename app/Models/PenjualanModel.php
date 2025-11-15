<?php

namespace App\Models;

use CodeIgniter\Model;

class PenjualanModel extends Model
{
    protected $table            = 'penjualan';
    protected $primaryKey       = 'id_penjualan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'tanggal',
        'total_harga',
        'total_diskon',
        'grand_total',
        'status',
        'catatan',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil daftar produk yang dibeli di satu penjualan
     */
    public function getProdukByPenjualan($id_penjualan)
    {
        return $this->db->table('penjualan_produk')->select('penjualan_produk.*, produk.nama_produk, produk.harga, promo.diskon')
            ->join('produk', 'produk.id_produk = penjualan_produk.id_produk', 'left')
            ->join('promo', 'promo.id_promo = produk.id_promo', 'left')
            ->where('penjualan_produk.id_penjualan', $id_penjualan)
            ->get()
            ->getResultArray();
    }

    public function getPenjualanPaginated($periode = 'harian', $perPage = 10)
    {
        // Tentukan rentang tanggal
        switch ($periode) {
            case 'mingguan':
                $start = date('Y-m-d 00:00:00', strtotime('-7 days'));
                $end   = date('Y-m-d 23:59:59');
                break;

            case 'bulanan':
                $start = date('Y-m-01 00:00:00');
                $end   = date('Y-m-t 23:59:59');
                break;

            default: // harian
                $start = date('Y-m-d 00:00:00');
                $end   = date('Y-m-d 23:59:59');
                break;
        }

        return $this->select("
            penjualan.*,
            GROUP_CONCAT(produk.nama_produk SEPARATOR '|') AS produk_list,
            GROUP_CONCAT(penjualan_produk.jumlah SEPARATOR '|') AS jumlah_list,
            GROUP_CONCAT(penjualan_produk.subtotal SEPARATOR '|') AS subtotal_list,
            GROUP_CONCAT(penjualan_produk.harga_satuan SEPARATOR '|') AS harga_satuan_list
        ")
            ->join("penjualan_produk", "penjualan_produk.id_penjualan = penjualan.id_penjualan", "left")
            ->join("produk", "produk.id_produk = penjualan_produk.id_produk", "left")
            ->where("penjualan.tanggal >=", $start)
            ->where("penjualan.tanggal <=", $end)
            ->groupBy("penjualan.id_penjualan") // WAJIB supaya pagination tidak rusak
            ->orderBy("penjualan.tanggal", "DESC")
            ->paginate($perPage, 'penjualan');
    }
}

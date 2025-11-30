<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_produk',
        'satuan',
        'harga',
        'margin',
        'deskripsi',
        'produksi_harian',
        'id_promo',
        'foto',
    ];

    protected $useTimestamps = true;

    // Fungsi bantu untuk update margin otomatis (misal dipakai di controller)
    public function updateMargin($id_produk)
    {
        $produk = $this->find($id_produk);
        if ($produk) {
            $margin = $produk['harga'] - $produk['hpp'];
            $this->update($id_produk, ['margin' => $margin]);
        }
    }

    public function getProdukDetail($keyword = null)
    {
        $builder = $this->select("
            produk.*,
            promo.nama_promo,
            promo.tipe as tipe_promo,
            promo.nilai,
            promo.tanggal_mulai,
            promo.tanggal_selesai,
            promo.status,
            GROUP_CONCAT(pengeluaran.nama_pengeluaran SEPARATOR '|') AS daftar_bahan,
            GROUP_CONCAT(bahan_produk.jumlah SEPARATOR '|') AS jumlah_bahan,
            GROUP_CONCAT(pengeluaran.satuan SEPARATOR '|') AS satuan_bahan,
            GROUP_CONCAT(pengeluaran.harga_satuan SEPARATOR '|') AS harga_bahan
        ")
            ->join('promo', 'produk.id_promo = promo.id_promo', 'left')
            ->join('bahan_produk', 'bahan_produk.id_produk = produk.id_produk', 'left')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = bahan_produk.id_bahan', 'left')
            ->groupBy('produk.id_produk');

        // Jika ada pencarian
        if (!empty($keyword)) {
            $builder->like('produk.nama_produk', $keyword);
        }

        return $builder->findAll();
    }
}

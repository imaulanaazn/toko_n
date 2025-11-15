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
        'harga',
        'hpp',
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
}

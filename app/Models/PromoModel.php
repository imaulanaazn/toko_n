<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $table            = 'promo';
    protected $primaryKey       = 'id_promo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'nama_promo',
        'tipe',
        'nilai',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
    ];

    protected $useTimestamps = true;

    /**
     * Cek apakah promo masih aktif (berdasarkan tanggal & status)
     */
    public function getActivePromos()
    {
        $today = date('Y-m-d');
        return $this->where('status', 'aktif')
            ->where('tanggal_mulai <=', $today)
            ->where('tanggal_selesai >=', $today)
            ->findAll();
    }

    /**
     * Ambil promo aktif berdasarkan ID
     */
    public function getPromoAktif($id_promo)
    {
        $today = date('Y-m-d');
        return $this->where('id_promo', $id_promo)
            ->where('status', 'aktif')
            ->where('tanggal_mulai <=', $today)
            ->where('tanggal_selesai >=', $today)
            ->first();
    }
}

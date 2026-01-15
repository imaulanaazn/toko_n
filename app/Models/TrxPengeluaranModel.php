<?php

namespace App\Models;

use CodeIgniter\Model;

class TrxPengeluaranModel extends Model
{
    protected $table            = 'trx_pengeluaran';
    protected $primaryKey       = 'id_trx';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'id_pengeluaran',
        'nama_pengeluaran',
        'tanggal_pengeluaran',
        'jumlah',
        'harga_satuan',
        'total_harga',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Ambil data pengeluaran + detail bahan
     */
    public function getWithBahan()
    {
        return $this->select('trx_pengeluaran.*, pengeluaran.nama_pengeluaran, pengeluaran.satuan')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = trx_pengeluaran.id_pengeluaran')
            ->orderBy('tanggal_pengeluaran', 'DESC')
            ->findAll();
    }

    public function getPengeluaranPaginated($periode = 'harian', $perPage = 10)
    {
        switch ($periode) {
            case 'bulan-lalu':
                $start = date('Y-m-d', strtotime('first day of last month'));
                $end   = date('Y-m-d', strtotime('last day of last month'));
                break;

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

        return $this->select('trx_pengeluaran.*, pengeluaran.nama_pengeluaran AS nama_master, pengeluaran.satuan, pengeluaran.kategori')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = trx_pengeluaran.id_pengeluaran')
            ->where('tanggal_pengeluaran >=', $start)
            ->where('tanggal_pengeluaran <=', $end)
            ->orderBy('tanggal_pengeluaran', 'DESC')
            ->paginate($perPage, 'pengeluaran');
    }
}

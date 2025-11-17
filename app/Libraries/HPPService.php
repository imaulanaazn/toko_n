<?php

namespace App\Libraries;

use App\Models\BahanProdukModel;
use App\Models\ProdukModel;
use App\Models\TrxPengeluaranModel;

class HPPService
{
    protected $bahanProdukModel;
    protected $trxPengeluaranModel;
    protected $produkModel;

    public function __construct()
    {
        $this->bahanProdukModel   = new BahanProdukModel();
        $this->trxPengeluaranModel     = new TrxPengeluaranModel();
        $this->produkModel  = new ProdukModel();
    }

    public function hitungHPP($id_produk)
    {
        // Ambil bahan produk (jumlah & output)
        $bahanProdukList = $this->bahanProdukModel
            ->where('id_produk', $id_produk)
            ->findAll();

        if (empty($bahanProdukList)) {
            return 0;
        }

        $totalHpp = 0;

        foreach ($bahanProdukList as $bahan) {

            // Ambil transaksi bahan terbaru berdasarkan id_bahan
            $hargaBahan = $this->trxPengeluaranModel
                ->where('id_pengeluaran', $bahan['id_bahan'])
                ->orderBy('tanggal_pengeluaran', 'DESC')
                ->first();

            if (!$hargaBahan) {
                continue;
            }

            // Hitung biaya bahan per satu produk
            $biayaPerProduk = ($bahan['jumlah'] / $bahan['output'])
                * $hargaBahan['harga_satuan'];

            $totalHpp += $biayaPerProduk;
        }

        // -----------------------------
        //  HITUNG OVERHEAD (Operasional & Gaji)
        // -----------------------------

        // Total operasional bulan berjalan
        $operasional = $this->trxPengeluaranModel
            ->selectSum('trx_pengeluaran.total_harga', 'total_operasional')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = trx_pengeluaran.id_pengeluaran')
            ->where('pengeluaran.kategori', 'operasional')
            ->where('tanggal_pengeluaran >=', date('Y-m-01'))
            ->first()['total_operasional'] ?? 0;

        // Total gaji bulan berjalan
        $gaji = $this->trxPengeluaranModel
            ->selectSum('trx_pengeluaran.total_harga', 'total_gaji')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = trx_pengeluaran.id_pengeluaran')
            ->where('pengeluaran.kategori', 'gaji')
            ->where('tanggal_pengeluaran >=', date('Y-m-01'))
            ->first()['total_gaji'] ?? 0;

        // Ambil data produk (untuk produksi_harian)
        $produk = $this->produkModel->find($id_produk);
        $produksiHarian = $produk['produksi_harian'] ?? 1;

        // Asumsi 30 hari produksi
        $totalProduksiBulan = $produksiHarian * 30;

        $biayaOverhead = 0;

        if ($totalProduksiBulan > 0) {
            $biayaOverhead = ($operasional + $gaji) / $totalProduksiBulan;
        }

        $totalHpp += $biayaOverhead;

        // Update nilai HPP produk
        $this->produkModel->update($id_produk, [
            'hpp' => $totalHpp
        ]);

        return round($totalHpp, 2);
    }
}

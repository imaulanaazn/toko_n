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
        // 1. Ambil data produk
        $produk = $this->produkModel->find($id_produk);
        if (!$produk) return 0;

        $produksiHarian = $produk['produksi_harian'] ?? 1;

        // Gunakan 30 hari tetap sebagai standar bulan (atau ambil dari setting)
        $hariDalamBulan = 26;

        // Total produksi dalam 1 bulan penuh
        $totalProduksiBulan = $produksiHarian * $hariDalamBulan;

        // 2. Biaya Bahan Baku untuk 1 bulan penuh
        $biayaBahanBakuBulanan = $this->bahanProdukModel->biayaBahanBaku($id_produk) * $totalProduksiBulan;

        // 3. Biaya Overhead Bulanan (Operasional + Gaji) → bulan berjalan
        $overheadBulanan = $this->trxPengeluaranModel
            ->selectSum('total_harga', 'total')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = trx_pengeluaran.id_pengeluaran')
            ->whereIn('pengeluaran.kategori', ['operasional', 'gaji'])
            ->where('MONTH(tanggal_pengeluaran)', date('m'))
            ->where('YEAR(tanggal_pengeluaran)', date('Y'))
            ->get()
            ->getRow()
            ->total ?? 0;

        // 4. Total Biaya Produksi Bulanan
        $totalBiayaProduksiBulanan = $biayaBahanBakuBulanan + $overheadBulanan;

        // 5. HPP per unit = Total Biaya Bulanan ÷ Total Produksi Bulanan
        $hppPerUnit = $totalProduksiBulan > 0
            ? $totalBiayaProduksiBulanan / $totalProduksiBulan
            : 0;

        return round($hppPerUnit, 2);
    }
}

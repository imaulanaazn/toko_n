<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    public function index()
    {
        $periode = $this->request->getGet('periode') ?? 'harian';

        // Tentukan rentang tanggal
        $range = $this->getDateRange($periode);

        $start = $range['start'];
        $end   = $range['end'];

        // ===========================
        // 1. Total Pengeluaran (operasional, gaji, dll)
        // ===========================
        $totalPengeluaran = $this->trxPengeluaranModel
            ->where("tanggal_pengeluaran >=", $start)
            ->where("tanggal_pengeluaran <=", $end)
            ->selectSum("total_harga")
            ->first()['total_harga'] ?? 0;

        $totalOperasional = $this->getTotalOperasional($start, $end);

        // ===========================
        // 2. Total Produk Terjual
        // ===========================
        $totalProdukTerjual = $this->penjualanProdukModel
            ->where("created_at >=", $start)
            ->where("created_at <=", $end)
            ->selectSum('jumlah')
            ->first()['jumlah'] ?? 0;

        $totalTransaksi = $this->penjualanModel
            ->where("created_at >=", $start)
            ->where("created_at <=", $end)
            ->countAllResults(); // jumlah transaksi penjualan

        $rataRataTransaksi = $totalTransaksi;

        if ($periode == 'mingguan') {
            $rataRataTransaksi = $totalTransaksi / 7;
        } else if ($periode == 'bulanan') {
            $rataRataTransaksi = $totalTransaksi / 30;
        }

        // ===========================
        // 3. Total Penjualan (Omset)
        // ===========================
        $totalPenjualan = $this->penjualanModel
            ->where("created_at >=", $start)
            ->where("created_at <=", $end)
            ->selectSum('grand_total')
            ->first()['grand_total'] ?? 0;

        // ===========================
        // 4. Total HPP
        // ===========================
        // asumsi setiap produk sudah memiliki field 'hpp'
        $penjualanData = $this->penjualanProdukModel
            ->where("created_at >=", $start)
            ->where("created_at <=", $end)
            ->findAll();

        $totalHPP = 0;

        foreach ($penjualanData as $trx) {
            $produk = $this->produkModel->find($trx['id_produk']);

            if ($produk) {
                $totalHPP += ($produk['hpp'] * $trx['jumlah']);
            }
        }

        // ===========================
        // 5. Laba Kotor
        // ===========================
        $labaKotor = $totalPenjualan - $totalHPP;

        // ===========================
        // 6. Laba Bersih
        // ===========================
        $labaBersih = $labaKotor - $totalPengeluaran;

        $penjualanPaginated = $this->penjualanModel->getPenjualanPaginated($periode, 10);
        $penjualanPager     = $this->penjualanModel->pager;

        $pengeluaranPaginated = $this->trxPengeluaranModel->getPengeluaranPaginated($periode, 10);
        $pengeluaranPager     = $this->trxPengeluaranModel->pager;

        // ===========================
        // RETURN KE VIEW
        // ===========================

        return view('pages/owner/laporan/index', [
            'periode'            => $periode,
            'start'              => $start,
            'end'                => $end,
            'totalPengeluaran'   => $totalPengeluaran,
            'totalProdukTerjual' => $totalProdukTerjual,
            'totalPenjualan'     => $totalPenjualan,
            'totalHPP'           => $totalHPP,
            'labaKotor'          => $labaKotor,
            'labaBersih'         => $labaBersih,
            'totalTransaksi'     => $totalTransaksi,
            'rataRataTransaksi'  => $rataRataTransaksi,
            'totalOperasional'   => $totalOperasional,
            'dataPenjualan'      => $penjualanPaginated,
            'penjualanPager'     => $penjualanPager,
            'dataPengeluaran' => $pengeluaranPaginated,
            'pengeluaranPager'     => $pengeluaranPager
        ]);
    }

    public function getTotalOperasional($startDate = null, $endDate = null)
    {
        $this->trxPengeluaranModel->selectSum('trx_pengeluaran.total_harga', 'total_operasional')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = trx_pengeluaran.id_pengeluaran')
            ->where('pengeluaran.kategori', 'operasional');

        // Filter tanggal jika ada
        if ($startDate) {
            $this->trxPengeluaranModel->where('trx_pengeluaran.tanggal_pengeluaran >=', $startDate);
        }
        if ($endDate) {
            $this->trxPengeluaranModel->where('trx_pengeluaran.tanggal_pengeluaran <=', $endDate);
        }

        $result = $this->trxPengeluaranModel->first();

        return $result['total_operasional'] ?? 0;
    }

    private function getDateRange($periode)
    {
        switch ($periode) {
            case 'mingguan':
                return [
                    'start' => date('Y-m-d 00:00:00', strtotime('-7 days')),
                    'end'   => date('Y-m-d 23:59:59'),
                ];

            case 'bulanan':
                return [
                    'start' => date('Y-m-01 00:00:00'),
                    'end'   => date('Y-m-t 23:59:59'),
                ];

            case 'harian':
            default:
                return [
                    'start' => date('Y-m-d 00:00:00'),
                    'end'   => date('Y-m-d 23:59:59'),
                ];
        }
    }
}

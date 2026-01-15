<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LabaRugi extends BaseController
{
    public function index()
    {
        $periode = $this->request->getGet('periode') ?? 'harian';
        $daftarProduk = $this->produkModel->findAll();
        $produkId = $this->request->getGet('produk_id') ?? '';

        $data = $this->getLaporanData($periode, $produkId);
        $data['daftarProduk'] = $daftarProduk;

        return view('pages/owner/labarugi/index', $data);
    }

    private function getLaporanData($periode, $produkId = null)
    {
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
        // 2. Total Penjualan (Omset)
        // ===========================
        $totalPenjualan = $this->penjualanProdukModel
            ->where("tanggal >=", $start)
            ->where("tanggal <=", $end)
            ->when(!empty($produkId), fn($q) => $q->where('id_produk', $produkId))
            ->selectSum('total')
            ->first()['total'] ?? 0;

        // ===========================
        // 3. Total HPP
        // ===========================
        // asumsi setiap produk sudah memiliki field 'hpp'
        $penjualanData = $this->penjualanProdukModel
            ->where("tanggal >=", $start)
            ->where("tanggal <=", $end)
            ->when(!empty($produkId), fn($q) => $q->where('id_produk', $produkId))
            ->findAll();

        $totalHPP = 0;

        foreach ($penjualanData as $trx) {
            $totalHPP += $this->hppService->hitungHPP($trx['id_produk']) * $trx['jumlah'];
        }

        // ===========================
        // 4. Laba Kotor
        // ===========================
        $labaKotor = $totalPenjualan - $totalHPP;

        // ===========================
        // 5. Laba Bersih
        // ===========================
        $labaBersih = $labaKotor - $totalPengeluaran;

        return [
            'periode'            => $periode,
            'start'              => $start,
            'end'                => $end,
            'totalPenjualan'     => $totalPenjualan,
            'totalHPP'           => $totalHPP,
            'labaKotor'          => $labaKotor,
            'labaBersih'         => $labaBersih,
            'totalOperasional'   => $totalOperasional,
        ];
    }

    private function getTotalOperasional($startDate = null, $endDate = null)
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
            case 'bulan-lalu':
                return [
                    'start' => date('Y-m-d', strtotime('first day of last month')),
                    'end'   => date('Y-m-d', strtotime('last day of last month')),
                ];
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

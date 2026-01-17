<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    public function index()
    {
        $periode = $this->request->getGet('periode') ?? 'harian';
        $daftarProduk = $this->produkModel->findAll();
        $produkId = $this->request->getGet('produk_id') ?? '';

        $data = $this->getLaporanData($periode, $produkId);
        $data['daftarProduk'] = $daftarProduk;

        return view('pages/owner/laporan/index', $data);
    }

    public function cetak_pdf_ringkasan()
    {
        $periode = $this->request->getGet('periode') ?? 'harian';
        $produkId = $this->request->getGet('produk_id') ?? '';

        $range = $this->getDateRange($periode);
        $start = $range['start'];
        $end   = $range['end'];

        // 1. Ambil Data Finansial
        $totalPengeluaran = $this->calculateTotalPengeluaran($start, $end);
        $totalPenjualan   = $this->calculateTotalPenjualan($start, $end, $produkId);
        $totalHPP         = $this->calculateTotalHPP($start, $end, $produkId);

        // 2. Hitung Profit (Logic ini diletakkan di variabel agar bersih)
        $labaKotor  = $totalPenjualan - $totalHPP;
        $labaBersih = $labaKotor - $totalPengeluaran;

        // 3. Ambil Data Statistik Transaksi
        $stats = $this->getTransactionStats($start, $end, $produkId);
        return view('pages/owner/laporan/template_pdf_ringkasan', [
            'periode'            => $periode,
            'start'              => $start,
            'end'                => $end,
            'totalPengeluaran'   => $totalPengeluaran,
            'totalProdukTerjual' => $stats['totalProdukTerjual'],
            'totalPenjualan'     => $totalPenjualan,
            'totalHPP'           => $totalHPP,
            'labaKotor'          => $labaKotor,
            'labaBersih'         => $labaBersih,
            'totalTransaksi'     => $stats['totalTransaksi'],
            'rataRataTransaksi'  => $stats['rataRata'],
            'totalOperasional'   => $this->getTotalOperasional($start, $end),
        ]);
    }

    public function cetak_pdf_penjualan()
    {
        $periode = $this->request->getGet('periode') ?? 'harian';
        $produkId = $this->request->getGet('produk_id') ?? '';
        $range = $this->getDateRange($periode);
        $start = $range['start'];
        $end   = $range['end'];

        return view('pages/owner/laporan/template_pdf_penjualan', [
            'periode' => $periode,
            'produk_id' => $produkId,
            'dataPenjualan' => $this->penjualanModel->getPenjualanData($periode, $produkId),
            'start' => $start,
            'end' => $end,
        ]);
    }

    public function cetak_pdf_pengeluaran()
    {
        $periode = $this->request->getGet('periode') ?? 'harian';
        $produkId = $this->request->getGet('produk_id') ?? '';
        $range = $this->getDateRange($periode);
        $start = $range['start'];
        $end   = $range['end'];

        return view('pages/owner/laporan/template_pdf_pengeluaran', [
            'periode' => $periode,
            'produk_id' => $produkId,
            'dataPengeluaran' => $this->trxPengeluaranModel->getPengeluaranData($periode, $produkId),
            'start' => $start,
            'end' => $end,
        ]);
    }

    private function getLaporanData($periode, $produkId = null)
    {
        $range = $this->getDateRange($periode);
        $start = $range['start'];
        $end   = $range['end'];

        // 1. Ambil Data Finansial
        $totalPengeluaran = $this->calculateTotalPengeluaran($start, $end);
        $totalPenjualan   = $this->calculateTotalPenjualan($start, $end, $produkId);
        $totalHPP         = $this->calculateTotalHPP($start, $end, $produkId);

        // 2. Hitung Profit (Logic ini diletakkan di variabel agar bersih)
        $labaKotor  = $totalPenjualan - $totalHPP;
        $labaBersih = $labaKotor - $totalPengeluaran;

        // 3. Ambil Data Statistik Transaksi
        $stats = $this->getTransactionStats($start, $end, $produkId);

        return [
            'periode'            => $periode,
            'start'              => $start,
            'end'                => $end,
            'totalPengeluaran'   => $totalPengeluaran,
            'totalProdukTerjual' => $stats['totalProdukTerjual'],
            'totalPenjualan'     => $totalPenjualan,
            'totalHPP'           => $totalHPP,
            'labaKotor'          => $labaKotor,
            'labaBersih'         => $labaBersih,
            'totalTransaksi'     => $stats['totalTransaksi'],
            'rataRataTransaksi'  => $stats['rataRata'],
            'totalOperasional'   => $this->getTotalOperasional($start, $end),
            'dataPenjualan'      => $this->penjualanModel->getPenjualanPaginated($periode, 10, $produkId),
            'penjualanPager'     => $this->penjualanModel->pager,
            'dataPengeluaran'    => $this->trxPengeluaranModel->getPengeluaranPaginated($periode, 10),
            'pengeluaranPager'   => $this->trxPengeluaranModel->pager,
            'produk_id'          => $produkId
        ];
    }

    // --- Helper Methods ---

    private function calculateTotalPengeluaran($start, $end)
    {
        return $this->trxPengeluaranModel
            ->where("tanggal_pengeluaran >=", $start)
            ->where("tanggal_pengeluaran <=", $end)
            ->selectSum("total_harga")
            ->first()['total_harga'] ?? 0;
    }

    private function calculateTotalPenjualan($start, $end, $produkId)
    {
        return $this->penjualanProdukModel
            ->where("tanggal >=", $start)
            ->where("tanggal <=", $end)
            ->when(!empty($produkId), fn($q) => $q->where('id_produk', $produkId))
            ->selectSum('total')
            ->first()['total'] ?? 0;
    }

    private function calculateTotalHPP($start, $end, $produkId)
    {
        $penjualanData = $this->penjualanProdukModel
            ->where("tanggal >=", $start)
            ->where("tanggal <=", $end)
            ->when(!empty($produkId), fn($q) => $q->where('id_produk', $produkId))
            ->findAll();

        return array_reduce($penjualanData, function ($carry, $trx) {
            return $carry + ($this->hppService->hitungHPP($trx['id_produk']) * $trx['jumlah']);
        }, 0);
    }

    private function getTransactionStats($start, $end, $produkId)
    {
        $query = $this->penjualanProdukModel
            ->where("tanggal >=", $start)
            ->where("tanggal <=", $end)
            ->when(!empty($produkId), fn($q) => $q->where('id_produk', $produkId));

        $totalProdukTerjual = (clone $query)->selectSum('jumlah')->first()['jumlah'] ?? 0;
        $totalTransaksi     = (clone $query)->distinct()->countAllResults('id_penjualan');

        $daysCount = (strtotime($end) - strtotime($start)) / 86400;
        $rataRata  = $daysCount > 0 ? $totalTransaksi / $daysCount : 0;

        return [
            'totalProdukTerjual' => $totalProdukTerjual,
            'totalTransaksi'     => $totalTransaksi,
            'rataRata'           => $rataRata
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

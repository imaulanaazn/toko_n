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

    public function hitungHPP($id_produk)
    {
        $db = \Config\Database::connect();

        // Ambil data bahan produk (bahan + jumlah per batch/output)
        $bahanProdukList = $db->table('bahan_produk')
            ->where('id_produk', $id_produk)
            ->get()->getResultArray();

        if (empty($bahanProdukList)) {
            return 0; // kalau belum ada bahan
        }

        $totalHpp = 0;

        foreach ($bahanProdukList as $bahan) {
            // Ambil data harga bahan dari transaksi terbaru
            $hargaBahan = $db->table('trx_pengeluaran')
                ->where('id_pengeluaran', $bahan['id_bahan'])
                ->orderBy('tanggal_pengeluaran', 'DESC')
                ->limit(1)
                ->get()
                ->getRowArray();

            if (!$hargaBahan) {
                continue; // skip kalau belum ada transaksi bahan ini
            }

            // Hitung biaya bahan ini untuk 1 output (misal 1 ayam goreng)
            // Misal: bahan['jumlah'] = 2kg untuk output 10 porsi ayam → per porsi = (2kg/10)
            $biayaPerProduk = ($bahan['jumlah'] / $bahan['output']) * $hargaBahan['harga_satuan'];

            $totalHpp += $biayaPerProduk;
        }

        // ✅ Tambahkan biaya operasional proporsional
        $operasional = $db->table('trx_pengeluaran')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = trx_pengeluaran.id_pengeluaran')
            ->where('pengeluaran.kategori', 'operasional')
            ->where('trx_pengeluaran.tanggal_pengeluaran >=', date('Y-m-01'))
            ->selectSum('trx_pengeluaran.total_harga', 'total_operasional')
            ->get()->getRowArray()['total_operasional'] ?? 0;

        // ✅ Tambahkan biaya gaji proporsional (per produk)
        $gaji = $db->table('trx_pengeluaran')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = trx_pengeluaran.id_pengeluaran')
            ->where('pengeluaran.kategori', 'gaji')
            ->where('trx_pengeluaran.tanggal_pengeluaran >=', date('Y-m-01'))
            ->selectSum('trx_pengeluaran.total_harga', 'total_gaji')
            ->get()->getRowArray()['total_gaji'] ?? 0;

        // Ambil produksi harian produk ini
        $produk = $db->table('produk')->where('id_produk', $id_produk)->get()->getRowArray();
        $produksiHarian = $produk['produksi_harian'] ?? 1;

        // Asumsikan 30 hari produksi
        $totalProduksiBulan = $produksiHarian * 30;

        // Biaya operasional + gaji dibagi proporsional
        $biayaOverhead = 0;
        if ($totalProduksiBulan > 0) {
            $biayaOverhead = ($operasional + $gaji) / $totalProduksiBulan;
        }

        $totalHpp += $biayaOverhead;

        // Update HPP produk di database
        $db->table('produk')->where('id_produk', $id_produk)->update(['hpp' => $totalHpp]);

        return round($totalHpp, 2);
    }
}

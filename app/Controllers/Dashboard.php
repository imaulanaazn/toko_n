<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function owner_dashboard()
    {
        $bulan = date('m');
        $tahun = date('Y');

        // Ambil jumlah hari pada bulan ini
        $jumlahHari = date('t', strtotime("$tahun-$bulan-01"));

        // Inisialisasi array untuk chart
        $labels = [];
        $totalPenjualan = array_fill(1, $jumlahHari, 0);
        $totalPengeluaran = array_fill(1, $jumlahHari, 0);
        $labaBersih = array_fill(1, $jumlahHari, 0);

        // Generate label tanggal
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $labels[] = $i;
        }

        // =========================
        // Ambil Penjualan per hari
        // =========================
        $penjualan = $this->penjualanModel
            ->select("DAY(created_at) as hari, SUM(total_harga) as total")
            ->where("MONTH(created_at)", $bulan)
            ->where("YEAR(created_at)", $tahun)
            ->groupBy("DAY(created_at)")
            ->findAll();

        foreach ($penjualan as $row) {
            $totalPenjualan[$row['hari']] = (int)$row['total'];
        }

        // ==========================
        // Ambil Pengeluaran per hari
        // ==========================
        $pengeluaran = $this->trxPengeluaranModel
            ->select("DAY(created_at) as hari, SUM(total_harga) as total")
            ->where("MONTH(created_at)", $bulan)
            ->where("YEAR(created_at)", $tahun)
            ->groupBy("DAY(created_at)")
            ->findAll();

        foreach ($pengeluaran as $row) {
            $totalPengeluaran[$row['hari']] = (int)$row['total'];
        }

        // =============================
        // Hitung Laba Bersih per hari
        // =============================
        for ($i = 1; $i <= $jumlahHari; $i++) {
            $labaBersih[$i] = $totalPenjualan[$i] - $totalPengeluaran[$i];
        }

        // =============================
        // Kirim ke View
        // =============================
        return view('pages/owner/dashboard/index', [
            'labels'          => json_encode($labels),
            'chartPenjualan'  => json_encode(array_values($totalPenjualan)),
            'chartPengeluaran' => json_encode(array_values($totalPengeluaran)),
            'chartLabaBersih' => json_encode(array_values($labaBersih)),
        ]);
    }

    public function karyawan_dashboard()
    {
        $periode = $this->request->getGet('periode') ?? 'bulanan';
        $range = $this->getDateRange($periode);

        $start = $range['start'];
        $end   = $range['end'];

        $penjualanPaginated = $this->penjualanModel->getPenjualanPaginated($periode, 10);
        $penjualanPager     = $this->penjualanModel->pager;

        $pengeluaranPaginated = $this->trxPengeluaranModel->getPengeluaranPaginated($periode, 10);
        $pengeluaranPager     = $this->trxPengeluaranModel->pager;

        return view('pages/karyawan/dashboard/index', [
            'periode'            => $periode,
            'start'              => $start,
            'end'                => $end,
            'dataPenjualan'      => $penjualanPaginated,
            'penjualanPager'     => $penjualanPager,
            'dataPengeluaran'    => $pengeluaranPaginated,
            'pengeluaranPager'   => $pengeluaranPager
        ]);
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

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Penjualan extends BaseController
{
    public function admin_index()
    {
        $id_penjualan = $this->request->getGet('id_trx');

        // Default value
        $penjualan = null;
        $penjualan_items = [];

        // Jika user memilih transaksi tertentu
        if ($id_penjualan) {
            // Cek apakah penjualan valid
            $penjualan = $this->penjualanModel->find($id_penjualan);

            if ($penjualan) {
                // Ambil semua item produk dari penjualan ini + join produk
                $penjualan_items = $this->penjualanProdukModel
                    ->select('penjualan_produk.*, produk.nama_produk, produk.harga, promo.nama_promo as nama_promo, promo.tipe as tipe_promo, promo.nilai as nilai_promo')
                    ->join('produk', 'produk.id_produk = penjualan_produk.id_produk', 'left')
                    ->join('promo', 'promo.id_promo = produk.id_promo', 'left')
                    ->where('penjualan_produk.id_penjualan', $id_penjualan)
                    ->findAll();
            } else {
                // Kalau id_penjualan gak ditemukan
                session()->setFlashdata('error', 'Transaksi tidak ditemukan.');
                return redirect()->to(base_url('owner/penjualan'));
            }
        }

        // Ambil semua produk aktif
        $daftarProduk = $this->produkModel
            ->orderBy('nama_produk', 'ASC')
            ->findAll();

        return view('pages/owner/penjualan/index', [
            'daftar_produk'   => $daftarProduk,
            'penjualan_items' => $penjualan_items,
            'penjualan'       => $penjualan,
            'id_penjualan'    => $id_penjualan ?? '',
        ]);
    }


    public function tambah_produk()
    {
        // Ambil data dari request (misalnya lewat AJAX atau form)
        $id_produk = $this->request->getPost('id_produk');
        $jumlah    = $this->request->getPost('jumlah') ?? 1;
        $id        = $this->request->getGet('id_trx');


        // --- 1. Jika penjualan dengan ID tsb tidak ada, buat baru ---
        if (!$id) {
            $penjualanData = [
                'tanggal'     => date('Y-m-d H:i:s'),
                'total'       => 0,
                'total_diskon' => 0,
                'grand_total' => 0,
            ];
            $this->penjualanModel->insert($penjualanData);
            $id = $this->penjualanModel->getInsertID();
        }

        // --- 2. Ambil data produk (harga dan promo) ---
        $produk = $this->produkModel
            ->select('produk.*, promo.tipe as promo_tipe, promo.nilai as promo_nilai')
            ->join('promo', 'promo.id_promo = produk.id_promo', 'left')
            ->find($id_produk);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $harga = $produk['harga'];
        $diskon = 0;

        // Hitung diskon jika ada promo
        if ($produk['id_promo']) {
            if ($produk['promo_tipe'] == 'persen') {
                $diskon = ($produk['promo_nilai'] / 100) * $harga;
            } else {
                $diskon = $produk['promo_nilai'];
            }
        }

        $subtotal = $harga * $jumlah;
        $total_diskon = $diskon * $jumlah;
        $total = $subtotal - $total_diskon;

        // --- 3. Simpan produk ke tabel penjualan_produk ---
        $this->penjualanProdukModel->insert([
            'id_penjualan' => $id,
            'id_produk'    => $id_produk,
            'jumlah'       => $jumlah,
            'harga_satuan' => $harga,
            'diskon'       => $diskon,
            'subtotal'     => $subtotal,
            'total'        => $total,
        ]);

        // --- 4. Update total penjualan ---
        $total_penjualan = $this->penjualanProdukModel
            ->where('id_penjualan', $id)
            ->selectSum('total')
            ->get()
            ->getRow()
            ->total ?? 0;

        $total_diskon_all = $this->penjualanProdukModel
            ->where('id_penjualan', $id)
            ->selectSum('diskon')
            ->get()
            ->getRow()
            ->diskon ?? 0;

        $this->penjualanModel->update($id, [
            'total_harga'  => $total_penjualan + $total_diskon_all,
            'total_diskon' => $total_diskon_all,
            'grand_total'  => $total_penjualan,
        ]);

        return redirect()->to('/owner/penjualan?id_trx=' . $id)->with('success', 'Produk berhasil ditambahkan.');
    }


    public function hapus_produk($id = null)
    {
        // --- 1. Ambil data produk yang akan dihapus ---
        $produk = $this->penjualanProdukModel->find($id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $id_penjualan = $produk['id_penjualan'];

        // --- 2. Hapus produk dari penjualan_produk ---
        $this->penjualanProdukModel->delete($id);

        // --- 3. Hitung ulang total penjualan ---
        $total_penjualan = $this->penjualanProdukModel
            ->where('id_penjualan', $id_penjualan)
            ->selectSum('total')
            ->get()
            ->getRow()
            ->total ?? 0;

        $total_diskon_all = $this->penjualanProdukModel
            ->where('id_penjualan', $id_penjualan)
            ->selectSum('diskon')
            ->get()
            ->getRow()
            ->diskon ?? 0;

        $this->penjualanModel->update($id_penjualan, [
            'total_harga'  => $total_penjualan + $total_diskon_all,
            'total_diskon' => $total_diskon_all,
            'grand_total'  => $total_penjualan,
        ]);

        return redirect()->to('/owner/penjualan?id_trx=' . $id_penjualan)->with('success', 'Produk berhasil dihapus.');
    }

    public function simpan_penjualan($id)
    {
        $this->penjualanModel->update($id, [
            'status'  => 'selesai',
        ]);

        return redirect()->to('/owner/penjualan')->with('success', 'Catatan berhasil disimpan.');
    }

    public function batalkan_penjualan($id)
    {
        return redirect()->to('/owner/penjualan')->with('success', 'Catatan berhasil dibatalkan.');
    }

    public function hapus_penjualan($id)
    {
        // Ambil data penjualan
        $penjualan = $this->penjualanModel->find($id);

        if (!$penjualan) {
            return redirect()->back()->with('error', 'Data penjualan tidak ditemukan');
        }

        // Hapus detail penjualan terlebih dahulu
        $this->penjualanProdukModel->where('id_penjualan', $id)->delete();

        // Hapus transaksi penjualan
        $this->penjualanModel->delete($id);

        return redirect()->back()->with('success', 'Transaksi penjualan berhasil dihapus');
    }
}

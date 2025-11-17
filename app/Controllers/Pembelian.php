<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pembelian extends BaseController
{
    public function admin_index()
    {
        $pengeluaran = $this->pengeluaranModel->findAll();
        return view('pages/owner/pembelian/index', [
            'pengeluaran' => $pengeluaran
        ]);
    }

    public function karyawan_index()
    {
        $pengeluaran = $this->pengeluaranModel->findAll();
        return view('pages/karyawan/pembelian/index', [
            'pengeluaran' => $pengeluaran
        ]);
    }

    public function simpan()
    {
        // Validasi input
        $this->validation->setRules([
            'tanggal_pengeluaran' => 'required|valid_date',
            'harga_satuan'      => 'required|decimal',
            'id_pengeluaran'    => 'required|decimal',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        if (!$this->request->getPost('jumlah')) {
            $jumlah = 1;
        }

        // Ambil input
        $id_pengeluaran  = $this->request->getPost('id_pengeluaran');
        $tanggal_pengeluaran = $this->request->getPost('tanggal_pengeluaran');
        $jumlah    = $jumlah;
        $harga     = $this->request->getPost('harga_satuan');
        $total     = $jumlah * $harga;
        $nama_pengeluaran = $id_pengeluaran;

        $pengeluaran = $this->pengeluaranModel->find($id_pengeluaran);

        if (empty($pengeluaran)) {
            $id_pengeluaran = $this->pengeluaranModel->insert([
                'nama_pengeluaran'       => $nama_pengeluaran,
                'kategori'         => 'bahan_penolong',
                'satuan'           => 'pcs',
                'harga_satuan' => $harga,
            ], true);
        } else {
            $id_pengeluaran = $pengeluaran['id_pengeluaran'];
            $nama_pengeluaran = $pengeluaran['nama_pengeluaran'];
        }

        // Simpan ke tabel pembelian_bahan
        $this->trxPengeluaranModel->insert([
            'id_pengeluaran'          => $id_pengeluaran,
            'nama_pengeluaran'        => $nama_pengeluaran,
            'tanggal_pengeluaran' => $tanggal_pengeluaran,
            'jumlah'            => $jumlah,
            'harga_satuan'      => $harga,
            'total_harga'       => $total,
        ]);

        // Update stok bahan di tabel pembelianuksi
        $bahan = $this->pengeluaranModel->find($id_pengeluaran);
        if ($bahan) {
            if ($harga != $bahan['harga_satuan']) {
                $this->pengeluaranModel->update($id_pengeluaran, ['harga_satuan' => $harga]);
            }
        }

        return redirect()->back()->with('success', 'Pembelian berhasil ditambahkan!');
    }

    public function hapus_pengeluaran($id)
    {
        $pengeluaran = $this->trxPengeluaranModel->find($id);

        if (!$pengeluaran) {
            return redirect()->back()->with('error', 'Data pengeluaran tidak ditemukan');
        }

        // Hapus data
        $this->trxPengeluaranModel->delete($id);

        return redirect()->back()->with('success', 'Pengeluaran berhasil dihapus');
    }
}

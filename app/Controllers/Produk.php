<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\HPPService;


class Produk extends BaseController
{
    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $hppService = new HPPService();
        $daftarProduk = $this->produkModel->getProdukDetail($keyword);

        foreach ($daftarProduk as $index => $produk) {
            $daftarProduk[$index]['hpp'] = $hppService->hitungHPP($produk['id_produk']);
        }

        return view('pages/owner/produk/index', [
            'daftar_produk' => $daftarProduk,
            'keyword'       => $keyword
        ]);
    }

    public function form_tambah()
    {
        $daftarBahan = $this->pengeluaranModel
            ->whereIn('kategori', ['bahan_utama', 'bahan_pendukung'])
            ->findAll();

        $daftarPromo = $this->promoModel->where('status', 'aktif')->findAll();

        return view('pages/owner/produk/form_tambah', [
            'daftar_bahan' => $daftarBahan,
            'daftar_promo' => $daftarPromo
        ]);
    }

    public function simpan()
    {
        // Atur rules validasi
        $rules = [
            'nama_produk' => 'required|min_length[3]',
            'harga'       => 'required|decimal',
            'margin'      => 'permit_empty|decimal',
            'deskripsi'   => 'permit_empty',
            'id_promo'    => 'permit_empty|integer',
            'foto'        => [
                'rules'  => 'is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]|max_size[foto,2048]',
                'errors' => [
                    'is_image' => 'File yang diupload harus berupa gambar.',
                    'mime_in'  => 'Hanya boleh file JPG, JPEG, atau PNG.',
                    'max_size' => 'Ukuran gambar maksimal 2MB.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validation->getErrors());
        }

        // Ambil input dari form
        $nama_produk = $this->request->getPost('nama_produk');
        $harga       = $this->request->getPost('harga');
        $hpp         = $this->request->getPost('hpp') ?? 0;
        $margin      = $this->request->getPost('margin') ?? 0;
        $deskripsi   = $this->request->getPost('deskripsi');
        $id_promo    = $this->request->getPost('id_promo') ?: null;

        // Proses upload gambar
        $foto = $this->request->getFile('foto');
        $namaFile = null;

        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $namaFile = $foto->getRandomName();
            $foto->move('uploads/produk', $namaFile);
        }

        // Hitung ulang margin jika perlu
        if ($hpp > 0 && $harga > 0) {
            $margin = (($harga - $hpp) / $hpp) * 100;
        }

        // Simpan ke database
        $this->produkModel->insert([
            'nama_produk' => $nama_produk,
            'harga'       => $harga,
            'hpp'         => $hpp,
            'margin'      => $margin,
            'deskripsi'   => $deskripsi,
            'id_promo'    => $id_promo,
            'foto'        => $namaFile,
        ]);

        $idProdukBaru = $this->produkModel->getInsertID();

        return redirect()->to('/owner/produk/edit/' . $idProdukBaru)->with('success', 'Produk berhasil disimpan!');
    }

    public function form_edit($id)
    {
        $daftarBahan = $this->pengeluaranModel
            ->whereIn('kategori', ['bahan_utama', 'bahan_penolong'])
            ->findAll();
        $produk = $this->produkModel->find($id);
        $daftarPromo = $this->promoModel->where('status', 'aktif')->findAll();
        $bahanProduk = $this->bahanProdukModel
            ->select('bahan_produk.*, pengeluaran.nama_pengeluaran, pengeluaran.harga_satuan, pengeluaran.kategori')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = bahan_produk.id_bahan')
            ->where('bahan_produk.id_produk', $id)
            ->findAll();

        $hpp = $this->hppService->hitungHPP($id);

        return view('pages/owner/produk/form_edit', [
            'daftar_bahan' => $daftarBahan,
            'daftar_promo' => $daftarPromo,
            'produk' => $produk,
            'bahan_produk' => $bahanProduk,
            'hpp_per_unit' => $hpp
        ]);
    }

    public function update($id)
    {
        // Ambil data produk lama
        $produk = $this->produkModel->find($id);
        if (!$produk) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk tidak ditemukan");
        }

        // Ambil input dari form
        $nama_produk = $this->request->getPost('nama_produk');
        $harga       = $this->request->getPost('harga');
        $hpp         = $this->request->getPost('hpp');
        $margin      = $this->request->getPost('margin');
        $deskripsi   = $this->request->getPost('deskripsi');
        $id_promo    = $this->request->getPost('id_promo');

        // Ambil file foto (jika ada)
        $foto = $this->request->getFile('foto');
        $namaFile = $produk['foto']; // default pakai foto lama

        // Jika ada file baru diupload
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Hapus foto lama kalau ada
            if (!empty($produk['foto']) && file_exists('uploads/produk/' . $produk['foto'])) {
                unlink('uploads/produk/' . $produk['foto']);
            }

            // Simpan foto baru
            $namaFile = $foto->getRandomName();
            $foto->move('uploads/produk', $namaFile);
        }

        // Update data produk
        $this->produkModel->update($id, [
            'nama_produk' => $nama_produk,
            'harga'       => $harga,
            'hpp'         => $hpp,
            'margin'      => $margin,
            'deskripsi'   => $deskripsi,
            'id_promo'    => $id_promo ? $id_promo : null,
            'foto'        => $namaFile,
        ]);

        // Redirect atau tampilkan pesan sukses
        return redirect()->to('/owner/produk')->with('success', 'Produk berhasil diperbarui.');
    }


    public function hapus($id)
    {
        $produk = $this->produkModel->find($id);
        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        // Hapus bahan-bahan terkait produk
        $this->bahanProdukModel->where('id_produk', $id)->delete();

        // Hapus produk
        $this->produkModel->delete($id);

        return redirect()->to('/owner/produk')->with('success', 'Produk berhasil dihapus.');
    }

    public function tambah_bahan($id)
    {
        $id_bahan = $this->request->getPost('id_bahan');
        $jumlah   = $this->request->getPost('jumlah');
        $output_produksi   = $this->request->getPost('output_produksi');

        $bahan = $this->pengeluaranModel->find($id_bahan);

        // validasi sederhana
        if (!$id_bahan || !$jumlah || empty($bahan)) {
            session()->setFlashdata('error', 'Data bahan tidak lengkap.');
            return redirect()->back();
        }

        $this->bahanProdukModel->insert([
            'id_produk' => $id,
            'id_bahan'  => $id_bahan,
            'jumlah'    => $jumlah,
            'satuan'    => $bahan['satuan'],
            'output'    => $output_produksi,
        ]);

        $hppService = new HPPService();

        $hppService->hitungHPP($id);

        return redirect()->to("/owner/produk/edit/$id")->with('success', 'bahan berhasil ditambahkan.');;
    }

    /**
     * Hapus bahan dari produk
     */
    public function hapus_bahan($id)
    {
        $bahan = $this->bahanProdukModel->find($id);

        if (!$bahan) {
            session()->setFlashdata('error', 'Bahan tidak ditemukan.');
            return redirect()->back();
        }

        $id_produk = $bahan['id_produk'];

        $this->bahanProdukModel->delete($id);

        return redirect()->to("/owner/produk/edit/$id_produk");
    }

    public function detail($id)
    {
        // Ambil detail produk + promo + semua bahan baku dalam 1 query (efisien!)
        $produk = $this->produkModel->select("
            produk.*,
            promo.nama_promo,
            promo.tipe AS tipe_promo,
            promo.nilai AS nilai_promo,
            promo.tanggal_mulai,
            promo.tanggal_selesai,
            promo.status AS status_promo,
            
            GROUP_CONCAT(pengeluaran.nama_pengeluaran SEPARATOR '||') AS nama_bahan,
            GROUP_CONCAT(bahan_produk.jumlah SEPARATOR '||') AS jumlah_bahan,
            GROUP_CONCAT(bahan_produk.output SEPARATOR '||') AS output_produksi,
            GROUP_CONCAT(pengeluaran.satuan SEPARATOR '||') AS satuan_bahan,
            GROUP_CONCAT(pengeluaran.harga_satuan SEPARATOR '||') AS harga_bahan_satuan
        ")
            ->join('promo', 'promo.id_promo = produk.id_promo', 'left')
            ->join('bahan_produk', 'bahan_produk.id_produk = produk.id_produk', 'left')
            ->join('pengeluaran', 'pengeluaran.id_pengeluaran = bahan_produk.id_bahan', 'left')
            ->where('produk.id_produk', $id)
            ->groupBy('produk.id_produk')
            ->first();

        // Jika produk tidak ditemukan
        if (!$produk) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Produk tidak ditemukan');
        }

        $produk['hpp'] = $this->hppService->hitungHPP($produk['id_produk']);

        $biayaBahanBaku = $this->bahanProdukModel->biayaBahanBaku($produk['id_produk']);

        // Pisahkan bahan baku jadi array yang rapi
        $bahanList = [];
        if ($produk['nama_bahan']) {
            $nama   = explode('||', $produk['nama_bahan']);
            $jumlah = explode('||', $produk['jumlah_bahan']);
            $outputProduksi = explode('||', $produk['output_produksi']);
            $satuan = explode('||', $produk['satuan_bahan']);
            $harga  = explode('||', $produk['harga_bahan_satuan']);

            for ($i = 0; $i < count($nama); $i++) {
                $bahanList[] = [
                    'nama_bahan'      => $nama[$i] ?? '-',
                    'jumlah'          => $jumlah[$i] ?? '0',
                    'output_produksi' => $outputProduksi[$i] ?? '0',
                    'satuan'          => $satuan[$i] ?? '',
                    'harga_satuan'    => $harga[$i] ?? '0',
                    'subtotal'        => (float)($harga[$i] ?? 0) * (float)($jumlah[$i] ?? 0),
                ];
            }
        }

        $data = [
            'produk'     => $produk,
            'bahan'      => $bahanList,
            'promo_aktif' => $produk['status_promo'] === 'aktif'
                && $produk['tanggal_mulai'] <= date('Y-m-d')
                && $produk['tanggal_selesai'] >= date('Y-m-d'),
            'biaya_bahan_baku' => $biayaBahanBaku,
        ];

        return view('pages/owner/produk/detail', $data);
    }
}

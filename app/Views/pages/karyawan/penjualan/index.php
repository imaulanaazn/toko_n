<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<?php

function countTotal($item)
{
    // Pastikan semua nilai numerik valid
    $jml = (float) $item['jumlah'];
    $harga_satuan = (float) $item['harga_satuan'];
    $nilai_promo = (float) $item['nilai_promo'];
    $tipe_promo = $item['tipe_promo'] ?? '';


    // Total harga sebelum diskon
    $subtotal = $harga_satuan * $jml;

    // Hitung diskon per unit
    $diskon_per_item = 0;

    if (!empty($tipe_promo)) {
        if ($tipe_promo === 'persen') {
            $diskon_per_item = ($nilai_promo / 100) * $harga_satuan;
        } elseif ($tipe_promo === 'nominal') {
            $diskon_per_item = $nilai_promo;
        }
    }

    // Total diskon = diskon per item * jumlah
    $total_diskon = $diskon_per_item * $jml;

    // Total akhir setelah diskon
    $grand_total = $subtotal - $total_diskon;

    // Return hasil dalam bentuk array biar fleksibel
    return [
        'harga_satuan' => $harga_satuan,
        'subtotal'     => $subtotal,
        'diskon'       => $total_diskon,
        'grand_total'  => $grand_total,
    ];
}

?>
<div class="w-full flex flex-col items-center gap-6 justify-center">
    <div class="w-full max-w-full mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-5/12!">
        <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                <h5 class="">Catat Penjualan</h5>
            </div>

            <div class="flex-auto p-6">
                <?= view('components/alert') ?> <!-- panggil komponen alert -->
                <form role="form text-left" action="/karyawan/penjualan/tambah_produk <?= $id_penjualan ? '?id_trx=' . $id_penjualan : '' ?>" method="POST">
                    <input type="text" hidden value="<?= $id_penjualan ?>">
                    <div class="mb-4">
                        <label for="" class="mb-2">Tanggal Penjualan</label>
                        <input type="date" name="tanggal_penjualan" value="<?= date('Y-m-d'); ?>" required class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Nama Bahan">
                    </div>
                    <div class="mb-4">
                        <label for="0" class="mb-2">Nama Produk</label>
                        <select id="select-produk" name="id_produk" placeholder="Pilih Bahan..." autocomplete="off" required>
                            <?php foreach ($daftar_produk as $produk): ?>
                                <option value="<?= $produk['id_produk'] ?>"><?= $produk['nama_produk'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" value="1" required class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Jumlah" aria-label="Email">
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2" id="harga_label">Harga / <?= $produk['satuan'] ?></label>
                        <input type="number" name="harga_satuan" id="harga_satuan" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Harga Satuan">
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submit_btn" class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-blue-800 uppercase align-middle transition-all bg-transparent border border-solid! border-blue-800! rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:border-slate-700">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php if ($id_penjualan): ?>
        <div class="w-full max-w-full mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-5/12!">
            <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                    <h5 class="">Keranjang</h5>
                </div>

                <div class="flex-auto p-6">
                    <?= view('components/alert') ?> <!-- panggil komponen alert -->
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Item</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Subtotal</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Promo</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Grand Total</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($penjualan_items)): ?>
                                    <?php foreach ($penjualan_items as $item): ?>
                                        <tr>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="mb-0 text-xs font-semibold leading-tight"><?= $item['nama_produk'] ?></p>
                                            </td>
                                            <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= $item['jumlah'] ?> x <?= format_rupiah($item['harga']) ?></span>
                                            </td>
                                            <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah(countTotal($item)['subtotal']) ?></span>
                                            </td>
                                            <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight text-slate-400">-<?= $item['nilai_promo'] ?><?= $item['tipe_promo'] == 'persen' ? '%' : '' ?></span>
                                            </td>
                                            <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah(countTotal($item)['grand_total']) ?></span>
                                            </td>
                                            <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <a href="/karyawan/penjualan/hapus_produk/<?= $item['id'] ?>" class="text-xs font-bold uppercase! underline leading-tight text-slate-600"> Hapus </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex gap-2 mt-4 pl-2">
                        <h6>Total :</h6>
                        <p><?= format_rupiah($penjualan['grand_total']) ?></p>
                    </div>
                    <form action="">
                        <div class="flex gap-4">
                            <a href="/karyawan/penjualan/batal/<?= $id_penjualan ?>" class="inline-block w-full px-6 py-3 mt-4 mb-2 font-bold text-center text-blue-800 uppercase align-middle transition-all bg-transparent border border-solid! border-blue-800! rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:border-slate-700">Batal</a>
                            <a href="/karyawan/penjualan/simpan/<?= $id_penjualan ?>" class="inline-block w-full px-6 py-3 mt-4 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Simpan</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    const selectBahan = document.getElementById('select-produk');
    const jumlahInput = document.getElementById('jumlah');
    const hargaSatuanInput = document.getElementById('harga_satuan');
    const hargaLabel = document.getElementById('harga_label');
    const daftarProduk = <?= json_encode($daftar_produk) ?>;

    new TomSelect("#select-produk", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    selectBahan.addEventListener('change', (e) => {
        const selectedProduk = daftarProduk.find((produk) => {
            return produk.id_produk == e.target.value;
        })
        if (selectedProduk) {
            hargaSatuanInput.value = selectedProduk.harga;
            hargaLabel.innerHTML = 'Harga / ' + selectedProduk.satuan;
        }
    })

    const selectedProduk = daftarProduk.find((produk) => {
        return produk.id_produk == selectBahan.value;
    })

    hargaLabel.innerHTML = 'Harga / ' + selectedProduk.satuan;
    hargaSatuanInput.value = selectedProduk.harga;
</script>
<?= $this->endSection() ?>
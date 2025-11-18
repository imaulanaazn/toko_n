<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="md:flex">
        <!-- Gambar -->
        <div class="md:w-1/3 bg-gray-100 p-8 flex items-center justify-center">
            <img src="<?= base_url('uploads/produk/' . $produk['foto']) ?>"
                alt="<?= esc($produk['nama_produk']) ?>"
                class="max-w-full max-h-96 object-cover rounded-lg shadow">
        </div>

        <!-- Info -->
        <div class="md:w-2/3 p-6 space-y-6">
            <div>
                <h1 class="text-2xl! font-bold text-slate-700 text-center lg:text-left!"><?= esc($produk['nama_produk']) ?></h1>
                <p class="text-slate-500 mt-3! text-center lg:text-left!"><?= esc($produk['deskripsi']) ?: 'Tidak ada deskripsi' ?></p>
            </div>

            <!-- Harga & Margin -->
            <div class="grid grid-cols-2 gap-4 text-center mb-4!">
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="text-sm text-green-600 mb-1!">Harga Jual</p>
                    <p class="text-xl font-bold text-green-700 mb-0!">Rp <?= number_format($produk['harga']) ?></p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <p class="text-sm text-blue-600 mb-1!">Margin</p>
                    <p class="text-xl font-bold text-blue-700 mb-0!">Rp <?= number_format($produk['harga'] * $produk['margin'] / 100) ?></p>
                </div>
            </div>

            <!-- Promo -->
            <?php if ($promo_aktif): ?>
                <div class="bg-red-50 text-red-600 p-4 rounded-lg font-semibold text-center shadow-none!">
                    PROMO: <?= $produk['tipe_promo'] == 'persen' ? $produk['nilai_promo'] . '%' : 'Rp ' . number_format($produk['nilai_promo']) ?>
                    <small>(<?= date('d/m', strtotime($produk['tanggal_mulai'])) ?> - <?= date('d/m/Y', strtotime($produk['tanggal_selesai'])) ?>)</small>
                </div>
            <?php endif; ?>

            <!-- Bahan Baku -->
            <div>
                <h3 class="text-base! font-semibold mb-3 text-slate-700">Resep (Bahan Baku per <?= $produk['satuan'] ?>)</h3>
                <?php if ($bahan): ?>
                    <div class="p-0 overflow-x-auto">

                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-2 pr-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Bahan</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jml</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga Satuan</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Output Produksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bahan as $bahan): ?>
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight text-slate-600"><?= $bahan['nama_bahan'] ?></p>
                                        </td>
                                        <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight text-slate-400"><?= $bahan['jumlah'] ?> <?= $bahan['satuan'] ?></span>
                                        </td>
                                        <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($bahan['harga_satuan']) ?></span>
                                        </td>
                                        <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight text-slate-400"><?= $bahan['output_produksi'] ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                        <div class="flex gap-3 mt-4 justify-end">
                            <p class="font-semibold text-slate-700! mb-0!">Total HPP :</p>
                            <p class="text-slate-600 mb-0!">Rp <?= number_format($produk['hpp']) ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500 italic">Belum ada resep</p>
                <?php endif; ?>
            </div>

            <div class="flex gap-3">
                <a href="<?= previous_url() ?: base_url('produk') ?>" class="inline-block w-full px-6 py-3 font-bold text-center text-slate-700! uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border! border-slate-800! hover:border-slate-700">Kembali</a>
                <a href="/owner/produk/edit/<?= $produk['id_produk'] ?>" class="inline-block w-full px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Edit</a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>

</script>
<?= $this->endSection() ?>
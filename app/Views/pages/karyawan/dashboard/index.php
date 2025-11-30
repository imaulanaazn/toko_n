<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="w-full max-w-full lg:flex-none">
    <div class="border-black/12.5 shadow-soft-xl relative flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-4">
        <div class="relative h-full overflow-hidden bg-cover rounded-xl" style="background-image: url('../assets/img/ivancik.jpg')">
            <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
            <div class="relative z-10 flex flex-col flex-auto h-full p-4">
                <h5 class="my-6 font-bold text-white text-center">Selamat Datang, Karyawan</h5>
            </div>
        </div>
    </div>
</div>

<div class="w-full flex mt-6">
    <!-- card 1 -->
    <div class="w-full relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between items-center">
                <h6>Daftar Pengeluaran</h6>
            </div>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2 mt-6">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Pengeluaran</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kategori</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga Satuan</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Total</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPengeluaran as $pengeluaran): ?>
                            <tr>
                                <td class="p-2 pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal text-center"><?= date('d/m/Y', strtotime($pengeluaran['tanggal_pengeluaran']))  ?></h6>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= $pengeluaran['nama_pengeluaran'] ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= $pengeluaran['kategori'] ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= (int) $pengeluaran['jumlah'] ?> <?= $pengeluaran['satuan'] ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($pengeluaran['harga_satuan']) ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($pengeluaran['total_harga']) ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="/karyawan/pembelian/hapus/<?= $pengeluaran['id_trx'] ?>" class="text-xs font-bold uppercase! underline leading-tight text-slate-600"> Hapus </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?= $pengeluaranPager->links('pengeluaran', 'tailwind_pagination') ?>
        </div>
    </div>
</div>

<div class="w-full flex mb-6">
    <!-- card 1 -->
    <div class="w-full relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between items-center">
                <h6>Daftar Penjualan</h6>
            </div>
        </div>
        <div class="flex-auto px-0 pt-0 pb-2 mt-6">
            <div class="p-0 overflow-x-auto">
                <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                    <thead class="align-bottom">
                        <tr>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Produk</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Subtotal</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Diskon</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Grand Total</th>
                            <th class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPenjualan as $penjualan): ?>
                            <tr>
                                <td class="p-2 pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col justify-center text-center">
                                        <h6 class="mb-0 text-sm leading-normal"><?= date('d/m/Y', strtotime($penjualan['tanggal']))  ?></h6>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <ul>
                                        <?php foreach (explode('|', $penjualan['produk_list']) as $produk): ?>
                                            <li class="py-1">
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= $produk ?></span>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <ul>
                                        <?php foreach (explode('|', $penjualan['jumlah_list']) as $jumlah): ?>
                                            <li class="py-1">
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= $jumlah ?></span>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <ul>
                                        <?php foreach (explode('|', $penjualan['harga_satuan_list']) as $harga): ?>
                                            <li class="py-1">
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($harga) ?></span>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <ul>
                                        <?php foreach (explode('|', $penjualan['subtotal_list']) as $subtotal): ?>
                                            <li class="py-1">
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($subtotal) ?></span>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <?php
                                    $produkList = explode('|', $penjualan['produk_list']);
                                    $diskonList = explode('|', $penjualan['diskon_list']);
                                    ?>
                                    <ul>
                                        <?php foreach ($produkList as $index => $produk): ?>
                                            <li class="py-1">
                                                <?php
                                                $diskon = $diskonList[$index] ?? null;
                                                ?>

                                                <?php if ($diskon > 0): ?>
                                                    <span class="text-xs font-semibold leading-tight text-slate-400">
                                                        <?= format_rupiah($diskon) ?>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="text-xs font-semibold leading-tight text-slate-400">-</span>
                                                <?php endif ?>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </td>

                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($penjualan['grand_total']) ?></span>
                                </td>


                                <td class="p-2 pr-6 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="/karyawan/penjualan/hapus/<?= $penjualan['id_penjualan'] ?>" class="text-xs font-bold uppercase! underline leading-tight text-slate-600"> Hapus </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?= $penjualanPager->links('penjualan', 'tailwind_pagination') ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
</script>
<?= $this->endSection(); ?>
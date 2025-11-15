<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="w-full mx-auto mb-6">
    <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
        <div class="flex flex-wrap justify-between">
            <div class="w-full max-w-full px-3 mr-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                <div class="relative">
                    <ul class="relative flex flex-wrap p-1 list-none bg-transparent rounded-xl gap-3">
                        <li class="z-30 flex-auto text-center">
                            <a href="/owner/laporan?periode=harian" class="z-30 <?= $periode == 'harian' ? 'bg-slate-700!' : 'bg-slate-300! text-slate-600!' ?> block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-white">
                                <span class="ml-1">Harian</span>
                            </a>
                        </li>
                        <li class="z-30 flex-auto text-center">
                            <a href="/owner/laporan?periode=mingguan" class="z-30 <?= $periode == 'mingguan' ? 'bg-slate-700!' : 'bg-slate-300! text-slate-600!' ?> block w-full px-0 py-1 mb-0 transition-all border-0 rounded-lg ease-soft-in-out bg-inherit text-white">
                                <span class="ml-1">Mingguan</span>
                            </a>
                        </li>
                        <li class="z-30 flex-auto text-center">
                            <a href="/owner/laporan?periode=bulanan" class="z-30 <?= $periode == 'bulanan' ? 'bg-slate-700!' : 'bg-slate-300! text-slate-600!' ?> block w-full px-0 py-1 mb-0 transition-colors border-0 rounded-lg ease-soft-in-out bg-inherit text-white">
                                <span class="ml-1">Bulanan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex-none w-auto max-w-full px-3 my-auto">
                <div class="h-full">
                    <p class="mb-0 font-semibold leading-normal text-sm">CEO / Co-Founder</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-wrap -mx-3">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Biaya Operasional</p>
                            <h5 class="mb-0 font-bold">
                                <?= format_rupiah($totalOperasional) ?>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Jumlah Produk Terjual</p>
                            <h5 class="mb-0 font-bold">
                                <?= $totalProdukTerjual ?>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Transaksi</p>
                            <h5 class="mb-0 font-bold">
                                +3,462
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card4 -->
    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Rata Rata Transaksi</p>
                            <h5 class="mb-0 font-bold">
                                $103,430
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-wrap -mx-3 my-6">
    <!-- card1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Hpp</p>
                            <h5 class="mb-0 font-bold">
                                <?= format_rupiah($totalHPP) ?>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Penjualan</p>
                            <h5 class="mb-0 font-bold">
                                <?= format_rupiah($totalPenjualan) ?>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Laba Kotor</p>
                            <h5 class="mb-0 font-bold">
                                <?= format_rupiah($labaKotor) ?>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- card4 -->
    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Laba Bersih</p>
                            <h5 class="mb-0 font-bold">
                                <?= format_rupiah($labaBersih) ?>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- cards row 4 -->

<div class="w-full flex my-6">
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
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Pengeluaran</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kategori</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga Satuan</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Total</th>
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPengeluaran as $pengeluaran): ?>
                            <tr>
                                <td class="p-2 pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal"><?= $pengeluaran['created_at'] ?></h6>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= $pengeluaran['nama_pengeluaran'] ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= 'kategori' ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= $pengeluaran['jumlah'] ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= $pengeluaran['harga_satuan'] ?></span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= $pengeluaran['total_harga'] ?></span>
                                </td>
                                <td class="p-2 pr-6 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> Detail </a>
                                    <span>|</span>
                                    <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                                    <span>|</span>
                                    <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> Hapus </a>
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

<div class="w-full flex my-6">
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
                            <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Pengeluaran</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kategori</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga Satuan</th>
                            <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Total</th>
                            <th class="px-6 py-3 font-semibold capitalize align-middle bg-transparent border-b border-gray-200 border-solid shadow-none tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataPenjualan as $penjualan): ?>
                            <tr>
                                <td class="p-2 pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col justify-center">
                                        <h6 class="mb-0 text-sm leading-normal"><?= $penjualan['created_at'] ?></h6>
                                    </div>
                                </td>
                                <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent flex gap-1 justify-between">
                                    <ul>
                                        <?php foreach (explode('|', $penjualan['produk_list']) as $produk): ?>
                                            <li>
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= $produk ?></span>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                    <ul>
                                        <?php foreach (explode('|', $penjualan['jumlah_list']) as $jumlah): ?>
                                            <li>
                                                <span class="text-xs font-semibold leading-tight text-slate-400">x <?= $jumlah ?></span>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </td>

                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <ul>
                                        <?php foreach (explode('|', $penjualan['subtotal_list']) as $subtotal): ?>
                                            <li>
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= $subtotal ?></span>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </td>

                                <td class="p-2 pr-6 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> Detail </a>
                                    <span>|</span>
                                    <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> Edit </a>
                                    <span>|</span>
                                    <a href="javascript:;" class="text-xs font-semibold leading-tight text-slate-400"> Hapus </a>
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
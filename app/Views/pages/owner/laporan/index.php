<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="w-full mx-auto mb-6">
    <div class="relative flex flex-col flex-auto min-w-0 p-6 md:p-0! overflow-hidden break-words bg-white md:bg-transparent! rounded-2xl md:shadow-none! shadow-sm! shadow-gray-200!">
        <div class="flex gap-4 justify-between items-center">
            <div class="flex items-center gap-4 w-full max-w-full md:w-auto!">
                <div class="hidden lg:block w-full max-w-full mr-auto mt-4 sm:my-auto sm:mr-0 md:flex-none lg:w-max!">
                    <div class="flex gap-4">
                        <a href="/owner/laporan?periode=harian" class="flex-1 inline-block px-6 py-2.5 font-semibold text-center uppercase align-middle transition-all rounded-full cursor-pointer text-white shadow-sm! shadow-gray-200! <?= $periode == 'harian' ? 'bg-emerald-800!' : 'bg-white! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Harian</a>
                        <a href="/owner/laporan?periode=mingguan" class="flex-1 inline-block px-6 py-2.5 font-semibold text-center uppercase align-middle transition-all rounded-full cursor-pointer text-white shadow-sm! shadow-gray-200! <?= $periode == 'mingguan' ? 'bg-emerald-800!' : 'bg-white! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Mingguan</a>
                        <a href="/owner/laporan?periode=bulanan" class="flex-1 inline-block px-6 py-2.5 font-semibold text-center uppercase align-middle transition-all rounded-full cursor-pointer text-white shadow-sm! shadow-gray-200! <?= $periode == 'bulanan' ? 'bg-emerald-800!' : 'bg-white! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Bulanan</a>
                        <a href="/owner/laporan?periode=bulan-lalu" class="flex-1 inline-block px-6 py-2.5 font-semibold text-center uppercase align-middle transition-all rounded-full cursor-pointer text-white shadow-sm! shadow-gray-200! text-nowrap <?= $periode == 'bulan-lalu' ? 'bg-emerald-800!' : 'bg-white! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Bulan Lalu</a>
                    </div>
                </div>
                <div class="text-slate-300 hidden lg:block">|</div>
                <div class="w-full md:w-auto! max-w-full my-auto md:my-0!">
                    <select name="" id="produk_id" class="w-full md:w-max! focus:shadow-soft-primary-outline leading-5.6 ease-soft block rounded-full! border-0! shadow-sm! shadow-gray-200! bg-white bg-clip-padding px-3 py-3 md:py-2! text-sm! font-semibold text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        <option value="">Semua</option>
                        <?php foreach ($daftarProduk as $p): ?>
                            <option value="<?= $p['id_produk'] ?>" <?= $p['id_produk'] == $produk_id ? 'selected' : '' ?>><?= $p['nama_produk'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <select name="" id="periode_filter" class="lg:hidden! w-full md:w-max! focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block rounded-full shadow-sm! bg-white bg-clip-padding px-3 py-3 md:py-2! font-semibold text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    <option <?= $periode == 'harian' ? 'selected' : '' ?> value="/owner/laporan?periode=harian">Harian</option>
                    <option <?= $periode == 'mingguan' ? 'selected' : '' ?> value="/owner/laporan?periode=mingguan">Mingguan</option>
                    <option <?= $periode == 'bulanan' ? 'selected' : '' ?> value="/owner/laporan?periode=bulanan">Bulanan</option>
                    <option <?= $periode == 'bulan-lalu' ? 'selected' : '' ?> value="/owner/laporan?periode=bulan-lalu">Bulan Lalu</option>
                </select>
            </div>
            <div class="hidden md:block">
                <div class="w-full flex items-center md:w-max! shrink-0 hidden md:inline-block! px-4 py-3 bg-white shadow-sm! rounded-full cursor-pointer border-slate-300! font-semibold text-sm! ease-soft-in tracking-tight-soft ">
                    <span class="font-sans font-medium leading-normal text-sm">
                        <?= date('d/m/Y', strtotime($start)) ?>
                        <?php if (date('d/m/Y', strtotime($start)) != date('d/m/Y', strtotime($end))) : ?>
                            <span class="mx-1">-</span> <?= date('d/m/Y', strtotime($end)) ?>
                        <?php endif ?>
                    </span>
                    <span class="px-1 text-gray-300">|</span>
                    <a href="/owner/laporan/cetak_ringkasan?periode=<?= $periode ?>&produk_id=<?= $produk_id ?>" class="w-full md:w-max! shrink-0 font-semibold text-center uppercase align-middle transition-all bg-white rounded-full cursor-pointer text-xs text-emerald-700!">Export PDF <i class="fa-solid fa-file-arrow-down"></i></a>
                </div>
            </div>
        </div>
        <a href="/owner/laporan/cetak_ringkasan?periode=<?= $periode ?>&produk_id=<?= $produk_id ?>" class="w-full md:w-max! mt-4 md:hidden shrink-0 px-4 py-3 mr-3 font-semibold text-center uppercase align-middle transition-all bg-white rounded-full cursor-pointer shadow-sm! leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-slate-600">Export PDF <i class="fa-solid fa-file-arrow-down"></i>
        </a>
    </div>
</div>

<div class="">
    <div class="flex flex-wrap -mx-3 mb-6 md:mb-0! xl:mb-4!">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 lg:px-2! mb-4 xl:mb-0! sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words rounded-2xl bg-clip-border bg-white shadow-sm! shadow-gray-200!">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans leading-normal text-sm">Biaya Operasional</p>
                                <h5 class="mb-0 font-semibold text-2xl! mt-6">
                                    <?= format_rupiah($totalOperasional) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-white border border-emerald-700! bg-emerald-50! opacity-80">
                                <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-emerald-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 lg:px-2! mb-4 xl:mb-0! sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words rounded-2xl bg-clip-border bg-white shadow-sm! shadow-gray-200!">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans leading-normal text-sm">Produk Terjual</p>
                                <h5 class="mb-0 font-semibold text-2xl! mt-6">
                                    <?= $totalProdukTerjual ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-white border border-emerald-700! bg-emerald-50! opacity-80">
                                <i class="fa-solid fa-chart-line text-lg relative top-3.5 text-emerald-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 lg:px-2! mb-4 xl:mb-0! sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words rounded-2xl bg-clip-border bg-white shadow-sm! shadow-gray-200!">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans leading-normal text-sm">Total Transaksi</p>
                                <h5 class="mb-0 font-semibold text-2xl! mt-6">
                                    <?= $totalTransaksi ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-white border border-emerald-700! bg-emerald-50! opacity-80">
                                <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-emerald-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 lg:px-2! sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words rounded-2xl bg-clip-border bg-white shadow-sm! shadow-gray-200!">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans leading-normal text-sm">Rata Rata Transaksi</p>
                                <h5 class="mb-0 font-semibold text-2xl! mt-6">
                                    <?= number_format($rataRataTransaksi, 2); ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-white border border-emerald-700! bg-emerald-50! opacity-80">
                                <i class="ni leading-none ni-cart text-lg relative top-3.5 text-emerald-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 lg:px-2! mb-4 xl:mb-0! sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words rounded-2xl bg-clip-border bg-white shadow-sm! shadow-gray-200!">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans leading-normal text-sm">Total Hpp</p>
                                <h5 class="mb-0 font-semibold text-2xl! mt-6">
                                    <?= format_rupiah($totalHPP) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-white border border-emerald-700! bg-emerald-50! opacity-80">
                                <i class="fa-solid fa-table-columns text-lg relative top-2.5 text-emerald-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 lg:px-2! mb-4 xl:mb-0! sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words rounded-2xl bg-clip-border bg-white shadow-sm! shadow-gray-200!">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans leading-normal text-sm">Total Penjualan</p>
                                <h5 class="mb-0 font-semibold text-2xl! mt-6">
                                    <?= format_rupiah($totalPenjualan) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-white border border-emerald-700! bg-emerald-50! opacity-80">
                                <i class="fa-solid fa-cart-plus text-lg relative top-2.5 text-emerald-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 lg:px-2! mb-4 xl:mb-0! sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words rounded-2xl bg-clip-border bg-white shadow-sm! shadow-gray-200!">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans leading-normal text-sm">Laba Kotor</p>
                                <h5 class="mb-0 font-semibold text-2xl! mt-6">
                                    <?= format_rupiah($labaKotor) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-white border border-emerald-700! bg-emerald-50! opacity-80">
                                <i class="fa-solid fa-money-bill-wheat text-lg relative top-2.5 text-emerald-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 lg:px-2! sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words rounded-2xl bg-clip-border bg-white shadow-sm! shadow-gray-200!">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans leading-normal text-sm">Laba Bersih</p>
                                <h5 class="mb-0 font-semibold text-2xl! mt-6">
                                    <?= format_rupiah($labaBersih) ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-white border border-emerald-700! bg-emerald-50! opacity-80 ">
                                <i class="fa-solid fa-money-bill-1-wave text-lg relative top-2.5 text-emerald-800"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- cards row 4 -->

<div class="w-full flex mt-6 md:mt-3! lg:mt-6!">
    <!-- card 1 -->
    <div class="w-full relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-sm! shadow-gray-200! rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between items-center">
                <h6 class="mb-0!">Daftar Pengeluaran</h6>
                <a href="/owner/laporan/cetak_pengeluaran?periode=<?= $periode ?>&produk_id=<?= $produk_id ?>" class="w-auto md:w-max! shrink-0 px-0 md:px-4! py-2 font-semibold text-center uppercase align-middle transition-all bg-white rounded-full cursor-pointer text-xs text-emerald-700! hover:bg-emerald-50!">Export PDF <i class="fa-solid fa-file-arrow-down"></i></a>
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
                                        <h6 class="mb-0 text-sm leading-normal text-center"><?= date('d-m-Y', strtotime($pengeluaran['tanggal_pengeluaran'])) ?></h6>
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
                                    <a href="/owner/pembelian/hapus/<?= $pengeluaran['id_trx'] ?>" class="text-xs font-bold uppercase! underline leading-tight text-slate-600"> Hapus </a>
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
    <div class="w-full relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-sm! shadow-gray-200! rounded-2xl bg-clip-border">
        <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
            <div class="flex justify-between items-center">
                <h6 class="mb-0!">Daftar Penjualan</h6>
                <a href="/owner/laporan/cetak_penjualan?periode=<?= $periode ?>&produk_id=<?= $produk_id ?>" class="w-auto md:w-max! shrink-0 px-0 md:px-4! py-2 font-semibold text-center uppercase align-middle transition-all bg-white rounded-full cursor-pointer text-xs text-emerald-700! hover:bg-emerald-50!">Export PDF <i class="fa-solid fa-file-arrow-down"></i></a>
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
                                        <h6 class="mb-0 text-sm leading-normal"><?= date('d-m-Y', strtotime($penjualan['tanggal'])) ?></h6>
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
                                    <?php if ($produk_id): ?>
                                        <ul>
                                            <?php foreach (explode('|', $penjualan['total_list']) as $total): ?>
                                                <li class="py-1">
                                                    <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($total) ?></span>
                                                </li>
                                            <?php endforeach ?>
                                        </ul>
                                    <?php else: ?>
                                        <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($penjualan['grand_total']) ?></span>
                                    <?php endif ?>
                                </td>

                                <td class="p-2 pr-6 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="/owner/penjualan/hapus/<?= $penjualan['id_penjualan'] ?>" class="text-xs font-bold uppercase! underline leading-tight text-slate-600"> Hapus </a>
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
    document.addEventListener('DOMContentLoaded', function() {
        const periode = <?= json_encode($periode) ?>;
        document.getElementById('produk_id').addEventListener('change', function() {
            const produkId = this.value;
            const url = '/owner/laporan?produk_id=' + produkId + '&periode=' + periode;
            window.location.href = url;
        });

        document.getElementById('periode_filter').addEventListener('change', function() {
            const periodeValue = this.value;
            const url = periodeValue;
            window.location.href = url;
        });
    });
</script>
<?= $this->endSection(); ?>
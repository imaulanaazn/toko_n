<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="w-full mx-auto mb-6">
    <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
        <div class="flex gap-4 justify-between items-center">
            <div class="hidden lg:block w-full max-w-full mr-auto mt-4 sm:my-auto sm:mr-0 md:flex-none lg:w-max!">
                <div class="flex">
                    <a href="/owner/laporan?periode=harian" class="flex-1 inline-block px-6 py-2 font-bold text-center uppercase align-middle transition-all rounded-l-lg cursor-pointer text-white <?= $periode == 'harian' ? 'bg-slate-700!' : 'bg-white! border border-slate-200! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Harian</a>
                    <a href="/owner/laporan?periode=mingguan" class="flex-1 inline-block px-6 py-2 font-bold text-center uppercase align-middle transition-all cursor-pointer text-white <?= $periode == 'mingguan' ? 'bg-slate-700!' : 'bg-white! border border-slate-200! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Mingguan</a>
                    <a href="/owner/laporan?periode=bulanan" class="flex-1 inline-block px-6 py-2 font-bold text-center uppercase align-middle transition-all cursor-pointer text-white <?= $periode == 'bulanan' ? 'bg-slate-700!' : 'bg-white! border border-slate-200! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Bulanan</a>
                    <a href="/owner/laporan?periode=bulan-lalu" class="flex-1 inline-block px-6 py-2 font-bold text-center uppercase align-middle transition-all rounded-r-lg cursor-pointer text-white text-nowrap <?= $periode == 'bulan-lalu' ? 'bg-slate-700!' : 'bg-white! border border-slate-200! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Bulan Lalu</a>
                </div>
            </div>
            <div class="w-full max-w-full md:w-auto! lg:hidden mr-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none">
                <label for="" class="text-sm mb-1 md:hidden!">Periode</label>
                <select name="" id="periode_filter" class="w-full md:w-max focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                    <option <?= $periode == 'harian' ? 'selected' : '' ?> value="/owner/laporan?periode=harian">Harian</option>
                    <option <?= $periode == 'mingguan' ? 'selected' : '' ?> value="/owner/laporan?periode=mingguan">Mingguan</option>
                    <option <?= $periode == 'bulanan' ? 'selected' : '' ?> value="/owner/laporan?periode=bulanan">Bulanan</option>
                    <option <?= $periode == 'bulan-lalu' ? 'selected' : '' ?> value="/owner/laporan?periode=bulan-lalu">Bulan Lalu</option>
                </select>
            </div>
            <div class="w-full md:w-auto! max-w-full my-auto mt-4 md:my-0!">
                <label for="" class="text-sm mb-1 md:hidden!">Produk</label>
                <div class="h-full flex items-center gap-3">
                    <select name="" id="produk_id" class="w-full md:w-max focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                        <option value="">Semua</option>
                        <?php foreach ($daftarProduk as $p): ?>
                            <option value="<?= $p['id_produk'] ?>" <?= $p['id_produk'] == $produk_id ? 'selected' : '' ?>><?= $p['nama_produk'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <a href="/owner/laporan/cetak?periode=<?= $periode ?>&produk_id=<?= $produk_id ?>" class="w-full md:w-max! shrink-0 hidden md:inline-block! px-4 py-2.5 font-bold text-center uppercase align-middle transition-all bg-transparent border rounded-lg cursor-pointer border-slate-300! leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-slate-600">Export PDF</a>
                </div>
            </div>
        </div>
        <a href="/owner/laporan/cetak?periode=<?= $periode ?>&produk_id=<?= $produk_id ?>" class="w-full md:w-max! mt-4 md:hidden shrink-0 px-4 py-2.5 mr-3 font-bold text-center uppercase align-middle transition-all bg-transparent border rounded-lg cursor-pointer border-slate-300! leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs text-slate-600">Export PDF</a>
    </div>
</div>

<div class="bg-white shadow-soft-xl rounded-xl p-6">
    <div class="flex flex-wrap -mx-3 mb-6 md:mb-0! xl:mb-6!">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
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
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80">
                                <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Produk Terjual</p>
                                <h5 class="mb-0 font-bold">
                                    <?= $totalProdukTerjual ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80">
                                <i class="fa-solid fa-chart-line text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Transaksi</p>
                                <h5 class="mb-0 font-bold">
                                    <?= $totalTransaksi ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80">
                                <i class="ni leading-none ni-paper-diploma text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
                <div class="flex-auto p-4">
                    <div class="flex flex-row -mx-3">
                        <div class="flex-none w-2/3 max-w-full px-3">
                            <div>
                                <p class="mb-0 font-sans font-semibold leading-normal text-sm">Rata Rata Transaksi</p>
                                <h5 class="mb-0 font-bold">
                                    <?= number_format($rataRataTransaksi, 2); ?>
                                </h5>
                            </div>
                        </div>
                        <div class="px-3 text-right basis-1/3">
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80">
                                <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap -mx-3">
        <!-- card1 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
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
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80">
                                <i class="fa-solid fa-table-columns text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card2 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
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
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80">
                                <i class="fa-solid fa-cart-plus text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card3 -->
        <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
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
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80">
                                <i class="fa-solid fa-money-bill-wheat text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- card4 -->
        <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
            <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
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
                            <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80 ">
                                <i class="fa-solid fa-money-bill-1-wave text-lg relative top-3.5 text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- cards row 4 -->

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
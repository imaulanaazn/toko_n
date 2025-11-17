<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full xl:max-w-11/12 px-3 mx-auto">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-col md:flex-row! gap-3 justify-between items-center">
                    <h6>Daftar Produk</h6>
                    <div class="w-full md:w-auto! flex flex-col md:flex-row! gap-3">
                        <form action="/owner/produk" method="get" class="w-full md:w-auto!">
                            <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                                <span class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </span>
                                <input type="text" name="keyword" value="<?= $keyword ?>" class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Cari Produk">
                            </div>
                        </form>
                        <a href="/owner/produk/tambah" class="inline-block w-full md:w-max! px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Tambah Produk</a>
                    </div>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2 mt-6">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Produk</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bahan</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">HPP Total</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Margin</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga Normal</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Promo</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga Setelah Promo</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($daftar_produk as $produk): ?>
                                <tr>
                                    <td class="p-2 pl-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div>
                                                <img src="<?= $produk['foto'] ?>" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-xl" alt="user1">
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal"><?= $produk['nama_produk'] ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent flex">
                                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                            <tbody>
                                                <?php foreach (explode('|', $produk['daftar_bahan']) as $index => $bahan): ?>
                                                    <tr class="flex">
                                                        <td class="py-1! flex-1 text-left align-middle bg-transparent border-b shadow-transparent">
                                                            <span class=" text-xs font-semibold leading-tight text-slate-400"><?= $bahan ?></span>
                                                        </td>
                                                        <td class="py-1! px-2 flex-1 text-left align-middle bg-transparent border-b shadow-transparent">
                                                            <span class=" text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah(explode('|', $produk['harga_bahan'])[$index]) ?></span>
                                                        </td>
                                                        <td class="py-1! flex-1 text-left align-middle bg-transparent border-b shadow-transparent">
                                                            <span class=" text-xs font-semibold leading-tight text-slate-400">x<?= (int) explode('|', $produk['jumlah_bahan'])[$index] ?> <?= explode('|', $produk['satuan_bahan'])[$index] ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($produk['hpp']) ?></span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight text-slate-400"><?= (int) $produk['margin'] ?>%</span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($produk['harga']) ?></span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <?php if ($produk['id_promo']) : ?>
                                            <span class="text-xs font-semibold leading-tight text-slate-400"><?= $produk['nama_promo'] ?> (<?= $produk['tipe_promo'] == 'nominal' ? 'Rp.' . $produk['nilai'] : $produk['nilai'] . '%' ?>)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <?php if ($produk['id_promo']) : ?>
                                            <?php if ($produk['tipe_promo'] == 'nominal') : ?>
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($produk['harga'] - $produk['nilai']) ?></span>
                                            <?php else: ?>
                                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($produk['harga'] - ($produk['harga'] * $produk['nilai'] / 100)) ?></span>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-2 pr-6 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <a href="/owner/produk/detail/<?= $produk['id_produk'] ?>" class="text-xs font-bold uppercase! underline leading-tight text-slate-600"> Detail </a>
                                        <span class="text-slate-400">|</span>
                                        <a href="/owner/produk/edit/<?= $produk['id_produk'] ?>" class="text-xs font-bold uppercase! underline leading-tight text-slate-600"> Edit </a>
                                        <span class="text-slate-400">|</span>
                                        <a href="/owner/produk/hapus/<?= $produk['id_produk'] ?>" class="text-xs font-bold uppercase! underline leading-tight text-slate-600"> Hapus </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
</script>
<?= $this->endSection() ?>
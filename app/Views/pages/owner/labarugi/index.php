<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="w-full mx-auto mb-6">
    <div class="relative flex flex-col flex-auto min-w-0 p-4 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
        <div class="flex flex-col-reverse md:flex-row! gap-4 flex-wrap justify-between items-center">
            <div class="w-full max-w-full mr-auto mt-4 sm:my-auto sm:mr-0 md:w-1/2 md:flex-none lg:w-4/12">
                <div class="flex">
                    <a href="/owner/labarugi?periode=harian" class="flex-1 inline-block px-6 py-2 font-bold text-center uppercase align-middle transition-all rounded-l-lg cursor-pointer text-white <?= $periode == 'harian' ? 'bg-slate-700!' : 'bg-white! border border-slate-200! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Harian</a>
                    <a href="/owner/labarugi?periode=mingguan" class="flex-1 inline-block px-6 py-2 font-bold text-center uppercase align-middle transition-all cursor-pointer text-white <?= $periode == 'mingguan' ? 'bg-slate-700!' : 'bg-white! border border-slate-200! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Mingguan</a>
                    <a href="/owner/labarugi?periode=bulanan" class="flex-1 inline-block px-6 py-2 font-bold text-center uppercase align-middle transition-all rounded-r-lg cursor-pointer text-white <?= $periode == 'bulanan' ? 'bg-slate-700!' : 'bg-white! border border-slate-200! text-slate-600!' ?> leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">Bulanan</a>
                </div>
            </div>
            <div class="flex-none w-full md:w-auto! max-w-full px-3 my-auto mt-4 md:my-0!">
                <div class="h-full flex items-center gap-6">
                    <p class="mb-0 font-semibold leading-normal text-sm text-center">
                        <?= date('d/m/Y', strtotime($start)) ?>
                        <?php if (date('d/m/Y', strtotime($start)) != date('d/m/Y', strtotime($end))) : ?>
                            <span class="mx-1">-</span> <?= date('d/m/Y', strtotime($end)) ?>
                        <?php endif ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row py-6 px-0 lg:px-6 gap-6 md:gap-0 lg:gap-6">
            <div class="w-full lg:w-2/3 bg-white rounded-xl">
                <div class="flex flex-wrap -mx-3 mb-0 md:mb-0! xl:mb-6!">
                    <!-- card2 -->
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
                        <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-1 font-sans font-semibold leading-normal text-sm">Total Penjualan</p>
                                            <h5 class="mb-0 font-bold">
                                                <?= format_rupiah($totalPenjualan) ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80">
                                            <i class="ni leading-none ni-world text-lg relative top-3.5 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- card3 -->
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
                        <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-1 font-sans font-semibold leading-normal text-sm">Laba Kotor</p>
                                            <h5 class="mb-0 font-bold">
                                                <?= format_rupiah($labaKotor) ?>
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
                </div>

                <div class="flex flex-wrap -mx-3">
                    <!-- card1 -->
                    <div class="w-full max-w-full px-3 mb-6 lg:mb-0 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2">
                        <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-1 font-sans font-semibold leading-normal text-sm">Total Hpp</p>
                                            <h5 class="mb-0 font-bold">
                                                <?= format_rupiah($totalHPP) ?>
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

                    <!-- card4 -->
                    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/2">
                        <div class="relative flex flex-col min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-1 font-sans font-semibold leading-normal text-sm">Laba Bersih</p>
                                            <h5 class="mb-0 font-bold">
                                                <?= format_rupiah($labaBersih) ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80 ">
                                            <i class="ni leading-none ni-cart text-lg relative top-3.5 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-1/3 bg-white rounded-xl">
                <div class="relative flex flex-co h-full items-center min-w-0 break-words border border-slate-50 rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4 lg:p-6">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-1 font-sans font-semibold leading-normal text-sm">Biaya Operasional</p>
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
        </div>


        <?= $this->endSection() ?>

        <?= $this->section('script') ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const periode = <?= json_encode($periode) ?>;
                document.getElementById('produk_id').addEventListener('change', function() {
                    const produkId = this.value;
                    const url = '/owner/labarugi?produk_id=' + produkId + '&periode=' + periode;
                    window.location.href = url;
                });
            });
        </script>
        <?= $this->endSection(); ?>
<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>

<div class="flex flex-wrap mt-6 -mx-3">
    <div class="w-full max-w-full px-3 mt-0 lg:flex-none">
        <div class="border-black/12.5 shadow-soft-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <h6>Grafik Keuangan Warung N</h6>
            </div>
            <div class="flex-auto p-4">
                <div>
                    <canvas id="chart-line" height="600"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    const labels = <?= $labels ?>;
    const chartPenjualan = <?= $chartPenjualan ?>;
    const chartPengeluaran = <?= $chartPengeluaran ?>;
    const chartLabaBersih = <?= $chartLabaBersih ?>;
</script>
<?= $this->endSection(); ?>
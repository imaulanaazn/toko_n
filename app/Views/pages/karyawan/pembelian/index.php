<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
        <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                <h5 class="">Catat Pengeluaran</h5>
            </div>

            <div class="flex-auto p-6">
                <?= view('components/alert') ?> <!-- panggil komponen alert -->
                <form role="form text-left" action="/karyawan/pembelian/simpan" method="POST">
                    <div class="mb-4">
                        <label for="" class="mb-2">Tanggal Pembelian</label>
                        <input type="date" name="tanggal_pengeluaran" value="<?= date('Y-m-d'); ?>" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Nama Bahan">
                    </div>
                    <div class="mb-4">
                        <label for="0" class="mb-2">Nama Pengeluaran</label>
                        <select id="select-bahan" name="id_pengeluaran" placeholder="Pilih Bahan..." autocomplete="off">
                            <?php foreach ($pengeluaran as $bahan): ?>
                                <option value="<?= $bahan['id_pengeluaran'] ?>"><?= $bahan['nama_pengeluaran'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Jumlah" aria-label="Email">
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2" id="harga_label">Harga Satuan</label>
                        <input type="number" name="harga_satuan" id="harga_satuan" min="1" required class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Harga Satuan">
                    </div>
                    <div class="mb-4">
                        <label for="" class="mb-2">Total Harga</label>
                        <input type="text" name="total_harga" id="total_harga" disabled class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Total Harga">
                    </div>
                    <div class="text-center">
                        <button type="submit" id="submit_btn" class="inline-block w-full px-6 py-3 mt-6 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    const selectBahan = document.getElementById('select-bahan');
    const submitBtn = document.getElementById('submit_btn');
    const jumlahInput = document.getElementById('jumlah');
    const hargaSatuanInput = document.getElementById('harga_satuan');
    const totalhargaInput = document.getElementById('total_harga');
    const hargaLabel = document.getElementById('harga_label');
    const daftarBahan = <?= json_encode($pengeluaran) ?>;


    new TomSelect("#select-bahan", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });

    jumlahInput.addEventListener('keyup', () => {
        const total = jumlahInput.value * (hargaSatuanInput.value || 1);
        totalhargaInput.value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(total);
    });

    hargaSatuanInput.addEventListener('keyup', () => {
        const total = (jumlahInput.value || 1) * hargaSatuanInput.value;
        totalhargaInput.value = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(total);
    });

    selectBahan.addEventListener('change', (e) => {
        const selectedBahan = daftarBahan.find((bahan) => (bahan.id_pengeluaran == e.target.value));
        hargaLabel.innerText = "Harga  " + (selectedBahan.satuan ? ` / ${selectedBahan.satuan}` : '(Rp...)');
    })

    const selectedBahan = daftarBahan.find((bahan) => (bahan.id_pengeluaran == selectBahan.value));
    hargaLabel.innerText = "Harga  " + (selectedBahan.satuan ? ` / ${selectedBahan.satuan}` : '(Rp...)');
</script>
<?= $this->endSection() ?>
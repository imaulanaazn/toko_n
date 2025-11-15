<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
    <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12!">
        <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                <h5 class="">Tambah Produk</h5>
            </div>

            <div class="flex-auto p-6">
                <?= view('components/alert') ?> <!-- panggil komponen alert -->
                <form role="form text-left" action="/owner/produk/simpan" method="POST" enctype="multipart/form-data">

                    <div class="w-full mb-4">
                        <label for="" class="mb-2">Gambar Produk</label>
                        <input type="file" name="foto" id="foto" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Ayam Goreng">
                    </div>

                    <div class="mb-4 flex items-center gap-3">
                        <div class="w-full">
                            <label for="" class="mb-2">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Ayam Goreng">
                        </div>
                        <div class="w-full">
                            <label for="" class="mb-2">Harga</label>
                            <input type="number" name="harga" id="harga" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="16000" aria-label="Email">
                        </div>
                    </div>

                    <div class="mb-4 flex items-center gap-3">
                        <div class="w-full">
                            <label for="" class="mb-2">HPP</label>
                            <input type="number" name="hpp" id="hpp" value=10000 class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="12000" aria-label="Email">
                        </div>
                        <div class="w-full">
                            <label for="" class="mb-2">Margin (%)</label>
                            <input type="number" name="margin" id="margin" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="10%" aria-label="Email">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="" class="mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Tulis deskripsi produk..." class="focus:shadow-soft-primary-outline min-h-unset text-sm leading-5.6 ease-soft block h-auto w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="0" class="mb-2">Promo</label>
                        <select id="id_promo" name="id_promo" placeholder="Pilih Promo..." autocomplete="off" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow">
                            <option value="">Pilih Promo</option>
                            <?php foreach ($daftar_promo as $promo): ?>
                                <option value="<?= $promo['id_promo'] ?>"><?= $promo['nama_promo'] ?> (<?= $promo['tipe'] == 'nominal' ? 'Rp.' . $promo['nilai'] : $promo['nilai'] . '%' ?>)</option>
                            <?php endforeach ?>
                        </select>
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
    document.addEventListener('DOMContentLoaded', function() {
        const hppInput = document.getElementById('hpp');
        const marginInput = document.getElementById('margin');
        const hargaInput = document.getElementById('harga');

        // Format number to IDR (optional display, not saved)
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        // Hitung Harga dari HPP + Margin (%)
        function hitungHargaDariMargin() {
            const hpp = parseFloat(hppInput.value) || 0;
            const margin = parseFloat(marginInput.value) || 0;

            console.log(hpp)

            if (hpp <= 0) {
                hargaInput.value = '';
                return;
            }

            const harga = hpp + (hpp * margin / 100);
            hargaInput.value = Math.round(harga); // Bulatkan ke atas (umum di bisnis)
        }

        // Hitung Margin (%) dari Harga dan HPP
        function hitungMarginDariHarga() {
            const hpp = parseFloat(hppInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;

            console.log(hpp)

            if (hpp <= 0 || harga <= hpp) {
                marginInput.value = '';
                return;
            }

            const margin = ((harga - hpp) / hpp) * 100;
            marginInput.value = margin
        }

        // Event: Margin changed → update Harga
        marginInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9.]/g, '');
            hitungHargaDariMargin();
        });

        // Event: Harga changed → update Margin
        hargaInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
            hitungMarginDariHarga();
        });

        hargaInput.addEventListener('focus', function() {
            if (this.value.includes('.')) {
                this.value = this.value.replace(/\./g, '');
            }
        });

        // Initial calculation if HPP already filled (from edit form)
        if (hppInput.value) {
            hitungHargaDariMargin();
        }
    });
</script>
<?= $this->endSection() ?>
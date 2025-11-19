<?= $this->extend('layouts/dashboard_layout') ?>

<?= $this->section('content') ?>
<div class="flex flex-wrap -mx-3">
    <div class="w-full flex flex-col lg:flex-row! gap-6 lg:gap-0 justify-center">
        <div class="w-full max-w-full px-3 mt-0 md:flex-0 shrink-0 md:w-10/12! lg:w-6/12! xl:w-5/12! mx-auto xl:mx-0!">
            <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                    <h5 class="">Edit Produk</h5>
                </div>

                <div class="flex-auto p-6">
                    <?= view('components/alert') ?>
                    <form role="form text-left" action="/owner/produk/update/<?= $produk['id_produk'] ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="w-full mb-4">
                            <label for="foto" class="mb-2">Gambar Produk</label>
                            <div id="preview-gambar">
                                <?php if (!empty($produk['foto'])): ?>
                                    <img src="/uploads/produk/<?= $produk['foto'] ?>" alt="Foto Produk" class="h-36 w-36 aspect-square object-cover rounded-xl mb-4">
                                <?php endif; ?>
                            </div>
                            <input type="file" name="foto" id="foto"
                                class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-gray-300 bg-white py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none"
                                placeholder="Pilih gambar baru (opsional)">
                        </div>

                        <div class="mb-4 flex items-center gap-3">
                            <div class="w-full">
                                <label for="nama_produk" class="mb-2">Nama Produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" value="<?= esc($produk['nama_produk']) ?>"
                                    class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none"
                                    placeholder="Ayam Goreng">
                            </div>
                            <div class="w-full">
                                <label for="harga" class="mb-2">Harga</label>
                                <input type="number" name="harga" id="harga" value="<?= esc($produk['harga']) ?>"
                                    class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none"
                                    placeholder="16000">
                            </div>
                        </div>

                        <div class="mb-4 flex items-center gap-3">
                            <div class="w-full">
                                <label for="hpp" class="mb-2">HPP</label>
                                <input type="number" name="hpp" id="hpp" value="<?= esc($produk['hpp']) ?>" disabled
                                    class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none"
                                    placeholder="12000">
                            </div>
                            <div class="w-full">
                                <label for="margin" class="mb-2">Margin (%)</label>
                                <input type="number" step="0.01" name="margin" id="margin" value="<?= esc($produk['margin']) ?>"
                                    class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none"
                                    placeholder="10%">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="deskripsi" class="mb-2">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" rows="3" placeholder="Tulis deskripsi produk..."
                                class="focus:shadow-soft-primary-outline min-h-unset text-sm leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 bg-white px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none"><?= esc($produk['deskripsi']) ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="id_promo" class="mb-2">Promo</label>
                            <select id="id_promo" name="id_promo"
                                class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full rounded-lg border border-gray-300 bg-white py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none">
                                <option value="">Pilih Promo</option>
                                <?php foreach ($daftar_promo as $promo): ?>
                                    <option value="<?= $promo['id_promo'] ?>"
                                        <?= $produk['id_promo'] == $promo['id_promo'] ? 'selected' : '' ?>>
                                        <?= $promo['nama_promo'] ?> (<?= $promo['tipe'] == 'nominal' ? 'Rp.' . $promo['nilai'] : $promo['nilai'] . '%' ?>)
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" id="submit_btn"
                                class="inline-block w-full px-6 py-3 mt-4 mb-2 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-gray-900 to-slate-800 rounded-lg cursor-pointer hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="w-full max-w-full px-3 mt-0 md:flex-0 shrink-0 md:w-10/12! lg:w-6/12! xl:w-5/12! mx-auto xl:mx-0!">
            <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                    <h5 class="">Daftar Bahan</h5>
                </div>

                <div class="flex-auto p-6">
                    <?= view('components/alert') ?> <!-- panggil komponen alert -->
                    <form role="form text-left" action="/owner/produk/tambah_bahan/<?= $produk['id_produk'] ?>" method="POST" class="mb-6">
                        <?= csrf_field() ?>
                        <div class="mb-4 flex flex-col xl:flex-row! gap-3">
                            <div class="w-full">
                                <label for="id_bahan" class="mb-2">Nama Bahan</label>
                                <select id="select-bahan" name="id_bahan" placeholder="Pilih Bahan..." autocomplete="off">
                                    <?php foreach ($daftar_bahan as $bahan): ?>
                                        <option value="<?= $bahan['id_pengeluaran'] ?>"><?= $bahan['nama_pengeluaran'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="w-full">
                                <label for="jumlah" class="mb-2" id="jumlah_label">Jumlah</label>
                                <input type="number" name="jumlah" id="jumlah" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Jumlah" aria-label="Email">
                            </div>
                            <div class="w-full">
                                <label for="output_produksi" class="mb-2">Output Produksi</label>
                                <input type="number" name="output_produksi" id="output_produksi" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="output produksi" aria-label="Email">
                            </div>
                        </div>

                        <button type="submit" id="submit_btn"
                            class="inline-block w-full mt-4 px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-gray-900 to-slate-800 rounded-lg cursor-pointer hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md">
                            Tambah
                        </button>
                    </form>

                    <div class="p-0 overflow-x-auto">

                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-2 pr-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Bahan</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jml</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga Satuan</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Output Produksi</th>
                                    <th class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bahan_produk as $bahan): ?>
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-xs font-semibold leading-tight text-slate-600"><?= $bahan['nama_pengeluaran'] ?></p>
                                        </td>
                                        <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight text-slate-400"><?= $bahan['jumlah'] ?> <?= $bahan['satuan'] ?></span>
                                        </td>
                                        <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($bahan['harga_satuan']) ?></span>
                                        </td>
                                        <td class="p-2 text-left align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold leading-tight text-slate-400"><?= $bahan['output'] ?></span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <a href="/owner/produk/hapus_bahan/<?= $bahan['id'] ?>" class="text-xs font-semibold uppercase! underline leading-tight text-slate-600"> Hapus </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
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
        const hppInput = document.getElementById('hpp');
        const marginInput = document.getElementById('margin');
        const hargaInput = document.getElementById('harga');
        const gambarInput = document.getElementById('foto');
        const preview = document.getElementById('preview-gambar');
        const jumlahLabel = document.getElementById('jumlah_label');
        const selectBahan = document.getElementById('select-bahan');
        const daftarBahan = <?= json_encode($daftar_bahan) ?>;

        new TomSelect("#select-bahan", {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });

        // Format number to IDR (optional display, not saved)
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        // Hitung Harga dari HPP + Margin (%)
        function hitungHargaDariMargin() {
            const hpp = parseInt(hppInput.value) || 0;
            const margin = parseInt(marginInput.value) || 0;

            if (hpp <= 0) {
                hargaInput.value = '';
                return;
            }

            const harga = hpp + (hpp * margin / 100);
            hargaInput.value = Math.round(harga); // Bulatkan ke atas (umum di bisnis)
        }

        // Hitung Margin (%) dari Harga dan HPP
        function hitungMarginDariHarga() {
            const hpp = parseInt(hppInput.value) || 0;
            const harga = parseInt(hargaInput.value) || 0;

            if (hpp <= 0 || harga <= hpp) {
                marginInput.value = 0;
                return;
            }

            const margin = ((harga - hpp) / hpp) * 100;
            marginInput.value = Number(margin).toFixed(2);
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

        // Initial calculation if HPP already filled (from edit form)
        if (hppInput.value) {
            hitungMarginDariHarga();
        }

        gambarInput.addEventListener("change", () => {
            const file = gambarInput.files[0]; // ambil file pertama

            // Validasi: hanya gambar
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Buat atau update elemen img
                    let img = preview.querySelector('img');
                    if (!img) {
                        img = document.createElement('img');
                        preview.appendChild(img);
                    }

                    img.src = e.target.result;
                    img.classList.add('mt-2', 'max-w-full', 'h-40', 'w-40', 'aspect-square', 'object-cover', 'rounded-xl', 'border', 'border-gray-300', 'mb-4');
                    img.alt = 'Preview gambar';
                };

                reader.readAsDataURL(file); // baca file sebagai base64
            } else {
                // Jika bukan gambar atau belum pilih
                preview.innerHTML = '<p class="text-sm text-red-600 mt-2">Pilih file gambar yang valid!</p>';
            }
        })

        selectBahan.addEventListener('change', (e) => {
            const selectedBahan = daftarBahan.find((bahan) => (bahan.id_pengeluaran == e.target.value));
            jumlahLabel.innerText = "Jumlah " + (selectedBahan.satuan ? `(${selectedBahan.satuan})` : '(Rp...)');
        })

        const selectedBahan = daftarBahan.find((bahan) => (bahan.id_pengeluaran == selectBahan.value));
        jumlahLabel.innerText = "Jumlah " + (selectedBahan.satuan ? `(${selectedBahan.satuan})` : '(Rp...)');
    });
</script>
<?= $this->endSection() ?>
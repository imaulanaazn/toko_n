<?php if (session()->has('success') || session()->has('error')): ?>
    <?php if (session()->has('success')): ?>
        <div class="mb-4 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3 relative" role="alert">
            <strong class="font-bold">Sukses!</strong>
            <span class="block sm:inline"><?= esc(session('success')) ?></span>
        </div>
    <?php endif ?>

    <?php if (session()->has('error')): ?>
        <div class="mb-4 rounded-lg bg-red-100 border border-red-400 text-red-700 px-4 py-3 relative" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline"><?= esc(session('error')) ?></span>
        </div>
    <?php endif ?>
<?php endif ?>
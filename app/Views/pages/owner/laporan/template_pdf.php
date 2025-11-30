<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .section-title {
            margin-top: 20px;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        table th {
            background: #f2f2f2;
        }
    </style>
</head>

<body onload="window.print()">

    <h2>Laporan Keuangan Warung N</h2>
    <p><strong>Periode:</strong> <?= ucfirst($periode) ?>
        <br><strong>Dari:</strong> <?= date('d-m-Y | H:i:s', strtotime($start)) ?>
        <br><strong>Sampai:</strong> <?= date('d-m-Y | H:i:s', strtotime($end)) ?>
    </p>

    <!-- ========================== -->
    <!-- 1. TABEL RINGKASAN -->
    <!-- ========================== -->
    <div class="section-title">Ringkasan Keuangan</div>
    <table>
        <tr>
            <th>Total Pengeluaran</th>
            <td><?= format_rupiah($totalPengeluaran) ?></td>
        </tr>
        <tr>
            <th>Total Produk Terjual</th>
            <td><?= $totalProdukTerjual ?></td>
        </tr>
        <tr>
            <th>Total Penjualan</th>
            <td><?= format_rupiah($totalPenjualan) ?></td>
        </tr>
        <tr>
            <th>Total HPP</th>
            <td><?= format_rupiah($totalHPP) ?></td>
        </tr>
        <tr>
            <th>Laba Kotor</th>
            <td><?= format_rupiah($labaKotor) ?></td>
        </tr>
        <tr>
            <th>Laba Bersih</th>
            <td><?= format_rupiah($labaBersih) ?></td>
        </tr>
        <tr>
            <th>Total Transaksi</th>
            <td><?= $totalTransaksi ?></td>
        </tr>
        <tr>
            <th>Rata-rata Transaksi</th>
            <td><?= number_format($rataRataTransaksi, 2) ?></td>
        </tr>
        <tr>
            <th>Total Operasional</th>
            <td><?= format_rupiah($totalOperasional) ?></td>
        </tr>
    </table>


    <!-- ========================== -->
    <!-- 3. TABEL RIWAYAT PEMBELIAN -->
    <!-- ========================== -->
    <div class="section-title">Riwayat Pembelian / Pengeluaran</div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Pengeluaran</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataPengeluaran as $row): ?>
                <tr>
                    <td><?= $row['tanggal_pengeluaran'] ?></td>
                    <td><?= $row['nama_master'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= format_rupiah($row['harga_satuan']) ?></td>
                    <td><?= format_rupiah($row['total_harga']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>


    <!-- ========================== -->
    <!-- 2. TABEL RIWAYAT PENJUALAN -->
    <!-- ========================== -->
    <div class="section-title">Riwayat Penjualan</div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th>Diskon</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dataPenjualan as $row): ?>
                <tr>
                    <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                    <td>
                        <?php
                        $produkList = explode('|', $row['produk_list']);
                        foreach ($produkList as $p) {
                            echo $p . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $jumlahList = explode('|', $row['jumlah_list']);
                        foreach ($jumlahList as $p) {
                            echo $p . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $hargaList = explode('|', $row['harga_satuan_list']);
                        foreach ($hargaList as $p) {
                            echo format_rupiah($p) . "<br>";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        $produkList = explode('|', $row['subtotal_list']);
                        foreach ($produkList as $p) {
                            echo format_rupiah($p) . "<br>";
                        }
                        ?>
                    </td>
                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                        <?php
                        $produkList = explode('|', $row['produk_list']);
                        $tipePromoList = explode('|', $row['tipe_promo_list']);
                        $nilaiPromoList = explode('|', $row['nilai_promo_list']);
                        ?>
                        <ul>
                            <?php foreach ($produkList as $index => $produk): ?>
                                <li class="py-1">
                                    <?php
                                    $tipePromo = $tipePromoList[$index] ?? null;
                                    $nilaiPromo = $nilaiPromoList[$index] ?? null;
                                    ?>

                                    <?php if ($tipePromo == 'persen'): ?>
                                        <span class="text-xs font-semibold leading-tight text-slate-400">
                                            <?= $nilaiPromo . '%' ?>
                                        </span>

                                    <?php elseif ($tipePromo == 'nominal'): ?>
                                        <span class="text-xs font-semibold leading-tight text-slate-400">
                                            <?= format_rupiah($nilaiPromo) ?>
                                        </span>

                                    <?php else: ?>
                                        <span class="text-xs font-semibold leading-tight text-slate-400">-</span>
                                    <?php endif ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </td>
                    <td><?= format_rupiah($row['grand_total']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>
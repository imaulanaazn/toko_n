<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        /* Pengaturan untuk Print */
        @media print {
            body {
                padding: 0;
            }

            .no-print {
                display: none;
            }

            @page {
                margin: 1.5cm;
            }
        }

        /* Header / Kop Laporan */
        .header {
            display: flex;
            align-items: center;
            border-bottom: 3px solid #444;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background-color: #f0f0f0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .info-warung h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }

        .info-warung p {
            margin: 5px 0;
            font-size: 14px;
            color: #666;
        }

        /* Periode & Ringkasan */
        .report-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .report-title h2 {
            margin: 0;
            font-size: 16px;
            color: #2c3e50;
        }

        /* Tabel Laporan */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th,
        table td {
            border: 1px solid #cecece;
            padding: 6px 10px 6px;
            text-align: left;
        }

        table th {
            background-color: #f8f9fa;
            font-weight: 500;
            font-size: small;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .pemasukan {
            color: #27ae60;
        }

        .pengeluaran {
            color: #c0392b;
        }

        /* Total Section */
        .total-box {
            float: right;
            width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .grand-total {
            font-size: 18px;
            border-top: 2px solid #333;
            margin-top: 10px;
            padding-top: 10px;
        }

        /* Footer Tanda Tangan */
        .footer-sign {
            margin-top: 80px;
            display: flex;
            justify-content: flex-end;
        }

        .signature {
            text-align: center;
            width: 300px;
        }

        .signature-space {
            height: 70px;
        }

        #ringkasan_table th {
            background-color: white;
            font-weight: 400;
            text-wrap-mode: nowrap;
        }

        #ringkasan_table td,
        #ringkasan_table th {
            border: none;
            border-bottom: 1px solid #efefef;
            padding: 0px;
            padding-top: 5px;
            padding-bottom: 5px;
            color: #666;
        }

        #ringkasan_table th {
            width: 100%;
            font-size: small;
        }

        #ringkasan_table td {
            text-wrap: nowrap;
            font-size: small;
        }

        ul {
            margin: 0;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="header">
        <div class="logo">
            <img src="/assets/img/logo-warung-n.png" alt="Logo">
        </div>
        <div class="info-warung">
            <h1>Warung Makan Sedap Mantap</h1>
            <p>Sokasada, Kedungbenda, Kec. Kemangkon, Kabupaten Purbalingga</p>
            <p>Telp: 0812-3456-7890 | Email: warungn_official@gmail.com</p>
        </div>
    </div>

    <div class="report-title">
        <h2>LAPORAN KEUANGAN BULANAN</h2>
        <p style="font-size: small; margin-top: 6px">Periode: <?= date('d F Y', strtotime($start)) ?> - <?= date('d F Y', strtotime($end)) ?></p>
    </div>
    <!-- ========================== -->
    <!-- 2. TABEL RIWAYAT PENJUALAN -->
    <!-- ========================== -->
    <?php if (!empty($dataPenjualan)): ?>
        <div id="section-title" style="margin-bottom: 10px; font-weight:600">Riwayat Penjualan</div>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                    <th>Diskon</th>
                    <th>Grand Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dataPenjualan as $penjualan): ?>
                    <tr>
                        <td style="font-size:small"><?= date('d-m-Y', strtotime($penjualan['tanggal'])) ?></td>
                        <td style="font-size:small">
                            <?php
                            $produkList = explode('|', $penjualan['produk_list']);
                            foreach ($produkList as $p) {
                                echo $p . "<br>";
                            }
                            ?>
                        </td>
                        <td style="font-size:small">
                            <?php
                            $jumlahList = explode('|', $penjualan['jumlah_list']);
                            foreach ($jumlahList as $p) {
                                echo $p . "<br>";
                            }
                            ?>
                        </td>
                        <td style="font-size:small">
                            <?php
                            $hargaList = explode('|', $penjualan['harga_satuan_list']);
                            foreach ($hargaList as $p) {
                                echo format_rupiah($p) . "<br>";
                            }
                            ?>
                        </td>
                        <td style="font-size:small">
                            <?php
                            $produkList = explode('|', $penjualan['subtotal_list']);
                            foreach ($produkList as $p) {
                                echo format_rupiah($p) . "<br>";
                            }
                            ?>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <?php
                            $produkList = explode('|', $penjualan['produk_list']);
                            $diskonList = explode('|', $penjualan['diskon_list']);
                            ?>
                            <ul>
                                <?php foreach ($produkList as $index => $produk): ?>
                                    <li class="py-1" style="list-style: none;">
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
                        <td style="font-size:small">
                            <?php if ($produk_id): ?>
                                <ul>
                                    <?php foreach (explode('|', $penjualan['total_list']) as $total): ?>
                                        <li class="py-1" style="list-style: none;">
                                            <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($total) ?></span>
                                        </li>
                                    <?php endforeach ?>
                                </ul>
                            <?php else: ?>
                                <span class="text-xs font-semibold leading-tight text-slate-400"><?= format_rupiah($penjualan['grand_total']) ?></span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div style="clear: both;"></div>

    <div class="footer-sign">
        <div class="signature">
            <p>Purbalingga, <?= date('d F Y') ?></p>
            <p>Pemilik Warung,</p>
            <div class="signature-space"></div>
            <p><strong>(Priyanto)</strong></p>
        </div>
    </div>
</body>

</html>
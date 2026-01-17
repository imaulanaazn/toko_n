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
        <h2>LAPORAN KEUANGAN</h2>
        <p style="font-size: small; margin-top: 6px">Periode: <?= date('d F Y', strtotime($start)) ?> - <?= date('d F Y', strtotime($end)) ?></p>
    </div>

    <!-- ========================== -->
    <!-- 3. TABEL RIWAYAT PEMBELIAN -->
    <!-- ========================== -->
    <?php if (!empty($dataPengeluaran)): ?>
        <div class="section-title" style="margin-bottom: 10px; font-weight:600">Riwayat Pembelian / Pengeluaran</div>
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
                        <td style="font-size: small;"><?= $row['tanggal_pengeluaran'] ?></td>
                        <td style="font-size: small;"><?= $row['nama_master'] ?></td>
                        <td style="font-size: small;"><?= intval($row['jumlah']) ?></td>
                        <td style="font-size: small;"><?= format_rupiah($row['harga_satuan']) ?></td>
                        <td style="font-size: small;"><?= format_rupiah($row['total_harga']) ?></td>
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
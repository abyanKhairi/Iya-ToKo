<?php
require_once "../vendor/autoload.php";
include "../database/class/storeBranch.php";
include "../database/class/Members.php";
include '../database/class/transaksi.php';

$mpdf = new \Mpdf\Mpdf();

$id_transaksi = $_GET['id'];


$transaksi = Transaksi::makeObjek($pdo);
$pdo = Koneksi::connect();
$rows = $transaksi->getDetailTransaksi($id_transaksi);

$transaksi->updateSelesai($id_transaksi);

if (isset($id_transaksi)) {
    extract($transaksi->getForStruk($id_transaksi));
}


$html = '<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ZKasir</title>
    <link rel="stylesheet" href="../assets/dist/css/custom.css">    </head>
        <body>
        <div class="cartu">
            <h5 class="zkasir">POS</h5>
            <hr>
            <h2 class="struk">Struk Transaksi</h2>
            <div class="letakTgl">' . $tanggal . '</div>
            <div>
                <p>ID transaksi : ' . $id_transaksi . ' </p>
                <p>ID Pembayaran : ' . $id_bayar . ' </p>
            </div>
            <hr>
            <table align="center" cellspacing="0" cellpadding="10">
            <tr>
            <th class="thSize" width="8cm">Nama Product</th>
            <th class="thSize" width="2cm">Jumlah</th>
            <th class="thSize" width="5cm">Harga Satuan</th>
            <th class="thSize" width="4cm">Total</th>
            </tr>';

foreach ($rows as $row) {

    $html .= '
        <tr>
                <td class="tdSize" align="center"> ' . $row["nama"] . '</td>
                <td class="tdSize" align="center">' . $row["qty"] . '</td>
                <td class="tdSize" align="center">Rp. ' . number_format($row["harga"]) . '</td>
                <td class="tdSize" align="center">Rp. ' . number_format($row["qty"] * $row["harga"]) . '</td>
        </tr>';
}

$html .= '
</table>
<hr>
<hr>
<table class="bolder" align="center" cellspacing="0" cellpadding="10">
<tr>
    <th class="thSize">Discount</th>
    <th class="thSize">Rp.' . number_format($total) . '</th>
</tr>
<tr>
    <th class="thSize">Total Harga</th>
    <th class="thSize">Rp.' . number_format($dibayar) . '</th>
</tr>

<tr>
    <th class="thSize">Uang</th>
    <th class="thSize">Rp.' . number_format($kembali) . '</th>
</tr>

</table>

        <hr>
        <div>
            <h5 style+"font-style: italic;" align="center">
                Terimakasih Telah Berbelanja Disini
            </h5>

        </div>
    </div>
    </body>
</html>
';

$mpdf->WriteHTML($html);
$mpdf->Output();

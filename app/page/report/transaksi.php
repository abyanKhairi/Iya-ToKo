<?php
require_once "../vendor/autoload.php";
include "../database/class/storeBranch.php";
include "../database/class/Members.php";
include '../database/class/transaksi.php';

$mpdf = new \Mpdf\Mpdf();

$tanggal = $_GET['tanggal'];

$pdo = Koneksi::connect();
$transaksi = Transaksi::makeObjek($pdo);
$members = Members::makeObjek($pdo);
$branch = storeBranch::makeObjek($pdo);
$rowsMembers = $members->showMembers(@$keyword);
$rowsBranch = $branch->showStoreBranch(@$keyword);
$rows = $transaksi->getTransaksi(@$tanggal);
$pendatan = $transaksi->countPendapatan(@$tanggal);



$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/dist/css/custom.css">
</head>

<body>
    <table align="center" border="1" cellspacing="0" cellpadding="10">
        <thead>
            <tr bgcolor="#c9c7c7">
                <th width="1cm">Invoice</th>
                <th width="2cm">Store Branch</th>
                <th width="4cm">User</th>
                <th width="1cm">Member</th>
                <th width="4cm">tanggal</th>
                <th width="6cm">Status</th>
                <th width="4cm">Total</th>
            </tr>
        </thead>
        <tbody>';

foreach ($rows as $row) {

    $html .= '<tr>
                    <td align="center">' . $row["inv"] . '</td>
                    <td align="center">' . $row["toko"] . '</td>
                    <td align="center">' . $row["nama_user"] . '</td>
                    <td align="center">' . $row["member"] . '</td>
                    <td align="center">' . $row["tanggal"] . '</td>
                    <td align="center">' . $row["status"] . '</td>
                    <td align="center">' . $row["inv"] . '</td>
                </tr>';
}

$html .=        '</tbody>
        <tfoot>
            <tr bgcolor="#c9c7c7">
                <th width="1cm">Invoice</th>
                <th width="2cm">Store Branch</th>
                <th width="4cm">User</th>
                <th width="1cm">Member</th>
                <th width="4cm">tanggal</th>
                <th width="6cm">Status</th>
                <th width="4cm">Total</th>
            </tr>
        </tfoot>
    </table>

<br>
    <table border="1" cellspacing="0" cellpadding="10">
    <tr>
        <td align="center" width="15cm">Total Pendapatan Keseluruhan / Total Pendapatan Hari Ini</td>
        <td align="center" bgcolor="#c9c7c7" width="6cm">Rp.' . number_format($pendatan) . '</td>
    </tr>
    </table>
</body>

</html>';

$mpdf->WriteHTML($html);
$mpdf->Output();

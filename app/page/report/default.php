<?php
$page = isset($_GET["act"]) ? $_GET["act"] : '';
switch ($page) {

    case 'transaksi':
        include('transaksi.php');
        break;
    case 'struks':
        include('struk.php');
        break;
}

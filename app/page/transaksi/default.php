<?php
if ($currentUser['role'] === 'adminGudang') {
    echo "<script>window.location.href='index.php?msg=akses'</script>";
}
include "../database/class/storeBranch.php";
include "../database/class/count.php";
include "../database/class/Members.php";
include '../database/class/transaksi.php';
$page = isset($_GET["act"]) ? $_GET["act"] : '';
switch ($page) {

    case 'add':
        include('add.php');
        break;
    case 'edit':
        include('edit.php');
        break;
    case 'delete':
        include('delete.php');
        break;
    case 'detail':
        include('detail.php');
        break;
    case 'bayar':
        include('bayar.php');
        break;
    case 'struk':
        include('struk.php');
        break;
    default:
        include('index.php');
}

<?php

if ($currentUser['role'] === 'adminKasir') {
    echo "<script>window.location.href='index.php?msg=akses'</script>";
}
include "../database/class/retur.php";
include "../database/class/Ordered.php";
include '../database/class/count.php';

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
    case 'produk':
        include('produk.php');
        break;
    case 'retur':
        include('retur.php');
        break;
    default:
        include('index.php');
}

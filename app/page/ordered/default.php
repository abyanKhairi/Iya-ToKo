<?php

if ($currentUser['role'] === 'adminKasir') {
    echo "<script>window.location.href='index.php?msg=akses'</script>";
}

include "../database/class/Ordered.php";
include "../database/class/storeBranch.php";
include "../database/class/Produks.php";
include "../database/class/Suppliers.php";
include '../database/class/count.php';
$page = isset($_GET["act"]) ? $_GET["act"] : '';
switch ($page) {

    case 'create':
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
    case 'diantar':
        include('diantar.php');
        break;
    default:
        include('index.php');
}

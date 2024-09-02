<?php

if ($currentUser['role'] === 'adminKasir') {
    echo "<script>window.location.href='index.php?msg=akses'</script>";
}

include "../database/class/Penerimaan.php";
include '../database/class/count.php';

$page = isset($_GET["act"]) ? $_GET["act"] : '';
switch ($page) {
    case 'edit':
        include('edit.php');
        break;
    case 'delete':
        include('delete.php');
        break;
    case 'detail':
        include('detail.php');
        break;
    case 'diterima':
        include('add.php');
        break;
    default:
        include('index.php');
}

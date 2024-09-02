<?php

if ($currentUser['role'] === 'adminKasir') {
    echo "<script>window.location.href='index.php?msg=akses'</script>";
}

include "../database/class/Suppliers.php";
include "../database/class/Store.php";
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
    default:
        include('index.php');
}

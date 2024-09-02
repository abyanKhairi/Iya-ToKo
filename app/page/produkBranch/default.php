<?php
include "../database/class/Produks.php";
include "../database/class/produkBranch.php";
include "../database/class/storeBranch.php";
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
    case 'produk':
        include('produk.php');
        break;
    case 'history':
        include('history.php');
        break;
    default:
        include('index.php');
}

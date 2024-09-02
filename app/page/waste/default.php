<?php
include "../database/class/storeBranch.php";
include "../database/class/waste.php";
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
    default:
        include('index.php');
}

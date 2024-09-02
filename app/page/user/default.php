<?php

include "../database/class/User.php";
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
    case 'logout':
        include('userLogout.php');
        break;
    case 'new':
        include('changePassword.php');
        break;
    default:
        include('index.php');
}

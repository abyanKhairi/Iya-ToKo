<?php

$pdo = Koneksi::connect();
$waste = Waste::makeObjek($pdo);
$id_waste = $_GET['id'];

if ($waste->hapusUser($id_waste)) {
    echo "<script>window.location.href='index.php?page=waste&msg=success'</script>";
} else {
    echo "<script>window.location.href='index.php?page=waste&msg=error'</script>";
}

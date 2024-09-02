<?php

$pdo = Koneksi::connect();
$store = Store::makeObjek($pdo);
$id_store = $_GET['id'];

if ($store->deleteStore($id_store)) {
    echo "<script>window.location.href='index.php?page=store&msg=success'</script>";
} else {
    echo "<script>window.location.href='index.php?page=store&msg=error'</script>";
}

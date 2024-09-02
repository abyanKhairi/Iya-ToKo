<?php
$pdo = Koneksi::connect();
$produkBranch = ProdukBranch::makeObjek($pdo);

$id_produks = $_GET['id'];
$id_branch = $_GET['id_branch'];

if ($produkBranch->deleteProdukBranch($id_produks)) {
    echo "<script>window.location.href='index.php?page=produkBranch&act=produk&id=$id_branch'</script>";
} else {
    echo "<script>alert('tidak bisa')</script>";
}

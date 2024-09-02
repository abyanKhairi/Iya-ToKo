<?php
$pdo = Koneksi::connect();
$transaksi = Transaksi::makeObjek($pdo);

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    if ($transaksi->deleteTransaksi($id_transaksi)) {
        echo "<script>window.location.href='index.php?page=transaksi&msg=success'</script>";
        exit();
    } else {
        echo "<script>window.location.href='index.php?page=transaksi&msg=error'</script>";
    }
}
if (isset($_GET['transaksi']) && isset($_GET['detail']) && isset($_GET['branch']) && isset($_GET['produk'])) {
    $id_transaksi = $_GET['transaksi'];
    $id_detail = $_GET['detail'];
    $id_branch = $_GET['branch'];
    $id_produk = $_GET['produk'];
    if ($transaksi->deleteDetailTransaksi($id_detail, $id_transaksi, $id_produk)) {
        echo "<script>window.location.href='index.php?page=transaksi&act=detail&id=$id_transaksi&branch=$id_branch&msg=success'</script>";
        exit();
    } else {
        echo "<script>window.location.href='index.php?page=transaksi&act=detail&id=$id_transaksi&branch=$id_branch&msg=error'</script>";
    }
}

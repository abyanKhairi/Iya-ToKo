<?php
$pdo = Koneksi::connect();
$Order = Ordered::makeObjek($pdo);

if (isset($_GET['id'])) {
    $id_order = $_GET['id'];
    if ($Order->deleteOrder($id_order)) {
        echo "<script>window.location.href='index.php?page=ordered'</script>";
    }
}

if (isset($_GET['id_POdetail']) && isset($_GET['id_po'])) {
    $id_detail = $_GET['id_POdetail'];
    $id_po = $_GET['id_po'];

    if ($Order->deleteOrderDetail($id_detail)) {
        echo "<script>window.location.href='index.php?page=ordered&act=detail&id=$id_po'</script>";
    }
}

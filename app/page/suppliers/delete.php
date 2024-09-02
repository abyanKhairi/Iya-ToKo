<?php
$pdo = Koneksi::connect();
$suppliers = Suppliers::makeObjek($pdo);

$id_suppliers = $_GET['id'];

if ($suppliers->hapusSuppliers($id_suppliers)) {
    echo "<script>window.location.href='index.php?page=suppliers&msg=success'</script>";
} else {
    echo "<script>window.location.href='index.php?page=suppliers&msg=error'</script>";
}

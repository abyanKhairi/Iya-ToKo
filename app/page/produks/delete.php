<?php
$pdo = Koneksi::connect();
$produks = Produks::makeObjek($pdo);

$id_produks = $_GET['id'];

if ($produks->deleteProduks($id_produks)) {
    echo "<script>window.location.href='index.php?page=produks&msg=success'</script>";
} else {
    echo "<script>window.location.href='index.php?page=produks&msg=error'</script>";
}

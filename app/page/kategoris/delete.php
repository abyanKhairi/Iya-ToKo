<?php
$pdo = Koneksi::connect();
$kategoris = Kategoris::makeObjek($pdo);

$id_kategoris = $_GET['id'];

if ($kategoris->deleteKategoris($id_kategoris)) {
    echo "<script>window.location.href='index.php?page=kategoris&msg=success'</script>";
} else {
    echo "<script>window.location.href='index.php?page=kategoris&msg=error'</script>";
}

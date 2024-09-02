<?php

$pdo = Koneksi::connect();
$storeBranch = storeBranch::makeObjek($pdo);
$id_storeBranch = $_GET['id'];

if ($storeBranch->deleteStoreBranch($id_storeBranch)) {
    echo "<script>window.location.href='index.php?page=storeBranch'</script>";
} else {
    echo "<script>window.location.href='index.php?page=storeBranch&msg=error'</script>";
}

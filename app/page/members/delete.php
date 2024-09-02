<?php
$pdo = Koneksi::connect();
$members = Members::makeObjek($pdo);

$id_members = $_GET['id'];

if ($members->deleteMembers($id_members)) {
    echo "<script>window.location.href='index.php?page=members&msg=success'</script>";
} else {
    echo "<script>window.location.href='index.php?page=members&msg=error'</script>";
}

<?php

$pdo = Koneksi::connect();
$user = User::makeObjek($pdo);
$id_user = $_GET['id'];

if ($user->hapusUser($id_user)) {
    echo "<script>window.location.href='index.php?page=user&msg=success'</script>";
} else {
    echo "<script>window.location.href='index.php?page=user&msg=error'</script>";
}

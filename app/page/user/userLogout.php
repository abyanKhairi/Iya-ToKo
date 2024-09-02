<?php
$pdo = Koneksi::connect();
$auth = Auth::makeObjek($pdo);
if ($auth->logout()) {
    echo "<script>window.location.href='index.php?msg=logout'</script>";
} else {
    echo "<script>window.location.href='index.php?msg=gagalLogout'</script>";
}

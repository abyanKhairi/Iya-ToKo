<?php
$pdo = Koneksi::connect();
$store = Store::makeObjek($pdo);

$id_store = $_GET['id'];

if (isset($_POST['edit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $nomorHp = htmlspecialchars($_POST['nomorHp']);
    $tahun = htmlspecialchars($_POST['tahun']);

    if ($store->editstore($id_store, $nama, $email, $nomorHp, $tahun)) {
        echo "<script>window.location.href='index.php?page=store&msg=editSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=store&msg=editError'</script>";
    }
}

if (isset($id_store)) {
    extract($store->getId($id_store));
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Toko</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ubah</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama Toko</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($name) ?>" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Toko</label>
                                    <input type="email" name="email" class="form-control" required id="email" value="<?= htmlspecialchars($email) ?>" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="nomorHp">Nomor Hp</label>
                                    <input type="text" name="nomorHp" class="form-control" required id="nomorHp" value="<?= htmlspecialchars($nomor_hp) ?>" placeholder="Nomor Hp">
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun Berdiri</label>
                                    <input type="text" name="tahun" class="form-control" id="tahun" value="<?= htmlspecialchars($tahun_berdiri) ?>" required placeholder="Tahun">
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="edit" class="btn btn-primary">Change</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="index.php?page=store" class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>
</div>
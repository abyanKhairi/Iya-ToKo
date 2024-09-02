<?php
$pdo = Koneksi::connect();
$suppliers = Suppliers::makeObjek($pdo);

$id_suppliers = $_GET['id'];

if (isset($_POST['edit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $nomorHp = htmlspecialchars($_POST['noHp']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $email = htmlspecialchars($_POST['email']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    if ($suppliers->editSuppliers($id_suppliers, $nama, $nomorHp, $alamat, $email, $keterangan)) {
        echo "<script>window.location.href='index.php?page=suppliers&msg=editSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=suppliers&msg=editError'</script>";
    }
}

if (isset($id_suppliers)) {
    extract($suppliers->getId($id_suppliers));
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Suppliers</h1>
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
                            <h3 class="card-title">Tambah</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>" id="nama" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="noHp">Nomor Hp</label>
                                    <input type="text" name="noHp" class="form-control" value="<?= htmlspecialchars($nomor_hp) ?>" required id="noHp" placeholder="Nomor Hp">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($alamat) ?>" id="alamat" required placeholder="Alamat">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" value="<?= htmlspecialchars($keterangan) ?>" id="keterangan" required placeholder="Keterangan">
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="edit" class="btn btn-primary">Change</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="index.php?page=suppliers" class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>
</div>
<?php
$pdo = Koneksi::connect();
$store = Store::makeObjek($pdo);

if (isset($_POST['create'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $nomorHp = htmlspecialchars($_POST['nomorHp']);
    $tahun = htmlspecialchars($_POST['tahun']);

    if ($store->addStore($nama, $email, $nomorHp, $tahun)) {
        echo "<script>window.location.href='index.php?page=store&msg=tambahSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=store&msg=tambahError'</script>";
    }
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Store</h1>
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
                                    <label for="nama">Nama Toko</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Toko</label>
                                    <input type="email" name="email" class="form-control" required id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="nomorHp">Nomor Hp</label>
                                    <input type="text" name="nomorHp" class="form-control" required id="nomorHp" placeholder="Nomor Hp">
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun Berdiri</label>
                                    <input type="text" name="tahun" class="form-control" id="tahun" required placeholder="Tahun">
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" name="create" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
    </section>
</div>
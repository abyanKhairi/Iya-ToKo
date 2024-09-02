<?php
$pdo = Koneksi::connect();
$kategoris = Kategoris::makeObjek($pdo);

if (isset($_POST['create'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    if ($kategoris->addKategoris($nama, $keterangan)) {
        echo "<script>window.location.href='index.php?page=kategoris&msg=tambahSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=kategoris&msg=tambahError'</script>";
    }
}



?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah kategori</h1>
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
                                    <input type="text" name="nama" class="form-control" id="nama" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="keterangan">
                                </div>
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
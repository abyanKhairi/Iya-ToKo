<?php
$pdo = Koneksi::connect();
$kategoris = Kategoris::makeObjek($pdo);

$id_kategoris = $_GET['id'];

if (isset($_POST['edit'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $keterangan = htmlspecialchars($_POST['keterangan']);

    if ($kategoris->editKategoris($id_kategoris, $nama, $keterangan)) {
        echo "<script>window.location.href='index.php?page=kategoris&msg=editSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=kategoris&msg=editError'</script>";
    }
}

if (isset($id_kategoris)) {
    extract($kategoris->getId($id_kategoris));
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah kategori</h1>
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
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= htmlspecialchars($nama) ?>" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" value="<?= htmlspecialchars($keterangan) ?>" id="keterangan" placeholder="keterangan">
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="edit" class="btn btn-primary">Change</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="index.php?page=kategoris" class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>
</div>
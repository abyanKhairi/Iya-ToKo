<?php
$pdo = Koneksi::connect();
$storeBranch = storeBranch::makeObjek($pdo);

if (isset($_POST['create'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $nomorHp = htmlspecialchars($_POST['nomorHp']);
    $status = htmlspecialchars($_POST['status']);
    $id_store = htmlspecialchars($_POST['id_store']);

    if ($storeBranch->addStoreBranch($id_store, $nama, $email, $nomorHp, $status)) {
        echo "<script>window.location.href='index.php?page=storeBranch&msg=tambahSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=storeBranch&msg=tambahError'</script>";
    }
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Store Branch</h1>
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
                                    <label for="nama">Nama Toko Branch</label>
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
                                <div class="input-group mb-3">
                                    <label for="status">Status Toko</label>
                                    <select class="form-control" name="status" style="width: 100%;">
                                        <option value="utama">Utama</option>
                                        <option value="cabang">Cabang</option>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <label for="store">Store</label>
                                    <select class="form-control" name="id_store" style="width: 100%;" required>
                                        <?php
                                        $store = Store::makeObjek($pdo);
                                        $rows = $store->showstore(@$keyword);
                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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
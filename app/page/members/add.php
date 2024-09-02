<?php
$pdo = Koneksi::connect();
$members = Members::makeObjek($pdo);

if (isset($_POST['create'])) {
    $kode = htmlspecialchars($_POST['kode']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $noHp = htmlspecialchars($_POST['noHp']);
    $id_store = htmlspecialchars($_POST['store']);

    if ($members->addMembers($id_store, $kode, $nama, $email, $noHp)) {
        echo "<script>window.location.href='index.php?page=members&msg=tambahSuccess'</script>";
    } else {
        // echo "<script>window.location.href='index.php?page=members&msg=tambahError'</script>";
    }
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Members</h1>
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
                                    <label for="kode">Kode</label>
                                    <input type="text" name="kode" class="form-control" id="kode" required placeholder="Kode">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" required id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="noHp">Nomor Hp</label>
                                    <input type="text" name="noHp" class="form-control" required id="noHp" placeholder="Nomor Hp">
                                </div>
                                <div class="input-group">
                                    <label for="role">Store</label>
                                    <select class="form-control" name="store" style="width: 100%;" required>
                                        <?php
                                        $store = Store::makeObjek($pdo);
                                        $StoreRows = $store->showStore(@$keyword);
                                        foreach ($StoreRows as $row) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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
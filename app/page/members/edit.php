<?php
$pdo = Koneksi::connect();
$members = Members::makeObjek($pdo);

$id_members = $_GET['id'];

if (isset($_POST['edit'])) {
    $kode = htmlspecialchars($_POST['kode']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $noHp = htmlspecialchars($_POST['noHp']);

    if ($members->editMembers($id_members, $kode, $nama, $email, $noHp)) {
        echo "<script>window.location.href='index.php?page=members&msg=editSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=members&msg=editError'</script>";
    }
}

if (isset($id_members)) {
    extract($members->getId($id_members));
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
                                    <input type="text" name="kode" class="form-control" value="<?= htmlspecialchars($kode) ?>" id="kode" required placeholder="Kode">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($nama) ?>" id="nama" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($email) ?>" required id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="noHp">Nomor Hp</label>
                                    <input type="text" name="noHp" class="form-control" value="<?= htmlspecialchars($nomor_hp) ?>" required id="noHp" placeholder="Nomor Hp">
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="edit" class="btn btn-primary">Change</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="index.php?page=members" class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>
</div>
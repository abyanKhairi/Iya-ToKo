<?php
$pdo = Koneksi::connect();
$user = user::makeObjek($pdo);
$id_user = $_GET['id'];

if (isset($_POST['edit'])) {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $role = $_POST["role"];

    if ($user->editUser($id_user, $nama, $email, $role)) {
        echo "<script>window.location.href='index.php?page=user&msg=editSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=user&msg=editError'</script>";
    }
}


if (isset($id_user)) {
    extract($user->getId($id_user));
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah user</h1>
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
                                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?= $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="email" value="<?= $email; ?>" placeholder="Email">
                                </div>

                                <?php
                                if ($currentUser['role'] == 'adminKasir' || $currentUser['role'] == 'adminGudang') {
                                ?>
                                    <input type="hidden" name="role" value="<?= $role ?>">
                                <?php
                                } else {
                                ?>
                                    <div class="input-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" name="role" style="width: 100%;">
                                            <option value="owner" <?= ($role == 'owner') ? 'selected' : '' ?>>Owner</option>
                                            <option value="superAdmin" <?= ($role == 'superAdmin') ? 'selected' : '' ?>>Super Admin</option>
                                            <option value="adminGudang" <?= ($role == 'adminGudang') ? 'selected' : '' ?>>Admin Gudang</option>
                                            <option value="adminKasir" <?= ($role == 'adminKasir') ? 'selected' : '' ?>>Admin Kasir</option>
                                        </select>
                                    </div>
                                <?php
                                }
                                ?>

                                <br>
                                <div class="form-group">
                                    <label><a href="index.php?page=user&act=new&id=<?= $id_user ?>">Change Password</a></label>
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="edit" class="btn btn-primary">Change</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="index.php?page=user" class="btn btn-danger">Cancel</a>

                    </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
</div>
</section>
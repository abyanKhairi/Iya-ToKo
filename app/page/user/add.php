<?php

$pdo = Koneksi::connect();
$user = User::makeObjek($pdo);
$store = Store::makeObjek($pdo);

if (isset($_POST["create"])) {
    $name = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $id_store = $_POST['store'];
    if ($user->addUser($name, $email, $password, $id_store, $role)) {
        echo "<script>window.location.href='index.php?page=user&msg=tambahSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=user&msg=tambahError'</script>";
    }
}


?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah user</h1>
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
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" required id="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" required id="password" placeholder="Password">
                                </div>

                                <div class="input-group">
                                    <label for="role">Store</label>
                                    <select class="form-control" name="store" style="width: 100%;" required>
                                        <?php
                                        $StoreRows = $store->showStore(@$keyword);
                                        foreach ($StoreRows as $row) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                                <div class="input-group">
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role" required style="width: 100%;">
                                        <option value="owner">Owner</option>
                                        <option value="superAdmin">Super Admin</option>
                                        <option value="adminGudang">Admin Gudang</option>
                                        <option value="adminKasir">Admin Kasir</option>
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu User</h1>
                </div>

                <?php
                if (isset($_POST['cari'])) {
                    $keyword = $_POST['keyword'];
                }
                if ($currentUser['role'] === 'adminGudang' || $currentUser['role'] === 'adminKasir') {
                } else {
                ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="index.php?page=user&act=create">
                                <button type="button" class="btn btn-primary">
                                    Tambah User
                                </button>
                            </a>
                        </ol>
                    </div>
                <?php
                }
                ?>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-18 col-md-16 mb-md-3 col-lg-12">
                                <form action="" method="post">
                                    <div class="form-grup">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type='text' class="form-control" name="keyword" autocomplete="off" placeholder="Nama User">
                                            </div>
                                            <button class="btn btn-primary btn-action mr-1" type="submit" style="cursor: pointer;" name="cari"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Store</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $pdo = Koneksi::connect();
                                    $user = User::makeObjek($pdo);
                                    $rows = $user->showUsers(@$keyword);
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td><?= $row["name"] ?></td>
                                            <td><?= $row["email"] ?></td>
                                            <td><?= $row["store_name"] ?></td>
                                            <td><?= $row["role"] ?></td>
                                            <?php
                                            if ($currentUser['id'] == $row['id'] && $currentUser['role'] == 'adminGudang' || $currentUser['id'] == $row['id'] && $currentUser['role'] == 'adminKasir') {
                                            ?>
                                                <td>
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=user&act=edit&id=<?= $row["id"] ?>"><i class="fas fa-edit"></i></a>
                                                </td>
                                            <?php
                                            } elseif ($currentUser['role'] == 'owner' || $currentUser['role'] == 'superAdmin') {
                                            ?>
                                                <td>
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=user&act=edit&id=<?= $row["id"] ?>"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-action mr-1 btn-delete" data-id="<?= $row["id"] ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Store</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const idUser = this.getAttribute('data-id');

            Swal.fire({
                title: 'Apakah Yakin Ingin Menghapus Data Ini?',
                text: "Data Yang Dihapus Tidak Dapat Dikembalikan Lagi",
                textColor: 'white',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya , Hapus Data',
                cancelButtonText: 'Tida, Jangan Hapus',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `index.php?page=user&act=delete&id=${idUser}`;
                }
            });
        });
    });
</script>
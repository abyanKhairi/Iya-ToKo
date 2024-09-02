<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Store Branch</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="index.php?page=storeBranch&act=create">
                            <button type="button" class="btn btn-primary">
                                Tambah Store Branch
                            </button>
                        </a>
                    </ol>
                </div>
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
                                                <input type='text' class="form-control" name="keyword" autocomplete="off" placeholder="Nama Store Branch">
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
                                        <th>Nomor Hp</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    if (isset($_POST['cari'])) {
                                        $keyword = $_POST['keyword'];
                                    }
                                    $pdo = Koneksi::connect();
                                    $storeBranch = storeBranch::makeObjek($pdo);
                                    $rows = $storeBranch->showStoreBranch(@$keyword);
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row["nama"]) ?></td>
                                            <td><?= htmlspecialchars($row["email"]) ?></td>
                                            <td><?= htmlspecialchars($row["nomor_hp"]) ?></td>
                                            <td><?= htmlspecialchars($row["status"]) ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" href="index.php?page=storeBranch&act=edit&id=<?= $row["id"] ?>"><i class="fas fa-edit"></i></a>
                                                <a class="btn btn-danger btn-action mr-1" href="index.php?page=storeBranch&act=delete&id=<?= $row["id"] ?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Nomor Hp</th>
                                        <th>Status</th>
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
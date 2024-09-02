<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Produk Branch</h1>
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
                            <h3 class="card-title">Produk Branch</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Branch Name</th>
                                        <th>Email</th>
                                        <th>Nomor Hp</th>
                                        <th>Total Produks</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $pdo = Koneksi::connect();
                                    $storeBranch = storeBranch::makeObjek($pdo);
                                    $countOBjK = count::makeObjek($pdo);
                                    $rows = $storeBranch->showStoreBranch(@$keyword);
                                    foreach ($rows as $row) {

                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row["nama"]) ?></td>
                                            <td><?= htmlspecialchars($row["email"]) ?></td>
                                            <td><?= htmlspecialchars($row["nomor_hp"]) ?></td>
                                            <td><?= $countOBjK->countById('produksbranch', 'id', 'id_branch', $row['id']) ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" href="index.php?page=produkBranch&act=produk&id=<?= $row["id"] ?>"><i class="fas fa-box"></i></a>
                                                <a class="btn btn-warning btn-action mr-1" href="index.php?page=produkBranch&act=history&id=<?= $row["id"] ?>"><i class="fas fa-clock"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Branch Name</th>
                                        <th>Email</th>
                                        <th>Nomor Hp</th>
                                        <th>Total Produks</th>
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
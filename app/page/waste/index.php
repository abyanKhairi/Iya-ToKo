<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
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
                            <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Store Branch</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $pdo = Koneksi::connect();
                                    $waste = Waste::makeObjek($pdo);
                                    $rows = $waste->getWaste();
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="align-middle"><img width="120px" src="../assets/produkImg/<?= htmlspecialchars($row['gambar']) ?>" alt=""></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["nama_produk"]) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["nama_toko"]) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["jumlah"]) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["kategori"]) ?></td>
                                            <td class="align-middle">
                                                <!-- <a class="btn btn-primary btn-action mr-1" href="index.php?page=storeBranch&act=edit&id=<?= $row["id"] ?>"><i class="fas fa-edit"></i></a> -->
                                                <a class="btn btn-danger btn-action mr-1" href="index.php?page=waste&act=delete&id=<?= $row["id"] ?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Store Branch</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                        <!-- <th>Action</th> -->
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
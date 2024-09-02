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
                                        <th>Jumlah</th>
                                        <th>Jenis</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $id_branch = $_GET['id'];
                                    $pdo = Koneksi::connect();
                                    $produkbranch = ProdukBranch::makeObjek($pdo);
                                    $rows = $produkbranch->showHistory($id_branch);
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="align-middle"><img width="120px" src="../assets/produkImg/<?= htmlspecialchars($row['gambar']) ?>" alt=""></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["nama"]) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["qty"]) ?></td>
                                            <?php
                                            if ($row["jenis"] === 'stock_out') {

                                                echo '<td class="align-middle">Barang Keluar</td>';
                                            } else {

                                                echo '<td class="align-middle">Barang Masuk</td>';
                                            }
                                            ?>
                                            <td class="align-middle"><?= htmlspecialchars($row["keterangan"]) ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                    <th>Jenis</th>
                                    <th>Keterangan</th>
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
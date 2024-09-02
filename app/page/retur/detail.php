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
                <div class="col">
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
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $id_retur = $_GET['id'];
                                    $pdo = Koneksi::connect();
                                    $retur = Retur::makeObjek($pdo);
                                    $rows = $retur->getDetailRetur($id_retur);
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="align-middle">
                                                <img width="100px" src="../assets/produkImg/<?= htmlspecialchars($row['gambar']) ?>" alt="">
                                            </td>
                                            <td class="align-middle"><?= htmlspecialchars($row["nama"]) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["qty"]) ?></td>
                                            <td class="align-middle">Rp. <?= number_format(htmlspecialchars($row["harga_beli"])) ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
                <!-- /.col -->

                <!-- /.content -->
            </div>
        </div>
    </section>
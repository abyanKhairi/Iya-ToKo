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
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $id_po = $_GET['id'];
                                    $pdo = Koneksi::connect();
                                    $Order = Ordered::makeObjek($pdo);
                                    $count = Count::makeObjek($pdo);
                                    $rows = $Order->orderDiantar($id_po);
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row["nama"]) ?></td>
                                            <td><?= htmlspecialchars($row["qty"]) ?></td>
                                            <td>Rp. <?= number_format(htmlspecialchars($row["harga_beli"])) ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
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


                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Tujuan</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Tanggal Sampai</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $rows = $Order->getOrderDiantar($id_po);
                                    $harga = $count->totalHargaOrder($id_po);
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($rows["nama_sup"]) ?></td>
                                        <td><?= htmlspecialchars($rows["nama_branch"]) ?></td>
                                        <td>Rp. <?= number_format($harga) ?></td>
                                        <td><?= htmlspecialchars($rows["tanggal_pengiriman"]) ?></td>
                                        <td><?= htmlspecialchars($rows["tanggal_jatuh_tempo"]) ?></td>
                                    </tr>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Supplier</th>
                                        <th>Tujuan</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Tanggal Sampai</th>
                                    </tr>
                                </tfoot>
                            </table> <br>
                            <div>
                                <a href="index.php?page=penerimaan&act=diterima&id=<?= $id_po ?>">
                                    <button class="btn btn-primary">Selesai</button>
                                </a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="index.php?page=retur&act=add&id=<?= $id_po ?>">
                                    <button class="btn btn-danger">Retur</button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->

                <!-- /.content -->
            </div>
        </div>
    </section>
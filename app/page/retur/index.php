<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Pengembalian</h1>
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
                            <h3 class="card-title">Pengembalian Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No Order</th>
                                        <th>No Retur</th>
                                        <th>Tanggal Order</th>
                                        <th>Tanggal Retur</th>
                                        <th>Jumlah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $pdo = Koneksi::connect();
                                    $retur = Retur::makeObjek($pdo);
                                    $count = Count::makeObjek($pdo);
                                    $rows = $retur->showretur();
                                    foreach ($rows as $row) {
                                        $jumlahRetur = $count->countById('purchase_order_retur_detail', 'id', 'id_po_retur', $row['id'])
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row["no_po"]) ?></td>
                                            <td><?= htmlspecialchars($row["no_retur"]) ?></td>
                                            <td><?= htmlspecialchars($row["tanggal_po"]) ?></td>
                                            <td><?= htmlspecialchars($row["tanggal_retur"]) ?></td>
                                            <td><?= htmlspecialchars($jumlahRetur) ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" href="index.php?page=retur&act=detail&id=<?= $row["id"] ?>"><i class="fas fa-box"></i></a>
                                                <!-- <a class="btn btn-danger btn-action mr-1" href="index.php?page=penerimaan&act=delete&id=<?= $row["id"] ?>"><i class="fas fa-trash"></i></a> -->
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>No Order</th>
                                        <th>No Retur</th>
                                        <th>Tanggal Order</th>
                                        <th>Tanggal Retur</th>
                                        <th>Jumlah</th>
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
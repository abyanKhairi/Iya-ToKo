<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Order</h1>
                </div>
                <?php
                if ($currentUser['role'] == 'owner') {
                } else {
                    echo '
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="index.php?page=ordered&act=create">
                                <button type="button" class="btn btn-primary">
                                    Tambah Order
                                </button>
                            </a>
                        </ol>
                    </div>
                    
                    ';
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
                            <h3 class="card-title">Ordered</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No Order</th>
                                        <th>Supplier</th>
                                        <th>Tujuan</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Order</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Tanggal Sampai</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $pdo = Koneksi::connect();
                                    $Order = Ordered::makeObjek($pdo);
                                    $count = Count::makeObjek($pdo);
                                    $rows = $Order->showOrder();
                                    foreach ($rows as $row) {
                                        $jumlahOrderDetail  = $count->countById('purchase_order_detail', 'id', 'id_po', $row['id'])
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row["no_po"]) ?></td>
                                            <td><?= htmlspecialchars($row["nama_supplier"]) ?></td>
                                            <td><?= htmlspecialchars($row["nama_branch"]) ?></td>
                                            <td><?= htmlspecialchars($jumlahOrderDetail) ?></td>
                                            <td><?= htmlspecialchars($row["tanggal_po"]) ?></td>
                                            <td><?= htmlspecialchars($row["tanggal_pengiriman"]) ?></td>
                                            <td><?= htmlspecialchars($row["tanggal_jatuh_tempo"]) ?></td>
                                            <?php
                                            if ($row['status'] === "dikirim") {
                                            ?>
                                                <td>
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=ordered&act=diantar&id=<?= $row["id"] ?>"><i class="fas fa-truck"></i></a>
                                                </td>
                                            <?php
                                            } elseif ($row['status'] === "sampai") {
                                            ?>
                                                <td>Barang Telah Sampai</td>
                                            <?php
                                            } else {
                                            ?>
                                                <td>
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=ordered&act=edit&id=<?= $row["id"] ?>"><i class="fas fa-edit"></i></a>
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=ordered&act=detail&id=<?= $row["id"] ?>"><i class="fas fa-box"></i></a>
                                                    <a class="btn btn-danger btn-action mr-1" href="index.php?page=ordered&act=delete&id=<?= $row["id"] ?>"><i class="fas fa-trash"></i></a>
                                                </td>
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
                                        <th>No Order</th>
                                        <th>Supplier</th>
                                        <th>Tujuan</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Order</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Tanggal Sampai</th>
                                        <th>Action</th>
                                    </tr>
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
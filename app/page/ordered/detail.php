<?php
$id_po = $_GET['id'];

$pdo = Koneksi::connect();
$Order = Ordered::makeObjek($pdo);
$rows = $Order->showOrderDetail($id_po);
$produks = Produks::makeObjek($pdo);
$produkRows = $Order->getProdukOrder($id_po);

if (isset($_POST['add'])) {
    $produkDetail = htmlspecialchars($_POST['produk']);
    $qty = htmlspecialchars($_POST['qty']);

    if (isset($produkDetail)) {
        extract($Order->getHargaBeli($produkDetail));
    }
    $harganya = $harga_set * $qty;

    if ($Order->addOrderDetail($id_po, $produkDetail, $qty, $harganya)) {
        echo "<script>window.location.href='index.php?page=ordered&act=detail&id=$id_po'</script>";
    }
}

?>




<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Order</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button type="button" data-toggle="modal" data-target="#modal-secondary" class="btn btn-primary">
                            Tambah Order
                        </button>
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
                            <h3 class="card-title">Detail Produks Yang Akan Diorder</h3>
                            <?php
                            if ($rows == true) {
                            ?>
                                ?>
                                <a href="index.php?page=ordered&act=bayar&id=<?= $id_po ?>">
                                    <button type="button" class="btn btn-primary float-sm-right">
                                        Pesan Dan Bayar
                                    </button>
                                </a>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nomor Seri</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="align-middle"><img width="120px" src="../assets/produkImg/<?= $row['gambar'] ?>" alt=""></td>
                                            <td class="align-middle"><?= $row["id"] ?></td>
                                            <td class="align-middle"><?= $row["nama"] ?></td>
                                            <td class="align-middle"><?= $row["qty"] ?></td>
                                            <td class="align-middle">Rp.<?= number_format($row['harga_beli']) ?></td>
                                            <td class="align-middle">
                                                <!-- <a class="btn btn-primary btn-action mr-1" href="index.php?page=ordered&act=edit&id=<?= $row["id"] ?>"><i class="fas fa-edit"></i></a> -->
                                                <a class="btn btn-danger btn-action mr-1" href="index.php?page=ordered&act=delete&id_POdetail=<?= $row["id"] ?>&id_po=<?= $id_po ?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nomor Seri</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-secondary">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Order Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="produk">Produk</label>
                                <select class="form-control" name="produk" id="produk">
                                    <?php
                                    foreach ($produkRows as $Prow) {
                                    ?>
                                        <option value="<?= $Prow['id'] ?>"><?= $Prow['nama'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">Jumlah Produk</label>
                                <input type="number" name="qty" class="form-control" id="qty" required placeholder="Jumlah Produk">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>
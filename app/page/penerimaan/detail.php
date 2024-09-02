<?php
$id_penerimaan = $_GET['id'];
$pdo = Koneksi::connect();
$penerima = Penerimaan::makeObjek($pdo);
$rows = $penerima->showPenerimaanDetail($id_penerimaan);

$get_id_branch = $penerima->getIdBranch($id_penerimaan);
$id_branch = $get_id_branch['id_store_branch'];
if (isset($_POST['tombol_terima'])) {
    $jenis = htmlspecialchars('stock_in');
    $keterangan = htmlspecialchars('Pembelian Stock Untuk Product Branch');
    foreach ($rows as $row) {
        $stok_masuk = htmlspecialchars($row['qty']);
        $id_produk = htmlspecialchars($row['id_produk']);
        $penerima->tambahStokBranch($stok_masuk, $id_produk, $id_branch, $id_penerimaan, $jenis, $keterangan);
    }
}

$status = $penerima->getStatus($id_penerimaan);

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Penerimaan</h1>
                </div>

                <?php
                if ($status['status'] === "diterima") {
                } else {
                ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <form method="post">
                                <button name="tombol_terima" type="submit" data-toggle="modal" data-target="#modal-secondary" class="btn btn-primary">
                                    Terima Barang
                                </button>
                            </form>
                        </ol>
                    </div>
                <?php
                } ?>
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
                                        <th>Tanggal Exp</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="align-middle"><img width="120px" src="../assets/produkImg/<?= htmlspecialchars($row['gambar']) ?>" alt=""></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['nama']) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['qty']) ?></td>
                                            <td class="align-middle">Rp. <?= number_format(htmlspecialchars($row['harga_beli'])) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['tanggal_exp']) ?></td>
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
                                        <th>Tanggal Exp</th>
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
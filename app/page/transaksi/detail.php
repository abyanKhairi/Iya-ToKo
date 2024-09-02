<?php
$id_transaksi = $_GET['id'];
$id_branch = $_GET['branch'];

$transaksi = Transaksi::makeObjek($pdo);

$rows = $transaksi->getDetailTransaksi($id_transaksi);
$produkRows = $transaksi->getProdukBranch($id_branch);


if (isset($_POST['add'])) {
    $id = htmlspecialchars($_POST['produk']);
    $qty = htmlspecialchars($_POST['qty']);
    $harga = htmlspecialchars($transaksi->getHarga($id_branch, $id));
    $total = htmlspecialchars($qty) * htmlspecialchars($harga);
    $jenis = 'stok_out';
    $keterangan = "Barang Pembelian Members";

    if ($transaksi->addDetail($id_transaksi, $id, $harga, $qty, $total, $id_branch, $jenis, $keterangan)) {
        echo "<script>window.location.href='index.php?page=transaksi&act=detail&id=$id_transaksi&branch=$id_branch&msg=tambahSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=transaksi&act=detail&id=$id_transaksi&branch=$id_branch&msg=tambahError'</script>";
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
                                <a href="index.php?page=transaksi&act=bayar&id=<?= $id_transaksi ?>">
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
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="align-middle"><img width="120px" src="../assets/produkImg/<?= htmlspecialchars($row['gambar']) ?>" alt=""></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["nama"]) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row["qty"]) ?></td>
                                            <td class="align-middle">Rp. <?= htmlspecialchars(number_format($row["harga"])) ?></td>
                                            <td class="align-middle">Rp. <?= htmlspecialchars(number_format($row["total"])) ?></td>
                                            <td class="align-middle">
                                                <button class="btn btn-danger btn-action mr-1 btn-delete" data-transaksi="<?= $id_transaksi ?>" data-produk-branch="<?= $row['id_produk_branch'] ?>" data-branch="<?= $id_branch ?>" data-detail="<?= $row['id'] ?>"><i class="fas fa-trash"></i></button>
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

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const idTransaksi = this.getAttribute('data-transaksi');
            const idBranch = this.getAttribute('data-branch');
            const idDetail = this.getAttribute('data-detail');
            const idProdukBranch = this.getAttribute('data-produk-branch');

            Swal.fire({
                title: 'Apakah Yakin Ingin Menghapus Data Ini?',
                text: "Data Yang Dihapus Tidak Dapat Dikembalikan Lagi",
                textColor: 'white',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya , Hapus Data',
                cancelButtonText: 'Tida, Jangan Hapus',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `index.php?page=transaksi&act=delete&transaksi=${idTransaksi}&branch=${idBranch}&detail=${idDetail}&produk=${idProdukBranch}`;
                }
            });
        });
    });
</script>
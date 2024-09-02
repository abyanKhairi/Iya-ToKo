<?php
$pdo = Koneksi::connect();
$produkBranch = ProdukBranch::makeObjek($pdo);
$id_branch = $_GET['id'];

if (isset($_POST['create'])) {
    $idProduk = htmlspecialchars($_POST['id_produk']);
    $stok = htmlspecialchars(0);
    $minStok = htmlspecialchars($_POST['minStok']);
    $harga = htmlspecialchars($_POST['harga']);
    $satuan = htmlspecialchars($_POST['satuan']);

    if ($produkBranch->addProdukBranch($idProduk, $id_branch, $stok, $minStok, $harga, $satuan)) {
        echo "<script>window.location.href='index.php?page=produkBranch&act=produk&id=$id_branch&msg=tambahSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=produkBranch&act=produk&id=$id_branch&msg=tambahError'</script>";
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah produk</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <label for="Produks">Produks</label>
                                    <select class="form-control" name="id_produk" style="width: 100%;" required>
                                        <?php
                                        $Produks = ProdukBranch::makeObjek($pdo);
                                        $rows = $Produks->getProdukInBranch($id_branch);
                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga">
                                </div>

                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" name="satuan" class="form-control" id="satuan" placeholder="Satuan">
                                </div>

                                <div class="form-group">
                                    <label for="minStok">Minimum Stock</label>
                                    <input type="number" name="minStok" class="form-control" id="minStok" placeholder="Minimum Stokck">
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="create" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>
</div>
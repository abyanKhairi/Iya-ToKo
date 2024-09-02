<?php

$pdo = Koneksi::connect();
$produkBranch = ProdukBranch::makeObjek($pdo);

$id_branch = $_GET['id_branch'];
$id = $_GET['id'];

if (isset($_POST['create'])) {
    $id_produk = htmlspecialchars($_POST['id_produk']);
    $minStok = htmlspecialchars($_POST['minStok']);
    $harga = htmlspecialchars($_POST['harga']);
    $satuan = htmlspecialchars($_POST['satuan']);

    if ($produkBranch->editProdukBranch($id_produk, $minStok, $harga, $satuan, $id)) {
        echo "<script>window.location.href='index.php?page=produkBranch&act=produk&id=$id_branch'</script>";
    } else {
        echo "<script>alert('tidak bisa')</script>";
    }
}

if (isset($id)) {
    extract($produkBranch->getId($id));
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
                                        $rows = $produkBranch->showProdukBranch($id_branch);
                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['id_produk'] ?>"><?= $row['nama_produk'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" value="<?= htmlspecialchars($harga) ?>" class="form-control" id="harga" placeholder="Harga">
                                </div>

                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" name="satuan" value="<?= htmlspecialchars($satuan) ?>" class="form-control" id="satuan" placeholder="Satuan">
                                </div>
                                <div class="form-group">
                                    <label for="minStok">Minimum Stock</label>
                                    <input type="number" name="minStok" value="<?= htmlspecialchars($min_stok) ?>" class="form-control" id="minStok" placeholder="Minimum Stokck">
                                </div>
                            </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" name="create" class="btn btn-primary">Submit</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="index.php?page=produkBranch" class="btn btn-danger">Cancel</a>
                    </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
    </section>
</div>
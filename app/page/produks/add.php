<?php

$pdo = Koneksi::connect();
$produks = Produks::makeObjek($pdo);
$count = Count::makeObjek($pdo);

if (isset($_POST['create'])) {
    $sn = $count->randNum();
    $nama = htmlspecialchars($_POST['nama']);
    $harga = htmlspecialchars($_POST['harga']);
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $id_kategoris = htmlspecialchars($_POST['kategoris']);
    $id_store = htmlspecialchars($_POST['store']);

    $extensi = explode(".", $_FILES['gambar']['name'], ENT_QUOTES);
    $gambarProduk = "gambar-" . round(microtime(true)) . "." . end($extensi);
    $sumber = $_FILES['gambar']['tmp_name'];
    $upload = move_uploaded_file($sumber, "../assets/produkImg/" . $gambarProduk);

    if ($produks->addProduks($id_kategoris, $id_store, $sn, $nama, $gambarProduk, $harga, $keterangan)) {
        echo "<script>window.location.href='index.php?page=produks&msg=tambahSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=produks&msg=tambahError'</script>";
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
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" class="form-control" id="nama" required placeholder="Nama">
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" name="gambar" class="form-control" required id="gambar" placeholder="Nomor Hp">
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="text" name="harga" class="form-control" id="harga" placeholder="Harga">
                                </div>

                                <div class="form-group">
                                    <label for="harga">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" id="harga" placeholder="Harga">
                                </div>

                                <div class="input-group mb-3">
                                    <label for="kategoris">Kategori</label>
                                    <select class="form-control" name="kategoris" style="width: 100%;">
                                        <?php
                                        $kategoris = Kategoris::makeObjek($pdo);
                                        $rows = $kategoris->showKategoris();

                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                            <option value=""></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <label for="store">Store</label>
                                    <select class="form-control" name="store" style="width: 100%;" required>
                                        <?php
                                        $store = Store::makeObjek($pdo);
                                        $rows = $store->showstore(@$keyword);

                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
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
<?php
$id_branch = $_GET['id_branch'];
$id_produkBranch = $_GET['id'];

$pdo = Koneksi::connect();
$waste = Waste::makeObjek($pdo);
$data = $waste->getPenerimaanData($id_branch);
$dataProduk = $waste->getProdukBranch($id_produkBranch);

if (isset($_POST['waste'])) {
    $id_penerima = htmlspecialchars($data['id']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jumlah = htmlspecialchars($_POST['qty']);
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $jenis = htmlspecialchars('stock_out');

    if ($waste->addWaste($id_produkBranch, $id_penerima, $kategori, $jumlah, $id_branch, $jenis, $keterangan)) {
        echo "<script>window.location.href='index.php?page=waste'</script>";
    }
}

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Produk Branch Yang Bermasalah</h1>
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
                            <h3 class="card-title">Produk Bermasalah</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="produk">Produk</label>
                                    <input type="text" value="<?= $dataProduk['nama'] ?>" name="produk" class="form-control" readonly id="diterima">
                                </div>

                                <div class="form-group">
                                    <label for="diterima">Diterima Oleh</label>
                                    <input type="text" value="<?= $data['diterima_oleh'] ?>" name="diterima" class="form-control" readonly id="diterima">
                                </div>

                                <div class="form-group">
                                    <label for="diperiksa">Diperiksa Oleh</label>
                                    <input type="text" value="<?= $data['diperiksa_oleh'] ?>" name="diperiksa" class="form-control" readonly id="diperiksa"">
                                </div>
                                
                                <div class=" form-group">
                                    <label for="qty">Jumlah</label>
                                    <input type="number" name="qty" class="form-control" required id="qty" placeholder="Jumlah Produk">
                                </div>

                                <div class=" input-group mb-3">
                                    <label for="store">Masalah Yang Dialami</label>
                                    <select class="form-control" name="kategori" style="width: 100%;" requ <option value=""><?= $row['name'] ?></option>
                                        <option value="Expired">Expired</option>
                                        <option value="Rusak">Rusak</option>
                                        <option value="Hilang">Hilang</option>
                                    </select>
                                </div>

                                <div class=" form-group">
                                    <label for="ket">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" required id="ket" placeholder="Keterangan">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="waste" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
    </section>
</div>
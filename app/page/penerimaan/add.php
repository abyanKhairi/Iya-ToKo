<?php
$id_po = $_GET['id'];
$pdo = Koneksi::connect();
$penerima = Penerimaan::makeObjek($pdo);
$dataTerima = $penerima->getDataPOdetail($id_po);
$count = Count::makeObjek($pdo);


if (isset($_POST['bayar'])) {
    $diterima = htmlspecialchars($_POST['diterima']);
    $diperiksa = htmlspecialchars($_POST['diperiksa']);
    $tanggal_terima = htmlspecialchars($_POST['date']);
    $id_penerima = $penerima->addPenerima($id_po, $tanggal_terima, $diterima, $diperiksa);
    if ($id_penerima) {
        $penerima->statusSampai($id_po);
        foreach ($dataTerima as $data) {
            $kode_batch = $count->randNum();
            $penerima->addPenerimaanDetail($id_penerima, $data['id'], $data['id_produk'], $tanggal_terima, $data['qty'], $kode_batch);
        }
        echo "<script>window.location.href='index.php?page=penerimaan&act=detail&id=$id_penerima&msg=Diterima'</script>";
    } else {
        echo "<script>alert('tidak')</script>";
    }
}


?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pembayaran Order</h1>
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
                            <h3 class="card-title">Bayar</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            <div class="card-body">

                                <div class="input-group mb-3">
                                    <label for="diterima">Diterima Oleh</label>
                                    <select class="form-control" name="diterima" style="width: 100%;" required>
                                        <?php
                                        $rows = $penerima->getUserPenerima();
                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['name'] ?>"><?= $row['name'] ?> (<?= $row['role'] ?>)</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <label for="diperiksa">Diperiksa Olehh</label>
                                    <select class="form-control" name="diperiksa" style="width: 100%;" required>
                                        <?php
                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['name'] ?>"><?= $row['name'] ?> (<?= $row['role'] ?>)</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="ntgl">Tanggal Penerimaan</label>
                                    <input name="date" value="<?= date("Y-m-d") ?>" class="form-control" id="date">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="bayar" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
    </section>
</div>
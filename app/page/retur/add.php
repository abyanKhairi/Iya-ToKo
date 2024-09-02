<?php
$id_po = $_GET['id'];
$pdo = Koneksi::connect();
$retur = Retur::makeObjek($pdo);
$dataRetur = $retur->getPOdata($id_po);
$count = Count::makeObjek($pdo);

if (isset($_POST['retur'])) {
    $no_retur = $count->randNum();
    $tanggal_retur = htmlspecialchars($_POST['tglRetur']);
    $id_retur = $retur->addRetur($id_po, $no_retur, $tanggal_retur);
    if ($id_retur) {
        echo "<script>window.location.href='index.php?page=retur&act=produk&id=$id_retur&id_po=$id_po'</script>";
    }
}

?>


<div class="content-wrapper">
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
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="no_retur">Nomor Purchase Order</label>
                                    <input type="number" readonly value="<?= $dataRetur['no_po']; ?>" class="form-control" id="no_po" required placeholder="Nomor Retur">
                                </div>
                                <div class="form-group">
                                    <label for="no_retur">Tanggal Purchase</label>
                                    <input type="date" readonly value="<?= $dataRetur['tanggal_po'] ?>" class="form-control" id="no_po" required placeholder="Nomor Retur">
                                </div>
                                <div class="form-group">
                                    <label for="branch">Tanggal Retur</label>
                                    <input type="date" name="tglRetur" value="<?= date("Y-m-d") ?>" class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="retur" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
    </section>
</div>
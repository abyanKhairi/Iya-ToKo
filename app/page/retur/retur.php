<?php
$id_po = $_GET['id_po'];
$id_po_detail = $_GET['id_poDetail'];
$id_retur = $_GET['id'];

$pdo = Koneksi::connect();
$retur = Retur::makeObjek($pdo);
$count = Count::makeObjek($pdo);
$data =  $retur->getDataPoDetail($id_po_detail, $id_po);
$hargaSet = $data['harga_set'];

if (isset($_POST['retur'])) {
    $jumlah = htmlspecialchars($_POST['jumlah']);
    $harga = htmlspecialchars($hargaSet) * htmlspecialchars($jumlah);
    if ($retur->updateOrderDetail($id_po_detail, $id_po, $jumlah, $id_retur, $harga)) {
        echo "<script>window.location.href='index.php?page=retur&act=produk&id=$id_retur&id_po=$id_po'</script>";
    } else {
        echo "<script>alert('tidak')<script>";
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
                            <h3 class="card-title">Retur</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="no_retur">Produk</label>
                                    <input type="text" readonly value="<?= htmlspecialchars($data['nama_produk']) ?>" class="form-control" id="no_po" required placeholder="Produk">
                                </div>
                                <div class="form-group">
                                    <label for="no_retur">Jumlah Saat Ini</label>
                                    <input type="number" readonly value="<?= htmlspecialchars($data['jumlah']) ?>" class="form-control" id="no_po" required placeholder="Jumlah Produk">
                                </div>
                                <div class="form-group">
                                    <label for="no_retur">Jumlah Yang Diretur</label>
                                    <input type="number" name="jumlah" class="form-control" id="no_po" required placeholder="Jumlah Produk Yang Akan  DiRetur">
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
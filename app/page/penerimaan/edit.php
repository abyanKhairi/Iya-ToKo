<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengecekan Barang</h1>
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
                                <div class="form-group">
                                    <label for="harga">Harga Yang Harus Dibayar</label>
                                    <!-- <h3>Rp. <?= number_format($harga) ?></h3> -->
                                </div>
                                <div class="form-group">
                                    <label for="bayar">Uang Yang Dibayarkan</label>
                                    <input type="number" name="dibayar" class="form-control" id="bayar" required placeholder="Uang Yang Dibayarkan">
                                </div>
                                <div class="form-group">
                                    <label for="ntgl">Tanggal Pemesanan</label>
                                    <input name="date" value="<?= date("Y-m-d") ?>" class="form-control" id="date" readonly placeholder="Nomor Purchase Order">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="bayar" class="btn btn-primary">Change</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
    </section>
</div>
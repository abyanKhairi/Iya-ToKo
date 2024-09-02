<?php

include '../database/class/count.php';

$pdo = Koneksi::connect();
$count = new Count($pdo);

$user = $count->count("users");
$members = $count->count("members");
$store = $count->count("store");
$storebranch = $count->count("storebranch");
$produk = $count->count("produks");
$produkbranch = $count->count("produksbranch");
$suppliers = $count->count("suppliers");
$purchase_order = $count->count("purchase_order");
$penerimaan = $count->count("penerimaan");
$transaksi = $count->count("transaksi");

$pendapatan = $count->hitungUang("total", "transaksi_bayar");
$pengeluaran = $count->hitungUang("harga", "order_bayar");

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Iya Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fa fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total User</span>
                            <span class="info-box-number"><?= $user ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-store"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Store</span>
                            <span class="info-box-number"><?= $store ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Produk</span>
                            <span class="info-box-number"><?= $produk ?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

            </div>

            <?php
            if ($currentUser['role'] == 'adminKasir') {
            ?>
                <div class="row"></div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-truck"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Supplier</span>
                                <span class="info-box-number"><?= $suppliers ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-store"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Store Branch</span>
                                <span class="info-box-number"><?= $storebranch ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Penerimaan</span>
                                <span class="info-box-number"><?= $penerimaan ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Purchase Order</span>
                                <span class="info-box-number"><?= $purchase_order ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            <?php }

            if ($currentUser['role'] == 'adminGudang') {
            ?>
                <div class="row"></div>
            <?php
            } else {
            ?>
                <div class="row">

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Member</span>
                                <span class="info-box-number"><?= $members ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Produk Branch</span>
                                <span class="info-box-number"><?= $produkbranch ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-receipt"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Transaksi</span>
                                <span class="info-box-number"><?= $transaksi ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            <?php
            }
            ?>

            <!-- /.row -->


            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <!-- ./card-body -->
                        <div class="card-footer">
                            <div class="row">

                                <?php
                                if ($currentUser['role'] == 'adminGudang') {
                                ?>
                                    <!-- /.col -->
                                    <div class="col-sm-11 col-8">
                                        <div class="description-block">
                                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> PENGELUARAN</span>
                                            <h5 class="description-header">Rp. <?= number_format($pengeluaran) ?></h5>
                                            <span class="description-text">TOTAL PENGELUARAN</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                <?php
                                } elseif ($currentUser['role'] == 'adminKasir') {
                                ?>
                                    <div class="col-sm-11 col-8">
                                        <div class="description-block">
                                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> PENDAPATAN</span>
                                            <h5 class="description-header">Rp. <?= number_format($pendapatan) ?></h5>
                                            <span class="description-text">TOTAL PENDAPATAN</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                <?php
                                } else {
                                ?>

                                    <div class="col-sm-7 col-8">
                                        <div class="description-block">
                                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> PENDAPATAN</span>
                                            <h5 class="description-header">Rp. <?= number_format($pendapatan) ?></h5>
                                            <span class="description-text">TOTAL PENDAPATAN</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>

                                    <div class="col-sm-3 col-6">
                                        <div class="description-block">
                                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> PENGELUARAN</span>
                                            <h5 class="description-header">Rp. <?= number_format($pengeluaran) ?></h5>
                                            <span class="description-text">TOTAL PENGELUARAN</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>

                                <?php
                                }
                                ?>

                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <?php
            if ($currentUser['role'] == 'adminGudang' || $currentUser['role'] == 'adminKasir') {
            ?>
                <div class="col"></div>
            <?php
            } else {
            ?>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pendapatan Dan Pengeluaran</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            <?php
            }
            ?>



        </div>

    </section>
    <!-- /.content -->
</div>
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<script src="../assets/plugins/chart.js/Chart.min.js"></script>

<script>
    var barChartCanvas = $('#barChart').get(0).getContext('2d')

    var barChartData = {
        labels: ['UANG'],
        datasets: [{
            label: 'Pendapatan',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: ['<?= $pendapatan ?> ']
        }, {
            label: 'PENGELUARAN',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [<?=
                    $pengeluaran
                    ?>]
        }]
    }

    var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
    }

    new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
    })
</script>
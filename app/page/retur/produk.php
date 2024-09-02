<?php
$id_po = $_GET['id_po'];
$id_retur = $_GET['id'];
$pdo = Koneksi::connect();
$retur = Retur::makeObjek($pdo);
$count = Count::makeObjek($pdo);
$rows = $retur->orderDiantarRetur($id_po);
$hargaBaru = $count->hargaBaru($id_po);

$retur->kembalikanDana($id_po, $hargaBaru);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Diantar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <button class="btn btn-primary btn-action mr-1 btn-selesai" data-id="<?= $id_po ?>">Selesai</i></button>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Diantar</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php

                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row["nama"]) ?></td>
                                            <td><?= htmlspecialchars($row["qty"]) ?></td>
                                            <td>Rp. <?= htmlspecialchars(number_format($row["harga_beli"])) ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-action mr-1" href="index.php?page=retur&act=retur&id=<?= $id_retur  ?>&id_poDetail=<?= $row['id_poDetail'] ?>&id_po=<?= $id_po ?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
                <!-- /.col -->

                <!-- /.content -->
            </div>
        </div>
    </section>



    <script>
        document.querySelectorAll('.btn-selesai').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const idPo = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Yakin Hanya Ini saja Yang ingin diretur?',
                    text: "Jika Anda Ingin Meretur Produk Lagi Harus Membuat Data Returs Kembali ",
                    textColor: 'white',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya , Sudah Ini Saja',
                    cancelButtonText: 'Tida, Masih Ada Lagi',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `index.php?page=ordered&act=diantar&id=${idPo}`;
                    }
                });
            });
        });
    </script>
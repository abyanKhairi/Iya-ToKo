<?php
$pdo = Koneksi::connect();
$produkBranch = ProdukBranch::makeObjek($pdo);
$id_branch = $_GET['id'];
$rows = $produkBranch->showProdukBranch($id_branch);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Produks Branch</h1>
                </div>
                <?php
                if ($currentUser['role'] == 'owner') {
                } else {
                ?>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="index.php?page=produkBranch&act=create&id=<?= $id_branch ?>">
                                <button type="button" class="btn btn-primary">
                                    Tambah Produks Branch
                                </button>
                            </a>
                        </ol>
                    </div>
                <?php
                }
                ?>
            </div>
        </div><!-- /.container-fluid -->
    </section>



    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nomor Seri</th>
                                        <th>Nama</th>
                                        <th>Stok</th>
                                        <th>Minimun Stok</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="align-middle"><img width="120px" src="../assets/produkImg/<?= htmlspecialchars($row['gambar']) ?>" alt=""></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['id']) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['nama_produk']) ?></td>
                                            <?php
                                            if ($row['stok'] >= $row['min_stok']) {
                                            ?>
                                                <td class="align-middle"><?= htmlspecialchars($row['stok']) ?></td>
                                            <?php
                                            } else {
                                            ?>
                                                <td class="align-middle">Stok Hampir Habis</td>
                                            <?php
                                            }
                                            ?>
                                            <td class="align-middle"><?= htmlspecialchars($row['min_stok']) ?></td>
                                            <td class="align-middle">Rp. <?= number_format(htmlspecialchars($row['harga'])) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['satuan']) ?></td>
                                            <?php
                                            if ($row['stok'] == 0) {
                                            ?>
                                                <td class="align-middle">
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=produkBranch&act=edit&id=<?= $row["id"] ?>&id_branch=<?= $id_branch ?>"><i class="fas fa-edit"></i></a>
                                                </td>
                                            <?php } else {
                                            ?>
                                                <td class="align-middle">
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=produkBranch&act=edit&id=<?= $row["id"] ?>&id_branch=<?= $id_branch ?>"><i class="fas fa-edit"></i></a>
                                                    <a class="btn btn-danger btn-action mr-1" href="index.php?page=waste&act=add&id=<?= $row["id"] ?>&id_branch=<?= $id_branch ?>"><i class="fas fa-trash"></i></a>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nomor Seri</th>
                                        <th>Nama</th>
                                        <th>Stok</th>
                                        <th>Minimun Stok</th>
                                        <th>Harga</th>
                                        <th>Satuan</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
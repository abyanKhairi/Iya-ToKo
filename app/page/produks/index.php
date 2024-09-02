<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Produk</h1>
                </div>
                <?php
                if ($currentUser['role'] == 'owner') {
                } else {
                ?> <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="index.php?page=produks&act=create">
                                <button type="button" class="btn btn-primary">
                                    Tambah produks
                                </button>
                            </a>
                        </ol>
                    </div><?php
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
                            <h3 class="card-title">Produk</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nomor Seri</th>
                                        <th>Nama</th>
                                        <th>Keterangan</th>
                                        <th>Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    $pdo = Koneksi::connect();
                                    $produks = Produks::makeObjek($pdo);
                                    $rows = $produks->showProduks();

                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td class="align-middle"><img width="120px" src="../assets/produkImg/<?= htmlspecialchars($row['gambar']) ?>" alt=""></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['sn']) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['nama']) ?></td>
                                            <td class="align-middle"><?= htmlspecialchars($row['keterangan']) ?></td>
                                            <td class="align-middle">Rp. <?= number_format(htmlspecialchars($row['harga_set'])) ?></td>
                                            <?php
                                            if ($currentUser['role'] == 'owner') {
                                                echo '<td></td>';
                                            } else {
                                            ?>
                                                <td class="align-middle">
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=produks&act=edit&id=<?= $row["id"] ?>"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-action mr-1 btn-delete" data-id="<?= $row["id"] ?>"><i class="fas fa-trash"></i></button>
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
                                        <th>Keterangan</th>
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
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-secondary">
        <div class="modal-dialog">
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h4 class="modal-title">Secondary Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="post">

                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-outline-light">
                        Save changes
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const idProduk = this.getAttribute('data-id');

            Swal.fire({
                title: 'Apakah Yakin Ingin Menghapus Data Ini?',
                text: "Data Yang Dihapus Tidak Dapat Dikembalikan Lagi",
                textColor: 'white',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya , Hapus Data',
                cancelButtonText: 'Tida, Jangan Hapus',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `index.php?page=produks&act=delete&id=${idProduk}`;
                }
            });
        });
    });
</script>
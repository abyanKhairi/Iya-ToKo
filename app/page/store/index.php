<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Store</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="index.php?page=store&act=create">
                            <button type="button" class="btn btn-primary">
                                Tambah store
                            </button>
                        </a>
                    </ol>
                </div>
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
                            <div class="col-18 col-md-16 mb-md-3 col-lg-12">
                                <form action="" method="post">
                                    <div class="form-grup">
                                        <div class="row">
                                            <div class="col-3">
                                                <input type='text' class="form-control" name="keyword" autocomplete="off" placeholder="Nama Store">
                                            </div>
                                            <button class="btn btn-primary btn-action mr-1" type="submit" style="cursor: pointer;" name="cari"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Nomor Hp</th>
                                        <th>Tahun Berdiri</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    if (isset($_POST['cari'])) {
                                        $keyword = htmlspecialchars($_POST['keyword']);
                                    }
                                    $pdo = Koneksi::connect();
                                    $store = Store::makeObjek($pdo);
                                    $rows = $store->showStore(@$keyword);
                                    foreach ($rows as $row) {
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row["name"]) ?></td>
                                            <td><?= htmlspecialchars($row["email"]) ?></td>
                                            <td><?= htmlspecialchars($row["nomor_hp"]) ?></td>
                                            <td><?= htmlspecialchars($row["tahun_berdiri"]) ?></td>
                                            <td>
                                                <a class="btn btn-primary btn-action mr-1" href="index.php?page=store&act=edit&id=<?= $row["id"] ?>"><i class="fas fa-edit"></i></a>
                                                <button class="btn btn-danger btn-action mr-1 btn-delete" data-id="<?= $row["id"] ?>"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Nomor Hp</th>
                                        <th>Tahun Berdiri</th>
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
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            const idStore = this.getAttribute('data-id');

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
                    window.location.href = `index.php?page=store&act=delete&id=${idStore}`;
                }
            });
        });
    });
</script>
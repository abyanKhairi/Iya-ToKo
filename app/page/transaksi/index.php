<?php
$pdo = Koneksi::connect();
$transaksi = Transaksi::makeObjek($pdo);
$members = Members::makeObjek($pdo);
$branch = storeBranch::makeObjek($pdo);
$count = Count::makeObjek($pdo);
$rowsMembers = $members->showMembers(@$keyword);
$rowsBranch = $branch->showStoreBranch(@$keyword);

if (isset($_POST['cari'])) {
    $tanggal = htmlspecialchars($_POST['keyword']);
}

$rows = $transaksi->getTransaksi(@$tanggal);

if (isset($_POST['add'])) {
    $user = htmlspecialchars($_POST['user']);
    $branch = htmlspecialchars($_POST['branch']);
    $members = htmlspecialchars($_POST['members']);
    $status = htmlspecialchars('draft');
    $total = htmlspecialchars(0);
    $inv = htmlspecialchars(0);

    if ($transaksi->addTransaksi($user, $branch, $members, $inv, $status, $total)) {
        echo "<script>window.location.href='index.php?page=transaksi&msg=tambahSuccess'</script>";
    } else {
        echo "<script>window.location.href='index.php?page=transaksi&msg=tambahError'</script>";
    }
}
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menu Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php
                        if ($currentUser['role'] == 'owner') {
                        } else {
                        ?>
                            <button type="button" data-toggle="modal" data-target="#modal-secondary" class="btn btn-primary">
                                Tambah Transaksi
                            </button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                        }
                        ?>
                        <div class="">
                            <a href="index.php?report=report&act=transaksi&tanggal=<?= @$tanggal ?>">
                                <button class="btn btn-primary btn-action">Cetak</button>
                            </a>
                        </div>
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
                                                <input type='date' class="form-control" name="keyword" autocomplete="off" placeholder="YYYY-MM-DD">
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
                                        <th>Invoice</th>
                                        <th>Store Branch</th>
                                        <th>User</th>
                                        <th>Member</th>
                                        <th>tanggal</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php
                                    foreach ($rows as $row) {
                                        $detail =  $count->countById('transaksi_detail', 'id', 'id_transaksi', $row['id_transaksi']);
                                    ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['inv']) ?></td>
                                            <td><?= htmlspecialchars($row['toko']) ?></td>
                                            <td><?= htmlspecialchars($row['nama_user']) ?></td>
                                            <td><?= htmlspecialchars($row['member']) ?></td>
                                            <td><?= htmlspecialchars($row['tanggal']) ?></td>
                                            <td><?= htmlspecialchars($row['status']) ?></td>
                                            <td><?= htmlspecialchars($detail) ?></td>

                                            <?php
                                            if ($row['status'] == 'draft') {
                                            ?>
                                                <td>
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=transaksi&act=detail&id=<?= $row["id_transaksi"] ?>&branch=<?= $row['branch'] ?>"><i class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-action mr-1 btn-delete" data-id="<?= $row["id_transaksi"] ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            <?php
                                            } elseif ($row['status'] == 'pending') {
                                            ?>
                                                <td>
                                                    <a class="btn btn-primary btn-action mr-1" href="index.php?page=transaksi&act=struk&id=<?= $row["id_transaksi"] ?>"><i class="fas fa-receipt"></i></a>
                                                </td>
                                            <?php
                                            } else {
                                            ?>
                                                <td></td>
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
                                        <th>Invoice</th>
                                        <th>Store Branch</th>
                                        <th>User</th>
                                        <th>Member</th>
                                        <th>tanggal</th>
                                        <th>Status</th>
                                        <th>Total</th>
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
                    <h4 class="modal-title">Tambah Order Detail</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="branch">Store Branch</label>
                                <select class="form-control" name="branch" id="branch">
                                    <?php
                                    foreach ($rowsBranch as $rowBranch) {
                                    ?>
                                        <option value="<?= $rowBranch['id'] ?>"><?= $rowBranch['nama'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">User</label>
                                <input type="text" readonly class="form-control" value="<?= $currentUser['name'] ?>" required placeholder="User">
                                <input type="hidden" name="user" readonly class="form-control" value="<?= $currentUser['id'] ?>" id="user" required placeholder="User">
                            </div>
                            <div class="form-group">
                                <label for="members">Members</label>
                                <select class="form-control" name="members" id="members">
                                    <?php
                                    foreach ($rowsMembers as $rowMembers) {
                                    ?>
                                        <option value="<?= $rowMembers['id'] ?>"><?= $rowMembers['nama'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
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

            const idTransaksi = this.getAttribute('data-id');

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
                    window.location.href = `index.php?page=transaksi&act=delete&id=${idTransaksi}`;
                }
            });
        });
    });
</script>
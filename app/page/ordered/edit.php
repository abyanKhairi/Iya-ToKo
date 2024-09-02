<?php
$pdo = Koneksi::connect();
$order = Ordered::makeObjek($pdo);
$branch = storeBranch::makeObjek($pdo);
$suppliers = Suppliers::makeObjek($pdo);

$id_order = $_GET['id'];

if (isset($_POST['create'])) {
    $noPo = htmlspecialchars($_POST['no_po']);
    $id_branch = htmlspecialchars($_POST['branch']);
    $id_suppliers = htmlspecialchars($_POST['supplier']);

    if ($order->updateOrder($id_branch, $id_suppliers, $noPo)) {
        echo "<script>alert('bisa')</script>";
    } else {
        echo "<script>alert('tidak bisa')</script>";
    }
}


if (isset($id_order)) {
    extract($order->getId($id_order));
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Store Branch</h1>
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
                            <h3 class="card-title">Tambah</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="no_po">Nomor Purchase Order</label>
                                    <input type="number" value="<?= $no_po ?>" name="no_po" class="form-control" id="no_po" required placeholder="Nomor Purchase Order">
                                </div>

                                <div class="input-group mb-3">
                                    <label for="branch">Store Branch Tujuan</label>
                                    <select class="form-control" name="branch" style="width: 100%;" required>
                                        <?php
                                        $rows = $branch->showStoreBranch(@$key);
                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <label for="supplier">Supplier</label>
                                    <select class="form-control" name="supplier" style="width: 100%;" required>
                                        <?php
                                        $rows = $suppliers->showSuppliers(@$key);
                                        foreach ($rows as $row) {
                                        ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="create" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
    </section>
</div>
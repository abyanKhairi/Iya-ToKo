<?php
$pdo = Koneksi::connect();
$auth = Auth::makeObjek($pdo);

if (isset($_POST["toko"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $email = htmlspecialchars($_POST["email"]);
    $noHp = htmlspecialchars($_POST["nomorHp"]);
    $tahun = htmlspecialchars($_POST["tahun"]);

    if ($auth->addStore($nama, $email, $noHp, $tahun)) {
        echo "<script>window.location.href='index.php?auth=login&msg=storeSuccess'</script>";
    } else {
        echo "<script>window.location.href=index.php?auth=storer&msg=storeGagal</script>";
    }
}

$year = date("Y");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iya Toko</title>
    <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition dark-mode register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="index.php" class="h1"><b>Iya</b>TOKO</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new store</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" placeholder="Nama Toko" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-store"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nomorHp" placeholder="Nomor Hp" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="number" min="1900" max="2050" value="<?= $year ?>" class="form-control" name="tahun" placeholder="Tahun Berdiri" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-calendar"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div> -->
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" name="toko" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="text-center mb-3 mt-3">
                    <h6>-- OR --</h6>
                </div>

                <a href="index.php?atuh=login" class="text-center btn btn-info col-12">I already have a store</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>

    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $(".select2").select2();

            //Initialize Select2 Elements
            $(".select2bs4").select2({
                theme: "bootstrap4",
            });
        });

        $(document).ready(function() {
            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'storeGagal') { ?>
                Swal.fire({
                    icon: "error",
                    title: "Store Gagal Ditambahkan",
                    text: "Store Yang Anda Buat Gagal Untuk Ditambahkan",
                });
            <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'storeSuccess') { ?>
                Swal.fire({
                    icon: "success",
                    title: "Store Berhasil Ditambahkan",
                    text: "Store Anda Berhasil Untuk Ditambahkan",
                });
            <?php } ?>
        });
    </script>
</body>

</html>
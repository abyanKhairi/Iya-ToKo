<?php
$pdo = Koneksi::connect();
$auth = Auth::makeObjek($pdo);

if (isset($_POST["logins"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    if ($auth->login($email, $password)) {
        header("Location: ../app/index.php?msg=login");
    } else {
        echo "<script>window.location.href='index.php?msg=gagal'</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Iya Toko</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css" />
    <link rel="stylesheet" href="../assets/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="../assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />
</head>

<body class="hold-transition dark-mode login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="index.php" class="h1"><b>Iya</b>TOKO</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-1">
                        <input type="password" name="password" id="pass" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i id="eye" style="cursor: pointer;" onclick="showHide()" class="fa fa-eye"></i>
                            </div>
                        </div>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <p class="mb-4 text-right">
                        <a href="index.php?auth=forgotPw" class="text-center">Forgot Password</a>
                    </p>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="logins" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="text-center mb-3 mt-3">
                    <h6>-- OR --</h6>
                </div>
                <p class="mb-3">
                    <a href="index.php?auth=register" class="text-center btn btn-info col-12">Register a new User</a>
                </p>
                <p class="mb-0">
                    <a href="index.php?auth=store" class="text-center btn btn-warning col-12">Register a new Store</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->



    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
    <script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../assets/plugins/select2/js/select2.full.min.js"></script>


    <script>
        $(document).ready(function() {
            <?php if (isset($_GET['msg']) && $_GET['msg'] == 'register') { ?>
                Swal.fire({
                    icon: "success",
                    title: "Anda Berhasil Register",
                    text: "Anda berhasil Register Ayo Login",
                });
            <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'gagal') { ?>
                Swal.fire({
                    icon: "error",
                    title: "Anda Gagal Untuk Login",
                    text: "Pastikan Email Dan Password Yang Dimasukkan Sudah Benar",
                });
            <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'logout') { ?>
                Swal.fire({
                    icon: "success",
                    title: "Anda Telah Log Out",
                    text: "Anda Telah Log Out, Login Kembali Untuk Masuk",
                });
            <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'berhasilGanti') { ?>
                Swal.fire({
                    icon: "success",
                    title: "Anda Berhasil Mengubah Password",
                    text: "Silahkan Login Menggunakan Password Yang telah Diganti",
                });
            <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'storeSuccess') { ?>
                Swal.fire({
                    icon: "success",
                    title: "Store Berhasil Ditambahkan",
                    text: "Store Anda Berhasil Untuk Ditambahkan",
                });
            <?php } ?>
        });

        function showHide() {
            var inputan = document.getElementById("pass");
            var eye = document.getElementById("eye");
            if (inputan.type === "password") {
                inputan.type = "text";
                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");
            } else {
                inputan.type = "password";
                eye.classList.remove("fa-eye-slash");
                eye.classList.add("fa-eye");
            }
        }
    </script>
</body>

</html>
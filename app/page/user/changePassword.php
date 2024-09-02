<?php

$id_user = $_GET['id'];
$user = User::makeObjek($pdo);

if (isset($_POST['ganti'])) {
    $oldPass = htmlspecialchars($_POST['oldPass']);
    $newPass = htmlspecialchars($_POST['newPass']);
    $confirm = htmlspecialchars($_POST['confirm']);

    if ($user->confirmPassword($id_user, $oldPass)) {
        if ($newPass === $confirm) {
            $user->resetPassword($id_user, $newPass);
            echo "<script>window.location.href='index.php?page=user&msg=newPassword'</script>";
        } else {
            echo "<script>window.location.href='index.php?page=user&act=new&id=$id_user&msg=ErrorPassword'</script>";
        }
    } else {
        echo "<script>window.location.href='index.php?page=user&act=new&id=$id_user&msg=oldPassword'</script>";
    }
}

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ganti Password</h1>
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
                            <h3 class="card-title">Ganti Password</h3>
                        </div>

                        <form method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="oldPass">Password Lama &nbsp;&nbsp; <i id="eye" style="cursor: pointer;" onclick="showHide()" class="fa fa-eye"></i>
                                    </label>
                                    <input type="password" name="oldPass" class="form-control" id="oldPass" placeholder="password lama">

                                </div>
                                <div class="form-group">
                                    <label for="newPass">Passwor Baru &nbsp;&nbsp; <i id="eye2" style="cursor: pointer;" onclick="showHide2()" class="fa fa-eye"></i></label>
                                    <input type="password" name="newPass" class="form-control" id="newPass" placeholder="password baru">
                                </div>
                                <div class="form-group">
                                    <label for="confirm">Confirm Password &nbsp;&nbsp; <i id="eye3" style="cursor: pointer;" onclick="showHide3()" class="fa fa-eye"></i></label>
                                    <input type="password" name="confirm" class="form-control" id="confirm" placeholder="confirm password">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="ganti" class="btn btn-primary">Change</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    function showHide() {
        var inputan = document.getElementById("oldPass");
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

    function showHide2() {
        var inputan = document.getElementById("newPass");
        var eye = document.getElementById("eye2");
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

    function showHide3() {
        var inputan = document.getElementById("confirm");
        var eye = document.getElementById("eye3");
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
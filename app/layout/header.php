        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="../assets/dist/img/logo.png" alt="AdminLTELogo" height="100" width="100">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <button class="dropdown-item btn btn-warning btn-action mr-1 btn-logout text-center">

                            <i class="far fa-hand-point-right"></i>
                            <i class="far fa-kiss-wink-heart"></i>
                            <i class="far fa-hand-point-left"></i>
                            &nbsp;

                            &nbsp; &nbsp;
                            Log Out
                            &nbsp; &nbsp;

                            <i class="far fa-hand-point-right"></i>
                            <i class="far fa-kiss-wink-heart"></i>
                            <i class="far fa-hand-point-left"></i>
                            &nbsp;

                        </button>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->


        <script>
            document.querySelectorAll('.btn-logout').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda Yakin Ingin Log Out',
                        text: "Jika Anda Log Out Anda Akan Kembali Kehalaman Login Dan Harus login Kembali",
                        textColor: 'white',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya , Log Out',
                        cancelButtonText: 'Tidak, Tidak Jadi',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = `index.php?page=user&act=logout`;
                        }
                    });
                });
            });
        </script>
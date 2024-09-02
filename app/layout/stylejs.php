<!-- jQuery -->
<script src="../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/dist/js/adminlte.js"></script>

<!-- PAGE ../assets/PLUGINS -->
<!-- jQuery Mapael -->
<script src="../assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../assets/plugins/raphael/raphael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../assets/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../assets/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../assets/dist/js/pages/dashboard2.js"></script>

<!-- DataTables  & Plugins -->
<script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../assets/plugins/jszip/jszip.min.js"></script>
<script src="../assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="../assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../assets/plugins/select2/js/select2.full.min.js"></script>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    $(function() {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Initialize Select2 Elements
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });
    });

    $(document).ready(function() {
        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'error') { ?>
            Swal.fire({
                icon: "error",
                title: "Data Gagal Dihapus",
                text: "Data Gagal Utnuk dihapus Karena Masih Terikat dengan data lain",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
            Swal.fire({
                icon: "success",
                title: "Data Dihapus",
                text: "Data Berhasil Untuk Dihapus",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'akses') { ?>
            Swal.fire({
                icon: "error",
                title: "Tidak Memiliki Akses",
                text: "Anda Tidak Dapat Mengakses Halaman Ini",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'editSuccess') { ?>
            Swal.fire({
                icon: "success",
                title: "Data Berhasil Di Edit",
                text: "Data Berhasil Untuk Di Ubah",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'editError') { ?>
            Swal.fire({
                icon: "error",
                title: "Data Gagal Di Edit",
                text: "Data Gagal untuk di Ubah",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'tambahSuccess') { ?>
            Swal.fire({
                icon: "success",
                title: "Data Berhasil Di Tambah",
                text: "Data Berhasil untuk Ditambahkan",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'tambahError') { ?>
            Swal.fire({
                icon: "error",
                title: "Data Gagal Di Tambah",
                text: "Data Gagal untuk Ditambahkan",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'Diterima') { ?>
            Swal.fire({
                icon: "success",
                title: "Barang Telah Diterima",
                text: "Barang telah Diterima Dan Diperiksa",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'login') { ?>
            Swal.fire({
                icon: "success",
                title: "Berhasil Login",
                text: "Selamat Anda Berhasil Login",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'gagalLogout') { ?>
            Swal.fire({
                icon: "error",
                title: "Gagal Logout",
                text: "Sepertinya Ada Masalah Ketikan Anda Ingin Log Out",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'bayarSuccess') { ?>
            Swal.fire({
                icon: "success",
                title: "Pembayaran Berhasil",
                text: "Cetak Struk Untuk Melanjutakan Transaksi",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'bayarGagal') { ?>
            Swal.fire({
                icon: "error",
                title: "Pembayaran Gagal",
                text: "Pembayaran Gagal Cek Kembali Pembayaran Yang Dilakukan",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'uangKurang') { ?>
            Swal.fire({
                icon: "error",
                title: "Uang Yang Anda Masukkan Kurang",
                text: "Pastikan Anda Memiliki Cukup Uang Untuk Membayar Transaksi Ini",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'newPassword') { ?>
            Swal.fire({
                icon: "success",
                title: "Password Diganti",
                text: "Password Berhasil Diganti",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'oldPassword') { ?>
            Swal.fire({
                icon: "error",
                title: "Password Salah",
                text: "Password Yang Anda Masukkan Salah Periksa Kembali Password Anda",
            });
        <?php } elseif (isset($_GET['msg']) && $_GET['msg'] == 'ErrorPassword') { ?>
            Swal.fire({
                icon: "error",
                title: "Password Tidak Sesuai",
                text: "Pastikan Password Yang Anda Masukkan Sama Dengan Password Baru Anda",
            });
        <?php } ?>
    });
</script>
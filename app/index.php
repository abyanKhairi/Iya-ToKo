<?php
include "../database/koneksi.php";
include "../database/class/Auth.php";

$pdo = Koneksi::connect();
$auth = Auth::makeObjek($pdo);
$currentUser = $auth->getUser();

if (!$auth->isLoggedIn() && $auth->isLoggedIn() == false) {
    $login = isset($_GET['auth']) ? $_GET['auth'] : 'auth';
    switch ($login) {
        case 'login':
            include 'auth/login.php';
            break;
        case 'register':
            include 'auth/register.php';
            break;
        case 'store':
            include 'auth/store.php';
            break;
        case 'forgotPw':
            include 'auth/forgotPassword.php';
            break;
        default:
            include 'auth/login.php';
            break;
    }
} else {

    $report = isset($_GET["report"]) ? $_GET["report"] : '';
    switch ($report) {
        case 'report':
            include 'page/report/default.php';
            break;
        default:
            include 'page/report/default.php';
            break;
    }


?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Iya Barang </title>
        <?php
        include "layout/stylecss.php";
        ?>
    </head>

    <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            <?php
            include "layout/header.php";
            include "layout/sidebar.php";
            ?>
            <!-- Content Wrapper. Contains page content -->
            <?php
            $page = isset($_GET["page"]) ? $_GET["page"] : '';
            switch ($page) {
                case 'user':
                    include('page/user/default.php');
                    break;
                case 'members':
                    include('page/members/default.php');
                    break;
                case 'store':
                    include('page/store/default.php');
                    break;
                case 'storeBranch':
                    include('page/storeBranch/default.php');
                    break;
                case 'suppliers':
                    include('page/suppliers/default.php');
                    break;
                case 'kategoris':
                    include('page/kategoris/default.php');
                    break;
                case 'produks':
                    include('page/produks/default.php');
                    break;
                case 'produkBranch':
                    include('page/produkBranch/default.php');
                    break;
                case 'ordered':
                    include('page/ordered/default.php');
                    break;
                case 'penerimaan':
                    include('page/penerimaan/default.php');
                    break;
                case 'waste':
                    include('page/waste/default.php');
                    break;
                case 'retur':
                    include('page/retur/default.php');
                    break;
                case 'transaksi':
                    include('page/transaksi/default.php');
                    break;
                default:
                    include('page/dashboard/index.php');
            }
            ?>
            <!-- /.content-wrapper -->
        </div>

        <?php
        include "layout/footer.php";
        include "layout/stylejs.php";
        ?>
    </body>

    </html>

<?php
}
?>
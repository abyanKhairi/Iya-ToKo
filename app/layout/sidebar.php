        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="../assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Iya Barang</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $currentUser['name'] ?></a>
                    </div>
                </div>


                <?php
                @$nav = isset($_GET['page']) ? $_GET["page"] : '';
                ?>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <?php
                            if ($nav == 'dashboard' || $nav == '') {
                            ?>
                                <a href="index.php" class="nav-link active">
                                <?php
                            } else {
                                ?>
                                    <a href="index.php" class="nav-link">
                                    <?php } ?>
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                    </a>
                        </li>

                        <?php
                        if ($currentUser['role'] == 'adminGudang' || $currentUser['role'] == 'adminKasir') {
                        } else {
                        ?>
                            <li class="nav-item">
                                <?php
                                if ($nav == 'store' || $nav == 'storeBranch') {
                                ?>
                                    <a href="#" class="nav-link active">
                                    <?php
                                } else {
                                    ?>
                                        <a href="#" class="nav-link">
                                        <?php } ?>
                                        <i class="nav-icon fas fa-store"></i>
                                        <p>
                                            Store Management
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="index.php?page=store" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Store</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="index.php?page=storeBranch" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Store Branch</p>
                                                </a>
                                            </li>
                                        </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <li class="nav-item">
                            <?php
                            if ($nav == 'user') {
                            ?>
                                <a href="#" class="nav-link active">
                                <?php
                            } else {
                                ?>
                                    <a href="#" class="nav-link">
                                    <?php } ?>
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>
                                        Users Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="index.php?page=user" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Users</p>
                                            </a>
                                        </li>
                                    </ul>
                        </li>


                        <li class="nav-item">
                            <?php
                            if ($nav == 'produks' || $nav == 'kategoris' || $nav == 'produkBranch' || $nav == 'waste') {
                            ?>
                                <a href="#" class="nav-link active">
                                <?php
                            } else {
                                ?>
                                    <a href="#" class="nav-link">
                                    <?php } ?>
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Produks Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <?php
                                        if ($currentUser['role'] == 'adminKasir') {
                                        } else {
                                        ?>
                                            <li class="nav-item">
                                                <a href="index.php?page=produks" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Produk</p>
                                                </a>
                                            </li>
                                        <?php } ?>

                                        <li class="nav-item">
                                            <a href="index.php?page=produkBranch" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Produks Branch</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="index.php?page=kategoris" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Category</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="index.php?page=waste" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Waste</p>
                                            </a>
                                        </li>
                                    </ul>
                        </li>



                        <?php
                        if ($currentUser['role'] == 'adminGudang') {
                        } else {
                        ?>
                            <li class="nav-item">
                                <?php
                                if ($nav == 'members') {
                                ?>
                                    <a href="#" class="nav-link active">
                                    <?php
                                } else {
                                    ?>
                                        <a href="#" class="nav-link">
                                        <?php } ?>
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                            Members Management
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="index.php?page=members" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Members</p>
                                                </a>
                                            </li>
                                        </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($currentUser['role'] == 'adminKasir') {
                        } else {
                        ?>
                            <li class="nav-item">
                                <?php
                                if ($nav == 'suppliers') {
                                ?>
                                    <a href="#" class="nav-link active">
                                    <?php
                                } else {
                                    ?>
                                        <a href="#" class="nav-link">
                                        <?php } ?>
                                        <i class="nav-icon fas fa-truck"></i>
                                        <p>
                                            Suplier Management
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="index.php?page=suppliers" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Suppliers</p>
                                                </a>
                                            </li>
                                        </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($currentUser['role'] == 'adminKasir') {
                        } else {
                        ?>
                            <li class="nav-item">
                                <?php
                                if ($nav == 'ordered' || $nav == 'penerimaan' || $nav == 'retur') {
                                ?>
                                    <a href="#" class="nav-link active">
                                    <?php
                                } else {
                                    ?>
                                        <a href="#" class="nav-link">
                                        <?php } ?>
                                        <i class="nav-icon fa fa-shopping-cart"></i>
                                        <p>
                                            Ordered Management
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="index.php?page=ordered" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Products Ordered</p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="index.php?page=penerimaan" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Penerimaan </p>
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a href="index.php?page=retur" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Returned Products </p>
                                                </a>
                                            </li>
                                        </ul>
                            </li>
                        <?php
                        }
                        ?>

                        <?php
                        if ($currentUser['role'] == 'adminGudang') {
                        } else {
                        ?>
                            <li class="nav-item">
                                <?php
                                if ($nav == 'transaksi') {
                                ?>
                                    <a href="#" class="nav-link active">
                                    <?php
                                } else {
                                    ?>
                                        <a href="#" class="nav-link">
                                        <?php } ?>
                                        <i class="nav-icon fas fa-receipt"></i>
                                        <p>
                                            Transaksi Management
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <a href="index.php?page=transaksi" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>Transaksi</p>
                                                </a>
                                            </li>
                                        </ul>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
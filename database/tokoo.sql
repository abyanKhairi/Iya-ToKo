-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 04:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokoo`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` int(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(20) NOT NULL,
  `id_store` int(20) NOT NULL,
  `kode` char(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nomor_hp` char(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `order_bayar`
--

CREATE TABLE `order_bayar` (
  `id` int(20) NOT NULL,
  `id_po` int(20) NOT NULL,
  `harga` int(255) NOT NULL,
  `dibayar` int(255) NOT NULL,
  `kembali` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `penerimaan`
--

CREATE TABLE `penerimaan` (
  `id` int(20) NOT NULL,
  `id_po` int(20) NOT NULL,
  `tanggal_terima` date NOT NULL,
  `diterima_oleh` varchar(100) NOT NULL,
  `diperiksa_oleh` varchar(100) NOT NULL,
  `status` enum('diterima','belum') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_detail`
--

CREATE TABLE `penerimaan_detail` (
  `id` int(20) NOT NULL,
  `id_penerimaan` int(20) NOT NULL,
  `id_po_detail` int(20) NOT NULL,
  `id_produk` int(20) NOT NULL,
  `tanggal_exp` date NOT NULL,
  `qty` int(200) NOT NULL,
  `kode_batch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produkbranchhistory`
--

CREATE TABLE `produkbranchhistory` (
  `id` int(20) NOT NULL,
  `id_store_branch` int(20) NOT NULL,
  `id_produk_branch` int(20) NOT NULL,
  `qty` int(200) NOT NULL,
  `jenis` enum('stock_in','stock_out') NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `produks`
--

CREATE TABLE `produks` (
  `id` int(20) NOT NULL,
  `id_kategoris` int(20) NOT NULL,
  `id_store` int(20) NOT NULL,
  `sn` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga_set` int(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produksbranch`
--

CREATE TABLE `produksbranch` (
  `id` int(20) NOT NULL,
  `id_produk` int(20) NOT NULL,
  `id_branch` int(20) NOT NULL,
  `stok` int(200) NOT NULL,
  `min_stok` int(200) NOT NULL,
  `harga` int(200) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(20) NOT NULL,
  `id_store_branch` int(20) NOT NULL,
  `id_supplier` int(20) NOT NULL,
  `no_po` int(100) NOT NULL,
  `tanggal_po` date NOT NULL,
  `tanggal_pengiriman` date NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  `status` enum('pending','dikirim','sampai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_detail`
--

CREATE TABLE `purchase_order_detail` (
  `id` int(20) NOT NULL,
  `id_po` int(20) NOT NULL,
  `id_produk` int(20) NOT NULL,
  `qty` int(200) NOT NULL,
  `harga_beli` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_retur`
--

CREATE TABLE `purchase_order_retur` (
  `id` int(20) NOT NULL,
  `id_po` int(20) NOT NULL,
  `no_retur` int(100) NOT NULL,
  `tanggal_retur` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_retur_detail`
--

CREATE TABLE `purchase_order_retur_detail` (
  `id` int(20) NOT NULL,
  `id_po_retur` int(20) NOT NULL,
  `id_po_detail` int(20) NOT NULL,
  `qty` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nomor_hp` char(14) NOT NULL,
  `tahun_berdiri` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `storebranch`
--

CREATE TABLE `storebranch` (
  `id` int(20) NOT NULL,
  `id_toko` int(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nomor_hp` char(14) NOT NULL,
  `status` enum('utama','cabang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(20) NOT NULL,
  `id_store` int(20) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `nomor_hp` char(14) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(20) NOT NULL,
  `id_users` int(20) NOT NULL,
  `id_store_branch` int(20) NOT NULL,
  `id_member` int(20) NOT NULL,
  `inv` int(100) NOT NULL,
  `status` enum('draft','pending','selesai') NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_bayar`
--

CREATE TABLE `transaksi_bayar` (
  `id` int(20) NOT NULL,
  `id_transaksi` int(20) NOT NULL,
  `total` int(255) NOT NULL,
  `dibayar` int(255) NOT NULL,
  `kembali` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(20) NOT NULL,
  `id_transaksi` int(20) NOT NULL,
  `id_produk_branch` int(20) NOT NULL,
  `harga` int(200) NOT NULL,
  `qty` int(100) NOT NULL,
  `total` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(20) NOT NULL,
  `id_store` int(20) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('owner','superAdmin','adminGudang','adminKasir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `waste`
--

CREATE TABLE `waste` (
  `id` int(20) NOT NULL,
  `id_produk_branch` int(20) NOT NULL,
  `id_penerimaan` int(20) NOT NULL,
  `kategori` enum('Expired','Rusak','Hilang') NOT NULL,
  `jumlah` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `members_fk1` (`id_store`);

--
-- Indexes for table `order_bayar`
--
ALTER TABLE `order_bayar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bayarOrder_fk` (`id_po`);

--
-- Indexes for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penerimaan_FK1` (`id_po`);

--
-- Indexes for table `penerimaan_detail`
--
ALTER TABLE `penerimaan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penerimaanDetail_fk1` (`id_penerimaan`),
  ADD KEY `penerimaanDetail_fk2` (`id_po_detail`),
  ADD KEY `penerimaanDetail_fk3` (`id_produk`);

--
-- Indexes for table `produkbranchhistory`
--
ALTER TABLE `produkbranchhistory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `History_Fk1` (`id_produk_branch`),
  ADD KEY `History_Fk2` (`id_store_branch`);

--
-- Indexes for table `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_fk1` (`id_kategoris`),
  ADD KEY `produk_fk2` (`id_store`);

--
-- Indexes for table `produksbranch`
--
ALTER TABLE `produksbranch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produkBranch_fk` (`id_branch`),
  ADD KEY `produkBranch_fk2` (`id_produk`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordered_fk1` (`id_store_branch`),
  ADD KEY `ordered_fk2` (`id_supplier`);

--
-- Indexes for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poDetail_fk1` (`id_po`),
  ADD KEY `poDetail_fk2` (`id_produk`);

--
-- Indexes for table `purchase_order_retur`
--
ALTER TABLE `purchase_order_retur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retur_Fk1` (`id_po`);

--
-- Indexes for table `purchase_order_retur_detail`
--
ALTER TABLE `purchase_order_retur_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returDetail_Fk1` (`id_po_detail`),
  ADD KEY `returDetail_Fk2` (`id_po_retur`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `storebranch`
--
ALTER TABLE `storebranch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `storeBranch_fk` (`id_toko`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `suppliers_fk` (`id_store`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_Fk1` (`id_member`),
  ADD KEY `transaksi_Fk2` (`id_store_branch`),
  ADD KEY `transaksi_Fk3` (`id_users`);

--
-- Indexes for table `transaksi_bayar`
--
ALTER TABLE `transaksi_bayar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bayarTransaksi_Fk1` (`id_transaksi`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksiDetail_Fk1` (`id_produk_branch`),
  ADD KEY `transaksiDetail_Fk2` (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_fk` (`id_store`);

--
-- Indexes for table `waste`
--
ALTER TABLE `waste`
  ADD PRIMARY KEY (`id`),
  ADD KEY `waste_Fk1` (`id_penerimaan`),
  ADD KEY `waste_Fk2` (`id_produk_branch`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_bayar`
--
ALTER TABLE `order_bayar`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `penerimaan`
--
ALTER TABLE `penerimaan`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `penerimaan_detail`
--
ALTER TABLE `penerimaan_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `produkbranchhistory`
--
ALTER TABLE `produkbranchhistory`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `produks`
--
ALTER TABLE `produks`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `produksbranch`
--
ALTER TABLE `produksbranch`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `purchase_order_retur`
--
ALTER TABLE `purchase_order_retur`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `purchase_order_retur_detail`
--
ALTER TABLE `purchase_order_retur_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `storebranch`
--
ALTER TABLE `storebranch`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `transaksi_bayar`
--
ALTER TABLE `transaksi_bayar`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `waste`
--
ALTER TABLE `waste`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_fk1` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`);

--
-- Constraints for table `order_bayar`
--
ALTER TABLE `order_bayar`
  ADD CONSTRAINT `bayarOrder_fk` FOREIGN KEY (`id_po`) REFERENCES `purchase_order` (`id`);

--
-- Constraints for table `penerimaan`
--
ALTER TABLE `penerimaan`
  ADD CONSTRAINT `penerimaan_FK1` FOREIGN KEY (`id_po`) REFERENCES `purchase_order` (`id`);

--
-- Constraints for table `penerimaan_detail`
--
ALTER TABLE `penerimaan_detail`
  ADD CONSTRAINT `penerimaanDetail_fk1` FOREIGN KEY (`id_penerimaan`) REFERENCES `penerimaan` (`id`),
  ADD CONSTRAINT `penerimaanDetail_fk2` FOREIGN KEY (`id_po_detail`) REFERENCES `purchase_order_detail` (`id`),
  ADD CONSTRAINT `penerimaanDetail_fk3` FOREIGN KEY (`id_produk`) REFERENCES `produks` (`id`);

--
-- Constraints for table `produkbranchhistory`
--
ALTER TABLE `produkbranchhistory`
  ADD CONSTRAINT `History_Fk1` FOREIGN KEY (`id_produk_branch`) REFERENCES `produksbranch` (`id`),
  ADD CONSTRAINT `History_Fk2` FOREIGN KEY (`id_store_branch`) REFERENCES `storebranch` (`id`);

--
-- Constraints for table `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produk_fk1` FOREIGN KEY (`id_kategoris`) REFERENCES `kategoris` (`id`),
  ADD CONSTRAINT `produk_fk2` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`);

--
-- Constraints for table `produksbranch`
--
ALTER TABLE `produksbranch`
  ADD CONSTRAINT `produkBranch_fk` FOREIGN KEY (`id_branch`) REFERENCES `storebranch` (`id`),
  ADD CONSTRAINT `produkBranch_fk2` FOREIGN KEY (`id_produk`) REFERENCES `produks` (`id`);

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `ordered_fk1` FOREIGN KEY (`id_store_branch`) REFERENCES `storebranch` (`id`),
  ADD CONSTRAINT `ordered_fk2` FOREIGN KEY (`id_supplier`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `purchase_order_detail`
--
ALTER TABLE `purchase_order_detail`
  ADD CONSTRAINT `poDetail_fk1` FOREIGN KEY (`id_po`) REFERENCES `purchase_order` (`id`),
  ADD CONSTRAINT `poDetail_fk2` FOREIGN KEY (`id_produk`) REFERENCES `produks` (`id`);

--
-- Constraints for table `purchase_order_retur`
--
ALTER TABLE `purchase_order_retur`
  ADD CONSTRAINT `retur_Fk1` FOREIGN KEY (`id_po`) REFERENCES `purchase_order` (`id`);

--
-- Constraints for table `purchase_order_retur_detail`
--
ALTER TABLE `purchase_order_retur_detail`
  ADD CONSTRAINT `returDetail_Fk1` FOREIGN KEY (`id_po_detail`) REFERENCES `purchase_order_detail` (`id`),
  ADD CONSTRAINT `returDetail_Fk2` FOREIGN KEY (`id_po_retur`) REFERENCES `purchase_order_retur` (`id`);

--
-- Constraints for table `storebranch`
--
ALTER TABLE `storebranch`
  ADD CONSTRAINT `storeBranch_fk` FOREIGN KEY (`id_toko`) REFERENCES `store` (`id`);

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_fk` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_Fk1` FOREIGN KEY (`id_member`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `transaksi_Fk2` FOREIGN KEY (`id_store_branch`) REFERENCES `storebranch` (`id`),
  ADD CONSTRAINT `transaksi_Fk3` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaksi_bayar`
--
ALTER TABLE `transaksi_bayar`
  ADD CONSTRAINT `bayarTransaksi_Fk1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksiDetail_Fk1` FOREIGN KEY (`id_produk_branch`) REFERENCES `produksbranch` (`id`),
  ADD CONSTRAINT `transaksiDetail_Fk2` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk` FOREIGN KEY (`id_store`) REFERENCES `store` (`id`);

--
-- Constraints for table `waste`
--
ALTER TABLE `waste`
  ADD CONSTRAINT `waste_Fk1` FOREIGN KEY (`id_penerimaan`) REFERENCES `penerimaan` (`id`),
  ADD CONSTRAINT `waste_Fk2` FOREIGN KEY (`id_produk_branch`) REFERENCES `produksbranch` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

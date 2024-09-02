<?php
class Transaksi
{
    private $db;

    private static $newObjek = NULL;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function makeObjek($pdo)
    {
        if (self::$newObjek == NULL) {
            self::$newObjek = new Transaksi($pdo);
        }
        return self::$newObjek;
    }

    public function getTransaksi($tanggal = null)
    {
        try {
            if ($tanggal) {
                $stmt = $this->db->prepare("SELECT transaksi.id_store_branch as branch, transaksi.id as id_transaksi, transaksi.tanggal, transaksi.status, transaksi.inv, transaksi.total, users.name as nama_user, storebranch.nama as toko, members.nama as member FROM transaksi JOIN users ON transaksi.id_users = users.id JOIN storebranch on transaksi.id_store_branch = storebranch.id JOIN members ON transaksi.id_member = members.id WHERE tanggal LIKE :tanggal");
                $stmt->bindValue(":tanggal", "%$tanggal%");
            } else {
                $stmt = $this->db->prepare("SELECT transaksi.id_store_branch as branch ,transaksi.id as id_transaksi, transaksi.tanggal, transaksi.status, transaksi.inv, transaksi.total, users.name as nama_user, storebranch.nama as toko, members.nama as member FROM transaksi JOIN users ON transaksi.id_users = users.id JOIN storebranch on transaksi.id_store_branch = storebranch.id JOIN members ON transaksi.id_member = members.id");
            }
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function addTransaksi($id_user, $id_branch, $id_member, $inv, $status, $total)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO transaksi(id, id_users, id_store_branch, id_member, inv, status, total) VALUES(NULL,:id_user,:id_branch,:id_member,:inv,:status,:total)");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":id_branch", $id_branch);
            $stmt->bindParam(":id_member", $id_member);
            $stmt->bindParam(":inv", $inv);
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":total", $total);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteTransaksi($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM transaksi WHERE id = :id");
            $stmt->bindParam(":id", $id_transaksi);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    // Detail Transaksi 

    public function getDetailTransaksi($id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("SELECT produks.nama, produks.gambar,produksbranch.id as id_produk_branch ,transaksi_detail.* FROM transaksi_detail JOIN produksbranch ON produksbranch.id = transaksi_detail.id_produk_branch JOIN produks ON produksbranch.id_produk = produks.id WHERE transaksi_detail.id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo  $e->getMessage();
            return false;
        }
    }


    public function getForStruk($transaksi)
    {
        try {
            $stmt = $this->db->prepare("SELECT transaksi.tanggal, transaksi.inv, transaksi_bayar.id as id_bayar,transaksi_bayar.dibayar, transaksi_bayar.kembali,transaksi_bayar.total  FROM `transaksi` JOIN transaksi_bayar ON transaksi.id = transaksi_bayar.id_transaksi WHERE transaksi.id = :id");
            $stmt->bindParam(":id", $transaksi);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProdukBranch($id_branch)
    {
        try {
            $stmt = $this->db->prepare("SELECT produks.nama,produksbranch.id ,produksbranch.harga , produksbranch.satuan, produksbranch.stok FROM produksbranch JOIN produks ON produks.id = produksbranch.id_produk WHERE produksbranch.id_branch = :branch");
            $stmt->bindParam(":branch", $id_branch);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getHarga($id_branch, $id)
    {
        try {
            $stmt = $this->db->prepare("SELECT harga FROM produksbranch WHERE id = :id_produk AND id_branch = :branch");
            $stmt->bindParam(":branch", $id_branch);
            $stmt->bindParam(":id_produk", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['harga'];
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    public function addDetail($id_transaksi, $id_produk_branch, $harga, $qty, $total, $branch, $jenis, $keterangan)
    {
        try {

            if (!$this->cekJumlahProduk($id_produk_branch, $qty)) {
                echo 'Stok Tidak Cukup';
                return false;
            }

            $stmt = $this->db->prepare("INSERT INTO transaksi_detail (id_transaksi, id_produk_branch, harga, qty, total) VALUES (:id_transaksi, :id_produk_branch, :harga, :qty, :total)");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->bindParam(":id_produk_branch", $id_produk_branch);
            $stmt->bindParam(":harga", $harga);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":total", $total);
            $stmt->execute();

            $this->KurangiStok($id_produk_branch, $qty);
            $this->addHistory($branch, $id_produk_branch, $qty, $jenis, $keterangan);
            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return false;
        }
    }



    public function KurangiStok($id, $qty)
    {
        try {
            $stmt = $this->db->prepare("UPDATE produksbranch SET stok = stok - :qty WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":qty", $qty);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function cekJumlahProduk($id, $qty)
    {
        try {
            $stmt = $this->db->prepare("SELECT stok FROM produksbranch WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $stok = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($stok && $stok['stok'] >= $qty) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function deleteDetailTransaksi($id_detail, $id_transaksi, $id_produk)
    {
        try {
            $cek = $this->cekQtyInput($id_transaksi, $id_detail);
            if ($cek === false) {
                echo "Data yang ingin dihapus tidak ada.";
                return false;
            }
            $qty = $cek['qty'];

            if (!$this->deleteHistori($id_detail, $id_transaksi)) {
                return false;
            }

            if (!$this->deleteTransaksiDetail($id_detail, $id_transaksi)) {
                return false;
            }

            $this->kembalikanStok($id_produk, $qty);

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function deleteTransaksiDetail($id_detail, $id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM transaksi_detail WHERE id = :id AND id_transaksi = :id_transaksi");
            $stmt->bindParam(":id", $id_detail);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    private function deleteHistori($id_detail, $id_transaksi)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM produkbranchhistoryWHERE id_produk_branch = (SELECT id_produk_branch FROM transaksi_detail WHERE id = :id_detail AND id_transaksi = :id_transaksi)AND id_store_branch = ( SELECT id_store_branch FROM transaksi WHERE id = :id_transaksi)");
            $stmt->bindParam(":id_detail", $id_detail);
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }





    public function cekQtyInput($id_transaksi, $id_detail)
    {
        //cek jumlah qty 
        $stmt = $this->db->prepare("SELECT qty FROM transaksi_detail WHERE id = :id_detail AND id_transaksi = :id_transaksi");
        $stmt->bindParam(':id_transaksi', $id_transaksi);
        $stmt->bindParam(':id_detail', $id_detail);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function kembalikanStok($id_produk, $qty)
    {
        try {
            //kembalikan stok seperti semula
            $stmt = $this->db->prepare("UPDATE produksbranch SET stok = stok + :jumlah WHERE id = :id");
            $stmt->bindParam(':jumlah', $qty);
            $stmt->bindParam(':id', $id_produk);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function bayarTransaksi($id_transaksi, $total, $dibayar, $kembali, $tanggal, $inv)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO transaksi_bayar VALUES(NULL,:id_transaksi,:total,:dibayar,:kembali)");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->bindParam(":total", $total);
            $stmt->bindParam(":dibayar", $dibayar);
            $stmt->bindParam(":kembali", $kembali);
            $stmt->execute();
            $this->updateTransaksi($id_transaksi, $tanggal, $inv);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateTransaksi($id, $tanggal, $inv)
    {
        try {
            $stmt = $this->db->prepare("UPDATE transaksi SET status = 'pending', tanggal = :tanggal, inv = :inv WHERE id = :id ");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':inv', $inv);
            $stmt->bindParam(':tanggal', $tanggal);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateSelesai($id)
    {
        try {
            $stmt = $this->db->prepare("UPDATE transaksi SET status = 'selesai' WHERE id = :id ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function addHistory($store_branch, $produkBranch, $qty, $jenis, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO produkbranchhistory VALUES(NULL,:store_branch,:id_produk_branch,:qty,:jenis,:keterangan) ");
            $stmt->bindParam(":store_branch", $store_branch);
            $stmt->bindParam(":id_produk_branch", $produkBranch);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":jenis", $jenis);
            $stmt->bindParam(":keterangan", $keterangan);
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return false;
        }
    }

    //Menghitung Pendapatan berdasarkan tanggal
    public function countPendapatan($tanggal)
    {
        try {
            if ($tanggal) {
                $stmt = $this->db->prepare("SELECT SUM(transaksi_bayar.total) FROM transaksi JOIN transaksi_bayar ON transaksi_bayar.id_transaksi = transaksi.id WHERE tanggal LIKE :tanggal");
            } else {
                $stmt = $this->db->prepare("SELECT SUM(transaksi_bayar.total) FROM transaksi JOIN transaksi_bayar ON transaksi_bayar.id_transaksi = transaksi.id WHERE tanggal NOT LIKE :tanggal");
            }

            $stmt->bindParam(":tanggal", $tanggal);
            $stmt->execute();
            return  $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

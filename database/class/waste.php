<?php
class Waste
{
    private $db;

    private static $newObjek;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function makeObjek($pdo)
    {
        if (self::$newObjek == NULL) {
            self::$newObjek = new Waste($pdo);
        }
        return self::$newObjek;
    }

    public function getPenerimaanData($id_branch)
    {
        try {
            $stmt = $this->db->prepare("SELECT penerimaan.id, penerimaan.diterima_oleh ,penerimaan.diperiksa_oleh FROM penerimaan JOIN purchase_order ON penerimaan.id_po = purchase_order.id WHERE purchase_order.id_store_branch = :id_branch");
            $stmt->bindParam(":id_branch", $id_branch);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function getProdukBranch($id_produk)
    {
        try {
            $stmt = $this->db->prepare("SELECT produks.*, produksbranch.id as id_produk_branch FROM produksbranch JOIN produks ON produksbranch.id_produk = produks.id WHERE produksbranch.id= :id");
            $stmt->bindParam(":id", $id_produk);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function addWaste($produkBranch, $penrima, $kategori, $qty, $id_branch, $jenis, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO waste VALUES(NULL,:id_produkBranch, :id_penerima, :kategori, :jumlah)");
            $stmt->bindParam(":id_produkBranch", $produkBranch);
            $stmt->bindParam(":id_penerima", $penrima);
            $stmt->bindParam(":kategori", $kategori);
            $stmt->bindParam(":jumlah", $qty);
            $stmt->execute();
            $this->kurangiProdukBranch($qty, $produkBranch, $id_branch);
            $this->addHistory($id_branch, $produkBranch, $qty, $jenis, $keterangan);
            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function kurangiProdukBranch($qty, $produkBranch, $id_branch)
    {
        try {
            $stmt = $this->db->prepare("UPDATE produksbranch SET stok = stok - :jumlah WHERE id = :id AND id_branch = :id_branch");
            $stmt->bindParam(":jumlah", $qty);
            $stmt->bindParam(":id", $produkBranch);
            $stmt->bindParam(":id_branch", $id_branch);
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function getWaste()
    {
        try {
            $stmt = $this->db->prepare("SELECT waste.id, produks.gambar, produks.nama AS nama_produk, storebranch.nama AS nama_toko, waste.jumlah, waste.kategori FROM waste
                    JOIN produksbranch ON waste.id_produk_branch = produksbranch.id 
                    JOIN produks ON produksbranch.id_produk = produks.id
                    JOIN storebranch ON produksbranch.id_branch = storebranch.id");
            $stmt->execute();
            return  $stmt->fetchAll();
        } catch (PDOException $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function addHistory($id_store_branch, $produkBranch, $qty, $jenis, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO produkbranchhistory VALUES(NULL,:id_store_branch,:id_produk_branch,:qty,:jenis,:keterangan) ");
            $stmt->bindParam(":id_store_branch", $id_store_branch);
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

    public function hapusUser($id_waste)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM waste WHERE id = :id");
            $stmt->bindParam(":id", $id_waste);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

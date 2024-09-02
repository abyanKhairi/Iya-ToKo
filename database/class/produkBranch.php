<?php
class ProdukBranch
{
    private $db;

    private static $newObjek = NULL;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function makeObjek($pdo)
    {
        if (self::$newObjek == null) {
            self::$newObjek = new ProdukBranch($pdo);
        }
        return self::$newObjek;
    }

    public function addProdukBranch($id_produks, $id_branch, $stock, $minStok, $harga, $satuan)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO produksbranch(`id`, `id_produk`, `id_branch`, `stok`, `min_stok`, `harga`, `satuan`) VALUES(NULL, :id_produks, :id_branch, :stok, :min_stok, :harga, :satuan)");
            $stmt->bindParam(":id_produks", $id_produks);
            $stmt->bindParam(":id_branch", $id_branch);
            $stmt->bindParam(":stok", $stock);
            $stmt->bindParam(":min_stok", $minStok);
            $stmt->bindParam(":harga", $harga);
            $stmt->bindParam(":satuan", $satuan);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function showProdukBranch($id_branch)
    {
        try {
            $stmt = $this->db->prepare("SELECT produksbranch.*, produks.sn, produks.nama as nama_produk, produks.gambar, produks.id as id_produk FROM produksbranch JOIN produks ON produksbranch.id_produk = produks.id WHERE produksbranch.id_branch = :id_branch");
            $stmt->bindParam(":id_branch", $id_branch);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteProdukBranch($id_produk)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM `produksbranch` WHERE id = :id_produk");
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId($id_produks)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM produksbranch WHERE id = :id");
            $stmt->bindParam(":id", $id_produks);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editProdukBranch($id_produk, $minStok, $harga, $satuan, $id)
    {
        try {
            $stmt = $this->db->prepare("UPDATE `produksbranch` SET `id_produk` = :id_produk, `min_stok` = :min_stok, `harga` = :harga, satuan = :satuan WHERE id = :id");
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":min_stok", $minStok);
            $stmt->bindParam(":harga", $harga);
            $stmt->bindParam(":satuan", $satuan);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProdukInBranch($id_branch)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM produks WHERE produks.id NOT IN (SELECT id_produk FROM produksbranch WHERE id_branch = :id)");
            $stmt->bindParam(":id", $id_branch);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showHistory($id_branch)
    {
        try {
            $stmt = $this->db->prepare("SELECT produkbranchhistory.jenis,produkbranchhistory.keterangan,produkbranchhistory.qty,produks.nama,produks.gambar FROM produkbranchhistory JOIN produksbranch ON produksbranch.id = produkbranchhistory.id_produk_branch JOIN produks ON produksbranch.id_produk = produks.id WHERE produkbranchhistory.id_store_branch = :id_store_branch");
            $stmt->bindParam(":id_store_branch", $id_branch);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

<?php

class Penerimaan
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
            self::$newObjek = new Penerimaan($pdo);
        }
        return self::$newObjek;
    }

    public function getUserPenerima()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE role = 'superAdmin' OR role = 'adminGudang' ");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function addPenerima($id_po, $tanggal_terima, $diterima, $diperiksa)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO penerimaan VALUES(NULL, :id_po, :tanggal_terima, :diterima, :diperiksa, 'belum')");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->bindParam(":tanggal_terima", $tanggal_terima);
            $stmt->bindParam(":diterima", $diterima);
            $stmt->bindParam(":diperiksa", $diperiksa);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function statusSampai($id_po)
    {
        try {
            $stmt = $this->db->prepare("UPDATE purchase_order SET status = 'sampai' WHERE id = :id_po");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showPenerimaan()
    {
        try {
            $stmt = $this->db->prepare("SELECT penerimaan.*, purchase_order.no_po FROM penerimaan JOIN purchase_order ON penerimaan.id_po = purchase_order.id");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    // penerimaan detail

    public function addPenerimaanDetail($id_penerimaan, $id_po_detail, $id_produk, $tanggal_exp, $qty, $kode_batch)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO penerimaan_detail VALUES(NULL,:id_penerimaan,:id_po_detail,:id_produk,:tanggal_exp,:qty, :kode_batch)");
            $stmt->bindParam(":id_penerimaan", $id_penerimaan);
            $stmt->bindParam(":id_po_detail", $id_po_detail);
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":tanggal_exp", $tanggal_exp);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":kode_batch", $kode_batch);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDataPOdetail($id_po)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM purchase_order_detail WHERE id_po = :id_po");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showPenerimaanDetail($id_penerimaan)
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order_detail.harga_beli,produks.id as id_produk ,produks.nama, produks.gambar, penerimaan_detail.* FROM penerimaan_detail JOIN produks ON penerimaan_detail.id_produk = produks.id JOIN purchase_order_detail ON penerimaan_detail.id_po_detail = purchase_order_detail.id WHERE penerimaan_detail.id_penerimaan = :id_penerimaan");
            $stmt->bindParam(":id_penerimaan", $id_penerimaan);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getIdBranch($id_penerimaan)
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order.id_store_branch FROM penerimaan JOIN purchase_order ON penerimaan.id_po = purchase_order.id WHERE penerimaan.id = :id");
            $stmt->bindParam(":id", $id_penerimaan);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateStatusPenerimaan($id_penerima)
    {
        try {
            $stmt = $this->db->prepare("UPDATE penerimaan SET status = 'diterima' WHERE id = :id_penerima");
            $stmt->bindParam(":id_penerima", $id_penerima);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function tambahStokBranch($stok_masuk, $id_produk, $id_branch, $id_penerima, $jenis, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("UPDATE produksbranch SET stok = stok + :stok_masuk WHERE id_produk = :id_produk AND id_branch = :id_branch");
            $stmt->bindParam(":stok_masuk", $stok_masuk);
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":id_branch", $id_branch);
            $stmt->execute();
            $this->updateStatusPenerimaan($id_penerima);
            $id_produkBranch = $this->getProdukBranchId($id_produk, $id_branch);
            if ($id_produkBranch) {
                $this->addHistory($id_branch, $id_produkBranch, $stok_masuk, $jenis, $keterangan);
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getStatus($id_penerima)
    {
        try {
            $stmt = $this->db->prepare("SELECT status FROM penerimaan WHERE id = :id");
            $stmt->bindParam(":id", $id_penerima);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
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

    public function getProdukBranchId($id_produk, $id_branch)
    {
        try {
            $stmt = $this->db->prepare("SELECT id FROM produksbranch WHERE id_produk = :id_produk AND id_branch = :id_branch");
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":id_branch", $id_branch);
            $stmt->execute();
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }
}

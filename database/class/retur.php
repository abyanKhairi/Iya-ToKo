<?php
class Retur
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
            self::$newObjek = new Retur($pdo);
        }
        return self::$newObjek;
    }

    public function getPOdata($id_po)
    {

        try {
            $stmt = $this->db->prepare("SELECT * FROM purchase_order WHERE id = :id");
            $stmt->bindParam(":id", $id_po);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function addRetur($id_po, $no_retur, $tanggal_retur)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO purchase_order_retur VALUES(NULL,:id_po,:no_retur,:tanggal_retur)");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->bindParam(":no_retur", $no_retur);
            $stmt->bindParam(":tanggal_retur", $tanggal_retur);
            $stmt->execute();
            return $this->db->lastInsertId();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function showRetur()
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order_retur.* ,purchase_order.no_po , purchase_order.tanggal_po FROM purchase_order_retur JOIN purchase_order ON purchase_order_retur.id_po = purchase_order.id ");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function orderDiantarRetur($id_po)
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order_detail.id as id_poDetail, purchase_order_detail.qty, purchase_order_detail.harga_beli,produks.nama FROM purchase_order_detail JOIN produks ON purchase_order_detail.id_produk = produks.id WHERE purchase_order_detail.id_po = :id_po");
            $stmt->bindParam("id_po", $id_po);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getDetailRetur($id_retur)
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order_retur_detail.*, produks.nama,produks.gambar,purchase_order_detail.harga_beli FROM `purchase_order_retur_detail`JOIN purchase_order_detail ON purchase_order_retur_detail.id_po_detail = purchase_order_detail.id JOIN produks ON purchase_order_detail.id_produk = produks.id WHERE purchase_order_retur_detail.id_po_retur = :id");
            $stmt->bindParam(":id", $id_retur);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateOrderDetail($id_poDetail, $id_po, $retur, $id_poRetur, $harga)
    {
        try {
            $stmt = $this->db->prepare("UPDATE purchase_order_detail SET qty = qty - :retur, harga_beli = harga_beli - :harga WHERE id = :id AND id_po = :id_po ");
            $stmt->bindParam(":retur", $retur);
            $stmt->bindParam(":harga", $harga);
            $stmt->bindParam(":id", $id_poDetail);
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();

            $this->addPoDetailRetur($id_poRetur, $id_poDetail, $retur);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function kembalikanDana($id_po, $hargaBaru)
    {
        try {
            $stmt = $this->db->prepare("UPDATE order_bayar SET harga = :harga_baru, kembali = dibayar - :harga_baru WHERE id_po = :id_po");
            $stmt->bindParam(":harga_baru", $hargaBaru);
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }



    public function addPoDetailRetur($id_poRetur, $id_poDetail, $retur)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO purchase_order_retur_detail VALUES(NULL,:id_po_retur,:id_po_detail,:qty) ");
            $stmt->bindParam(":id_po_detail", $id_poDetail);
            $stmt->bindParam(":id_po_retur", $id_poRetur);
            $stmt->bindParam(":qty", $retur);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getDataPoDetail($id_poDetail, $id_po)
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order_detail.qty as jumlah,purchase_order_detail.harga_beli ,produks.harga_set ,produks.nama as nama_produk FROM purchase_order_detail JOIN produks ON purchase_order_detail.id_produk = produks.id WHERE purchase_order_detail.id = :id AND purchase_order_detail.id_po = :id_po");
            $stmt->bindParam(":id", $id_poDetail);
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $th) {
            echo $th->getMessage();
            return false;
        }
    }
}

<?php
class Ordered
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
            self::$newObjek = new Ordered($pdo);
        }
        return self::$newObjek;
    }

    public function addOrder($id_branch, $id_supplier, $no_po)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO purchase_order(id, id_store_branch, id_supplier, no_po, status) VALUES(NULL, :id_branch, :id_supplier, :no_po, 'pending')");
            $stmt->bindParam(":id_branch", $id_branch);
            $stmt->bindParam(":id_supplier", $id_supplier);
            $stmt->bindParam(":no_po", $no_po);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateOrder($id_branch, $id_supplier, $no_po)
    {
        try {
            $stmt = $this->db->prepare("UPDATE purchase_order SET id_store_branch = :branch, id_supplier = :supplier, no_po = :no_po ");
            $stmt->bindParam(":branch", $id_branch);
            $stmt->bindParam(":supplier", $id_supplier);
            $stmt->bindParam(":no_po", $no_po);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function showOrder()
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order.*, suppliers.nama as nama_supplier, storebranch.nama as nama_branch   FROM `purchase_order`
            JOIN suppliers ON purchase_order.id_supplier = suppliers.id
            JOIN storebranch ON purchase_order.id_store_branch = storebranch.id;");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getOrderDiantar($id_po)
    {
        try {
            $stmt = $this->db->prepare("SELECT suppliers.nama as nama_sup, storebranch.nama as nama_branch, purchase_order.* FROM purchase_order
             JOIN suppliers ON purchase_order.id_supplier = suppliers.id
             JOIN storebranch ON purchase_order.id_store_branch = storebranch.id");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteOrder($id_order)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM purchase_order WHERE id = :id");
            $stmt->bindParam(":id", $id_order);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId($id_order)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM purchase_order WHERE id = :id");
            $stmt->bindParam(":id", $id_order);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }









    // Bagian Detail

    public function addOrderDetail($id_po, $id_produk, $qty, $harga_beli)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO purchase_order_detail(id, id_po, id_produk, qty, harga_beli) VALUES(NULL, :id_po, :id_produk, :qty, :harga_beli)");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->bindParam(":id_produk", $id_produk);
            $stmt->bindParam(":qty", $qty);
            $stmt->bindParam(":harga_beli", $harga_beli);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getHargaBeli($id_produk)
    {
        try {
            $stmt = $this->db->prepare("SELECT harga_set FROM produks WHERE id = :id");
            $stmt->bindParam(":id", $id_produk);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function showOrderDetail($id_po)
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order_detail.*, produks.sn, produks.gambar, produks.nama, produks.harga_set FROM purchase_order_detail JOIN produks ON purchase_order_detail.id_produk = produks.id WHERE purchase_order_detail.id_po = :id_po ");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteOrderDetail($id_POdetail)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM purchase_order_detail WHERE id = :id");
            $stmt->bindParam(":id", $id_POdetail);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getProdukOrder($id_po)
    {
        try {
            $stmt =  $this->db->prepare("SELECT * FROM produks WHERE produks.id NOT IN (SELECT id_produk FROM purchase_order_detail WHERE id_po = :id_po)");
            $stmt->bindParam(':id_po', $id_po);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function orderDiantar($id_po)
    {
        try {
            $stmt = $this->db->prepare("SELECT purchase_order_detail.id as id_poDetail, purchase_order_detail.qty, purchase_order_detail.harga_beli,produks.nama FROM purchase_order_detail JOIN produks ON purchase_order_detail.id_produk = produks.id WHERE purchase_order_detail.id_po = :id_po");
            $stmt->bindParam("id_po", $id_po);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function bayarOrder($id_po, $harga, $dibayar, $kembali, $tanggal_pesan, $tanggal_kirim, $tanggal_sampai)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO order_bayar VALUES(NULL, :id_po, :harga,:dibayar ,:kembalian)");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->bindParam(":harga", $harga);
            $stmt->bindParam(":dibayar", $dibayar);
            $stmt->bindParam(":kembalian", $kembali);
            $stmt->execute();
            $this->updateTanggal($id_po, $tanggal_pesan, $tanggal_kirim, $tanggal_sampai);
            $this->statusKirim($id_po);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateTanggal($id, $tanggal_pesan, $tanggal_kirim, $tanggal_sampai)
    {
        try {
            $stmt = $this->db->prepare("UPDATE purchase_order SET tanggal_po = :tanggal_pesan, tanggal_pengiriman = :tanggal_kirim, tanggal_jatuh_tempo = :tanggal_sampai WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":tanggal_pesan", $tanggal_pesan);
            $stmt->bindParam(":tanggal_kirim", $tanggal_kirim);
            $stmt->bindParam(":tanggal_sampai", $tanggal_sampai);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function statusKirim($id_po)
    {
        try {
            $stmt = $this->db->prepare("UPDATE purchase_order SET status = 'dikirim' WHERE id = :id_po");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

//, :tanggal_po, :tanggal_pengiriman, :tanggal_jatuh_tempo

<?php

class Count
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
            self::$newObjek = new Count($pdo);
        }
        return self::$newObjek;
    }

    public function count($table)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM $table");
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function countById($table, $hitung, $where, $id)
    {
        $stmt = $this->db->prepare("SELECT COUNT($hitung) FROM $table WHERE $where = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return  $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function randomDate($start_date, $end_date)
    {
        $min = strtotime($start_date);
        $max = strtotime($end_date);
        $val = rand($min, $max);
        return date('Y-m-d', $val);
    }

    public function randNum()
    {
        $min = 1000001;
        $max = 90000009;
        $val = rand($min, $max);
        return $val;
    }

    public function totalHargaOrder($id_po)
    {
        try {

            $stmt = $this->db->prepare("SELECT SUM(harga_beli) FROM purchase_order_detail WHERE id_po = :id_po");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();
            return  $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
    public function totalHargaTransaksi($id_transaksi)
    {
        try {

            $stmt = $this->db->prepare("SELECT SUM(total) FROM transaksi_detail WHERE id_transaksi = :id_transaksi");
            $stmt->bindParam(":id_transaksi", $id_transaksi);
            $stmt->execute();
            return  $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function hitungUang($field, $table)
    {
        try {
            $stmt = $this->db->prepare("SELECT SUM($field) FROM $table");
            $stmt->execute();
            return  $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function hargaBaru($id_po)
    {
        try {
            $stmt = $this->db->prepare("SELECT SUM(harga_beli) FROM purchase_order_detail WHERE id_po = :id_po ");
            $stmt->bindParam(":id_po", $id_po);
            $stmt->execute();
            return  $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}

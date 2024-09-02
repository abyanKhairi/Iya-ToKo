<?php
class storeBranch
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
            self::$newObjek = new storeBranch($pdo);
        }
        return self::$newObjek;
    }

    public function addStoreBranch($id_toko, $nama, $email, $nomorHp, $status)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO storebranch(id, id_toko, nama, email, nomor_hp, status ) VALUE(NULL,:id_toko ,:nama, :email, :nomor_hp, :status)");
            $stmt->bindParam(":id_toko", $id_toko);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nomor_hp", $nomorHp);
            $stmt->bindParam(":status", $status);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showStoreBranch($keyword)
    {
        try {
            if ($keyword) {
                $stmt = $this->db->prepare("SELECT * FROM `storebranch` WHERE storebranch.nama LIKE '%$keyword%'");
            } else {
                $stmt = $this->db->prepare("SELECT * FROM `storebranch`");
            }
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteStoreBranch($id_store)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM storebranch WHERE id = :id");
            $stmt->bindParam(":id", $id_store);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId($id_storeBranch)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `storebranch` WHERE id = :id");
            $stmt->bindParam(":id", $id_storeBranch);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editStoreBranch($id, $id_toko, $nama, $email, $nomorHp, $status)
    {
        try {
            $stmt = $this->db->prepare("UPDATE storebranch SET id_toko = :id_toko, nama = :nama, email = :email, nomor_hp =:nomor_hp, status = :status WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":id_toko", $id_toko);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nomor_hp", $nomorHp);
            $stmt->bindParam("status", $status);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

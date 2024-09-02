<?php

class Members
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
            self::$newObjek = new Members($pdo);
        }
        return self::$newObjek;
    }

    public function addMembers($id_store, $kode, $nama, $email, $nomorHp)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO members(id, id_store, kode, nama, email, nomor_hp ) VALUE(NULL, :id_store, :kode, :nama, :email, :nomor_hp)");
            $stmt->bindParam(":id_store", $id_store);
            $stmt->bindParam(":kode", $kode);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nomor_hp", $nomorHp);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showMembers($keyword)
    {
        try {
            if ($keyword) {
                $stmt = $this->db->prepare("SELECT * FROM members WHERE members.nama LIKE '%$keyword%'");
            } else {
                $stmt = $this->db->prepare("SELECT * FROM members");
            }
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteMembers($id_members)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM members WHERE id = :id");
            $stmt->bindParam(":id", $id_members);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editMembers($id_members, $kode, $nama, $email, $nomor_hp)
    {
        try {
            $stmt = $this->db->prepare("UPDATE members SET kode = :kode, nama = :nama, email = :email, nomor_hp = :nomor_hp WHERE id = :id");
            $stmt->bindParam(":id", $id_members);
            $stmt->bindParam(":kode", $kode);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nomor_hp", $nomor_hp);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId($id_members)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `members` WHERE id = :id");
            $stmt->bindParam(":id", $id_members);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

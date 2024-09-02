<?php
class Store
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
            self::$newObjek = new Store($pdo);
        }
        return self::$newObjek;
    }

    public function addStore($nama, $email, $nomorHp, $tahun)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO store(id,name, email, nomor_hp, tahun_berdiri ) VALUE(NULL, :nama, :email, :nomor_hp, :tahun)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nomor_hp", $nomorHp);
            $stmt->bindParam(":tahun", $tahun);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showStore($keyword)
    {
        try {
            if ($keyword) {
                $stmt = $this->db->prepare("SELECT * FROM `store` WHERE store.name LIKE '%$keyword%'");
            } else {
                $stmt = $this->db->prepare("SELECT * FROM `store`");
            }
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteStore($id_store)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM store WHERE id = :id");
            $stmt->bindParam(":id", $id_store);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId($id_store)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `store` WHERE id = :id");
            $stmt->bindParam(":id", $id_store);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editStore($id, $name, $email, $nomor_hp, $tahun_berdiri)
    {
        try {
            $stmt = $this->db->prepare("UPDATE store SET name = :name, email = :email, nomor_hp =:nomor_hp, tahun_berdiri = :tahun_berdiri WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nomor_hp", $nomor_hp);
            $stmt->bindParam("tahun_berdiri", $tahun_berdiri);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

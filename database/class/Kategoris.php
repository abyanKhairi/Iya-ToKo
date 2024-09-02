<?php
class Kategoris
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
            self::$newObjek = new Kategoris($pdo);
        }
        return self::$newObjek;
    }

    public function addKategoris($nama, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO kategoris(id,nama,keterangan) VALUE(NULL, :nama, :keterangan)");
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":keterangan", $keterangan);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showKategoris()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM kategoris");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteKategoris($id_kategoris)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM kategoris WHERE id = :id");
            $stmt->bindParam(":id", $id_kategoris);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId($id_kategoris)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `kategoris` WHERE id = :id");
            $stmt->bindParam(":id", $id_kategoris);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editKategoris($id, $name, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("UPDATE kategoris SET nama = :nama, keterangan = :keterangan WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nama", $name);
            $stmt->bindParam(":keterangan", $keterangan);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

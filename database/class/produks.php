<?php
class Produks
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
            self::$newObjek = new Produks($pdo);
        }
        return self::$newObjek;
    }

    public function addProduks($id_kategoris, $id_store, $sn, $nama, $gambar, $harga_set, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO produks(id ,id_kategoris, id_store, sn, nama, gambar, harga_set, keterangan) VALUE(NULL,:id_kategoris ,:id_store, :sn ,:nama, :gambar, :harga_set , :keterangan)");
            $stmt->bindParam(":id_kategoris", $id_kategoris);
            $stmt->bindParam(":id_store", $id_store);
            $stmt->bindParam(":sn", $sn);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":gambar", $gambar);
            $stmt->bindParam(":harga_set", $harga_set);
            $stmt->bindParam(":keterangan", $keterangan);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function showProduks()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM produks");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteProduks($id_produks)
    {
        try {

            $this->deleteGambar($id_produks);

            $stmt = $this->db->prepare("DELETE FROM produks WHERE id = :id");
            $stmt->bindParam(":id", $id_produks);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteGambar($id_produks)
    {
        try {
            $stmt = $this->db->prepare("SELECT gambar FROM produks WHERE id = :id");
            $stmt->bindParam(":id", $id_produks);
            $stmt->execute();
            $imagePath = $stmt->fetchColumn();

            $imagePath = '../assets/produkImg/' . trim($imagePath);

            if ($imagePath && file_exists($imagePath)) {
                unlink($imagePath);
            }

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    public function getId($id_produks)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM produks WHERE id = :id");
            $stmt->bindParam(":id", $id_produks);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editProduks($id, $id_kategoris, $id_store, $sn, $nama, $gambar, $harga_set, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("UPDATE produks SET id_kategoris = :id_kategoris, id_store = :id_store, sn = :sn, nama = :nama, gambar = :gambar, harga_set = :harga_set ,keterangan = :keterangan WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":id_kategoris", $id_kategoris);
            $stmt->bindParam(":id_store", $id_store);
            $stmt->bindParam(":sn", $sn);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":gambar", $gambar);
            $stmt->bindParam(":harga_set", $harga_set);
            $stmt->bindParam(":keterangan", $keterangan);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

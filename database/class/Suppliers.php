<?php
class Suppliers
{
    private $db;

    private static $newObjek = NULL;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function makeObjek($pdo)
    {
        if (self::$newObjek == NULL) {
            self::$newObjek = new Suppliers($pdo);
        }
        return self::$newObjek;
    }

    public function showSuppliers($keyword)
    {
        try {
            if ($keyword) {
                $stmt = $this->db->prepare("SELECT * FROM suppliers WHERE suppliers.nama LIKE '%$keyword%'");
            } else {
                $stmt = $this->db->prepare("SELECT * FROM suppliers");
            }
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function addSuppliers($id_store, $nama, $nomor_hp, $alamat, $email, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO suppliers VALUE(NULL,:id_store,:nama,:nomor_hp,:alamat,:email,:keterangan)");
            $stmt->bindParam(":id_store", $id_store);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":nomor_hp", $nomor_hp);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":keterangan", $keterangan);
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function getId($id_suppliers)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM suppliers WHERE id = :id");
            $stmt->bindParam(":id", $id_suppliers);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function editSuppliers($id, $nama, $nomor_hp, $alamat, $email, $keterangan)
    {
        try {
            $stmt = $this->db->prepare("UPDATE suppliers SET nama = :nama, nomor_hp = :nomor_hp, alamat = :alamat, email = :email, keterangan = :keterangan WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nama", $nama);
            $stmt->bindParam(":nomor_hp", $nomor_hp);
            $stmt->bindParam(":alamat", $alamat);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":keterangan", $keterangan);
            $stmt->execute();
            return true;
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }

    public function hapusSuppliers($id_suppliers)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM suppliers WHERE id = :id");
            $stmt->bindParam(":id", $id_suppliers);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}

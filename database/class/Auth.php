<?php

class Auth
{
    private $db;
    private $error;


    private static $newObjek;

    public function __construct($con)
    {
        $this->db = $con;
        @session_start();
    }

    public static function makeObjek($pdo)
    {
        if (self::$newObjek == NULL) {
            self::$newObjek = new Auth($pdo);
        }
        return self::$newObjek;
    }


    public function register($name, $email, $password, $id_store, $role)
    {
        try {

            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO users(id, name, email, password, id_store, role) VALUE(NULL, :name, :email, :password, :id_store, :role)");
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $hashPassword);
            $stmt->bindParam(":id_store", $id_store);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function login($email, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch();

            if ($stmt->rowCount()  > 0) {

                if (password_verify($password, $data["password"])) {
                    $_SESSION['user_session'] = $data['id'];
                    return true;
                } else {
                    $this->error = 'email Atau Password Salah';
                    return false;
                }
            } else {
                $this->error = 'email Atau Password Salah';
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION["user_session"])) {
            return true;
        }
    }

    public function getUser()
    {
        if (!$this->isLoggedIn()) {
            return false;
        }
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(":id", $_SESSION['user_session']);
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_session']);
        session_destroy();
        return true;
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

    public function showStore()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `store`");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function forgotPassword($email, $password)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $this->NewPassword($email, $password);
                echo "Email sesuai passowrd diganti";
                return true;
            } else {
                echo "Email yang dimasukkan tidak sesuai";
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function NewPassword($email, $password)
    {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE email = :email");
            $stmt->bindParam(":password", $hash);
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getError()
    {
        return true;
    }
}

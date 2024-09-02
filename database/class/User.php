<?php

class User
{
    private $db;
    private $error;
    private static $newObjek = null;

    public function __construct($db_conn)
    {
        $this->db = $db_conn;
    }

    public static function makeObjek($pdo)
    {
        if (self::$newObjek == NULL) {
            self::$newObjek = new User($pdo);
        }
        return self::$newObjek;
    }

    public function showUsers($keyword)
    {
        try {

            if ($keyword) {
                $stmt = $this->db->prepare("SELECT users.*, store.name as store_name FROM `users` JOIN store ON users.id_store = store.id WHERE users.name LIKE '%$keyword%'");
            } else {
                $stmt = $this->db->prepare("SELECT users.*, store.name as store_name FROM `users` JOIN store ON users.id_store = store.id");
            }
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getId($id_user)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM `users` WHERE id = :id");
            $stmt->bindParam(":id", $id_user);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function addUser($name, $email, $password, $id_store, $role)
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

    public function editUser($id_user, $name, $email, $role)
    {
        try {
            $stmt = $this->db->prepare("UPDATE users SET name = :name , email = :email, role = :role WHERE id = :id_user");
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":role", $role);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function hapusUser($id_user)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id_user);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function confirmPassword($id_user, $oldPassword)
    {
        try {
            $stmt = $this->db->prepare("SELECT password FROM users WHERE id = :id");
            $stmt->bindParam(":id", $id_user);
            $stmt->execute();
            $data = $stmt->fetch();

            if ($stmt->rowCount() == 1) {
                if (password_verify($oldPassword, $data["password"])) {
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function resetPassword($id_user, $newPassword)
    {
        try {
            $this->updatePassword($id_user, $newPassword);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updatePassword($id_user, $password)
    {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
            $stmt->bindParam(":password", $hash);
            $stmt->bindParam(":id", $id_user);
            $stmt->execute();

            if ($stmt->rowCount() == 1) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function error()
    {
        return $this->error;
    }
}

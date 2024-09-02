<?php

class Koneksi
{
    private static $dbName = "tokoo";
    private static $dbHost = "localhost";
    private static $dbUser = "root";
    private static $dbPass = "";
    private static $con = NULL;

    public function __construct()
    {
        die("Gagal Terkoneksi");
    }

    public static function connect()
    {
        if (self::$con == null) {
            try {
                self::$con = new PDO("mysql:host=" . self::$dbHost . ";" . "dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
                self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$con;
    }
}

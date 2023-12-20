<?php

namespace App\Model;
//require_once(__DIR__ . '/../../config.php');

class TypeAccountModel
{
    private $mysqli;

    public function __construct()
    {
        // Replace these values with your actual database configuration
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        $this->mysqli = new \mysqli($host, $username, $password, $database);

        // Check connection
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getAllTypeAccounts()
    {
        $result = $this->mysqli->query("SELECT * FROM loaiacc");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTypeAccountById($loaiaccId)
    {
        $loaiaccId = $this->mysqli->real_escape_string($loaiaccId);
        $result = $this->mysqli->query("SELECT * FROM loaiacc WHERE loaiacc_id = $loaiaccId");

        return $result->fetch_assoc();
    }

    public function createTypeAccount($loaiacc, $img)
    {
        $loaiacc = $this->mysqli->real_escape_string($loaiacc);
        $img = $this->mysqli->real_escape_string($img);

        return $this->mysqli->query("INSERT INTO loaiacc (loaiacc, img) VALUES ('$loaiacc', '$img')");
    }

    public function updateTypeAccount($loaiacc_id, $loaiacc, $img)
    {
        $loaiacc_id = $this->mysqli->real_escape_string($loaiacc_id);
        $loaiacc = $this->mysqli->real_escape_string($loaiacc);
        $img = $this->mysqli->real_escape_string($img);

        return $this->mysqli->query("UPDATE loaiacc SET loaiacc = '$loaiacc', img='$img' WHERE loaiacc_id=$loaiacc_id");
    }

    public function deleteTypeAccount($loaiacc_id)
    {
        $loaiacc_id = $this->mysqli->real_escape_string($loaiacc_id);
        $this->mysqli->query("DELETE FROM loaiacc WHERE loaiacc_id=$loaiacc_id");
    }
}

<?php

namespace App\Model;
//require_once(__DIR__ . '/../../config.php');

class lichsunaptienModel
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

    public function getLichSuId($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $result = $this->mysqli->query("SELECT * FROM lichsunap where User_id =$userId");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function AddLichSuNap($userId,$sotien)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $sotien = $this->mysqli->real_escape_string($sotien);
        return $this->mysqli->query("INSERT INTO lichsunap (sotiennap, User_id, ngaynap) VALUES ($sotien, $userId, now())");
    }
    public function getLichSu()
    {
        $result = $this->mysqli->query("SELECT lichsu_id,taikhoan,hoten,sotiennap,ngaynap FROM lichsunap A INNER JOIN user B ON A.User_id = B.user_id");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

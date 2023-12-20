<?php

namespace App\Model;
//require_once(__DIR__ . '/../../config.php');

class hoadonModel
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

    public function gethoadonId($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $result = $this->mysqli->query("SELECT * FROM hoadon A INNER JOIN acc B ON A.acc_id = B.acc_id where User_id =$userId ORDER BY A.ngaytao DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function Addhoadon($accId, $userId, $sotien)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $sotien = $this->mysqli->real_escape_string($sotien);
        $accId = $this->mysqli->real_escape_string($accId);
        return $this->mysqli->query("INSERT INTO hoadon ( acc_id, user_id,ngaytao,gia) VALUES ($accId, $userId, now(),$sotien)");
    }

    public function gethoadon()
    {
        $result = $this->mysqli->query("SELECT * FROM hoadon A INNER JOIN user B ON A.user_id = B.user_id INNER JOIN acc C on A.acc_id=C.acc_id ORDER BY A.ngaytao DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getallhoadon()
    {
        $result = $this->mysqli->query("SELECT * FROM hoadon A INNER JOIN user B ON A.user_id = B.user_id ORDER BY A.ngaytao DESC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function thongketheloai()
    {
        $result = $this->mysqli->query("SELECT 
        la.loaiacc AS TenLoai, 
        COUNT(a.acc_id) AS TongSoLuong,
        COUNT(CASE WHEN a.damua = 1 THEN a.acc_id END) AS TongSoLuongDamua1,
        SUM(a.gia) as TongTien
        FROM 
            loaiacc la
        LEFT JOIN 
            acc a ON la.loaiacc_id = a.loaiacc_id
        GROUP BY 
            la.loaiacc;");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function thongketong()
    {
        $result = $this->mysqli->query("SELECT 
        COUNT(*) AS tong,
        SUM(CASE WHEN damua = 1 THEN 1 ELSE 0 END) AS damua,
        SUM(CASE WHEN damua = 1 THEN gia ELSE 0 END) AS TongSoTien
        FROM acc;");
        return $result->fetch_assoc();
    }
}

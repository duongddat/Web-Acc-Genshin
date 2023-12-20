<?php

namespace App\Model;

use LengthException;

//require_once(__DIR__ . '/../../config.php');

class AccountModel
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

    public function getAllAccounts()
    {
        $result = $this->mysqli->query("SELECT * FROM acc");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAccountById($accId)
    {
        $accId = $this->mysqli->real_escape_string($accId);
        $result = $this->mysqli->query("SELECT * FROM acc WHERE acc_id = $accId");

        return $result->fetch_assoc();
    }

    public function createAccount($level, $area, $amountChar, $amountWeapon, $img, $cost, $typeId, $account, $password)
    {
        $level = $this->mysqli->real_escape_string($level);
        $area = $this->mysqli->real_escape_string($area);
        $amountChar = $this->mysqli->real_escape_string($amountChar);
        $amountWeapon = $this->mysqli->real_escape_string($amountWeapon);
        $img = $this->mysqli->real_escape_string($img);
        $cost = $this->mysqli->real_escape_string($cost);
        $typeId = $this->mysqli->real_escape_string($typeId);
        $account = $this->mysqli->real_escape_string($account);
        $password = $this->mysqli->real_escape_string($password);

        return $this->mysqli->query("INSERT INTO acc (level, khuvuc, soluongtuong, soluongvukhi, img, gia, loaiacc_id, damua, taikhoan, matkhau) VALUES ($level, '$area', $amountChar, $amountWeapon, '$img', $cost, $typeId, 0, '$account', '$password')");
    }

    public function updateAccount($acc_id, $level, $area, $amountChar, $amountWeapon, $img, $cost, $typeId, $account, $password)
    {
        $acc_id = $this->mysqli->real_escape_string($acc_id);
        $level = $this->mysqli->real_escape_string($level);
        $area = $this->mysqli->real_escape_string($area);
        $amountChar = $this->mysqli->real_escape_string($amountChar);
        $amountWeapon = $this->mysqli->real_escape_string($amountWeapon);
        $img = $this->mysqli->real_escape_string($img);
        $cost = $this->mysqli->real_escape_string($cost);
        $typeId = $this->mysqli->real_escape_string($typeId);
        $account = $this->mysqli->real_escape_string($account);
        $password = $this->mysqli->real_escape_string($password);

        return $this->mysqli->query("UPDATE acc SET level = $level, khuvuc ='$area', soluongtuong = $amountChar, soluongvukhi = $amountWeapon, img='$img', gia = $cost, loaiacc_id = $typeId, taikhoan = '$account', matkhau = '$password' WHERE acc_id=$acc_id");
    }

    public function deleteUser($acc_id)
    {
        $acc_id = $this->mysqli->real_escape_string($acc_id);
        $this->mysqli->query("DELETE FROM acc WHERE acc_id=$acc_id");
    }

    public function muaacc($acc_id)
    {
        $acc_id = $this->mysqli->real_escape_string($acc_id);
        return $this->mysqli->query("UPDATE acc SET damua=1 WHERE acc_id=$acc_id");
    }

    public function getAccountByType($type)
    {
        $AccountsByType = $this->mysqli->query("SELECT * from acc
        where loaiacc_id=" . $type . " AND damua = 0");
        return $AccountsByType;
    }

    public function getAccountByType_search($type, $level, $price, $server)
    {
        if ($server == "allserver") {
            $sql = "SELECT * FROM acc 
        WHERE loaiacc_id = " . $type . " 
        AND level >= " . $level . "
        AND gia <= " . $price . "
        AND damua = 0";
        } else {
            $sql = "SELECT * FROM acc 
        WHERE loaiacc_id = " . $type . " 
        AND level >= " . $level . "
        AND gia <= " . $price . " 
        AND  khuvuc LIKE '" . $server . "'
        AND damua = 0";
        }
        // echo $sql."\n";
        $AccountsByType = $this->mysqli->query($sql);
        return $AccountsByType;
    }
}

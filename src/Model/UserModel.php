<?php

namespace App\Model;
//require_once(__DIR__ . '/../../config.php');

class UserModel
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

    public function getAllUsers()
    {
        $result = $this->mysqli->query("SELECT * FROM user");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAllUsers_topnaptien()
    {
        $result = $this->mysqli->query(
            "SELECT user.user_id, user.hoten, SUM(lichsunap.sotiennap) as Tongsotien 
            FROM user 
            INNER JOIN lichsunap ON user.user_id = lichsunap.User_id
            GROUP BY user.user_id, user.hoten
            ORDER BY Tongsotien DESC
            LIMIT 10"
        );
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $result = $this->mysqli->query("SELECT * FROM user WHERE user_id = $userId");

        return $result->fetch_assoc();
    }

    public function getUserByUsername($username)
    {
        $username = $this->mysqli->real_escape_string($username);
        $result = $this->mysqli->query("SELECT * FROM user WHERE taikhoan = '$username'");

        return $result->fetch_assoc();
    }

    public function createUser($name, $email, $username, $password)
    {
        $name = $this->mysqli->real_escape_string($name);
        $email = $this->mysqli->real_escape_string($email);
        $username = $this->mysqli->real_escape_string($username);
        $password = $this->mysqli->real_escape_string($password);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->mysqli->query("INSERT INTO user (taikhoan, matkhau, hoten, gmail, sotien, isAdmin) VALUES ('$username', '$hashedPassword', '$name', '$email', 0, 0)");
    }

    public function changePassword($userId, $password)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $password = $this->mysqli->real_escape_string($password);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->mysqli->query("UPDATE user SET matkhau='$hashedPassword'  WHERE user_id=$userId");
    }

    public function updateUser($userId, $username, $password, $email)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $username = $this->mysqli->real_escape_string($username);
        $password = $this->mysqli->real_escape_string($password);
        $email = $this->mysqli->real_escape_string($email);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->mysqli->query("UPDATE users SET username='$username', password_input='$hashedPassword', email='$email' WHERE id=$userId");
    }

    public function deleteUser($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $this->mysqli->query("DELETE FROM user WHERE user_id=$userId");
    }

    public function naptien($userId, $naptien)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $naptien = $this->mysqli->real_escape_string($naptien);
        return $this->mysqli->query("UPDATE user SET sotien=sotien+$naptien  WHERE user_id=$userId");
    }
    public function trutien($userId, $naptien)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $naptien = $this->mysqli->real_escape_string($naptien);
        return $this->mysqli->query("UPDATE user SET sotien=sotien-$naptien  WHERE user_id=$userId");
    }
    // public function getsoban()
    // {
    //     $typeAcc = $this->mysqli->query("SELECT loaiacc.loaiacc_id, loaiacc, COUNT(damua) AS Tongsoban
    //         FROM loaiacc
    //         LEFT JOIN acc ON loaiacc.loaiacc_id = acc.loaiacc_id AND damua = 1
    //         GROUP BY loaiacc.loaiacc_id, loaiacc");
    //     return $typeAcc;
    // }
    // public function getslByType()
    // {
    //     $sltypeAcc = $this->mysqli->query("SELECT loaiacc_id,COUNT(loaiacc_id) as Tongsoacc FROM acc WHERE damua = 0  GROUP BY acc.loaiacc_id");
    //     return $sltypeAcc;
    // }
    public function getsoban()
    {
        $typeAcc = $this->mysqli->query("SELECT loaiacc.loaiacc_id, loaiacc, COUNT(damua) AS Tongsoban
        FROM loaiacc
        LEFT JOIN acc ON loaiacc.loaiacc_id = acc.loaiacc_id AND damua = 1
        GROUP BY loaiacc.loaiacc_id, loaiacc");
        return $typeAcc;
    }
    public function getslByType()
    {
        $sltypeAcc = $this->mysqli->query("SELECT loaiacc.loaiacc_id, loaiacc, COUNT(damua) AS Tongsoacc 
        FROM loaiacc
        LEFT JOIN acc ON loaiacc.loaiacc_id = acc.loaiacc_id AND damua = 0
        GROUP BY loaiacc.loaiacc_id, loaiacc");
        return $sltypeAcc;
    }
}

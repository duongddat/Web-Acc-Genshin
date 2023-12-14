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
}

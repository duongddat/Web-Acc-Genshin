<?php

namespace App\Controller;

use App\Model\UserModel;

class AuthenticationController
{

    public function __construct()
    {
    }

    public function authenticate()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            session_start();
            $user = (new UserModel())->getUserByUsername($username);
            if ($user && password_verify($password, $user['matkhau'])) {
                // User authenticated, save user to session

                $_SESSION['currentUser'] = $user;

                // Redirect to index.php
                $_SESSION['flash_message'] = "Đăng nhập thành công!!!";
                $_SESSION['type_message'] = "success";

                header("Location: ../user/index");
                exit();
            } else {
                // Authentication failed, redirect to signin.php
                $_SESSION['flash_message'] = "Sai tài khoản hoặc mật khẩu!!!";
                $_SESSION['type_message'] = "danger";

                header("Location: ../user/signin");
                exit();
            }
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user_id = $_POST['user_id'];
            $password = $_POST['password'];
            $newPassword = $_POST['newPassword'];
            $confirmNewPassword = $_POST['confirmNewPassword'];

            session_start();
            if ($newPassword != $confirmNewPassword) {
                $_SESSION['flash_message'] = "Vui lòng xác nhận chính xác mật khẩu!!!";
                $_SESSION['type_message'] = "danger";

                header("Location: ../user/changePassword");
                exit();
            }

            $user = (new UserModel())->getUserById($user_id);
            if ($user && password_verify($password, $user['matkhau'])) {
                (new UserModel())->changePassword($user_id, $newPassword);

                // Redirect to index.php
                $_SESSION['flash_message'] = "Đổi mật khẩu thành công!!!";
                $_SESSION['type_message'] = "success";

                header("Location: ../user/index");
                exit();
            } else {
                $_SESSION['flash_message'] = "Sai mật khẩu!!!";
                $_SESSION['type_message'] = "danger";
                header("Location: ../user/changePassword");
                exit();
            }
        }
    }
}

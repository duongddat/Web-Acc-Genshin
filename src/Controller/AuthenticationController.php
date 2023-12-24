<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Model\lichsunaptienModel;
use App\Model\hoadonModel;
use App\Model\AccountModel;

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

                header("Location: ../index");
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

                header("Location: ../index");
                exit();
            } else {
                $_SESSION['flash_message'] = "Sai mật khẩu!!!";
                $_SESSION['type_message'] = "danger";
                header("Location: ../user/changePassword");
                exit();
            }
        }
    }

    public function naptien()
    {
        $user_id = $_POST['user_id'];
        $sotien = $_POST['sotien'];
        session_start();
        if ($sotien == "") {
            $_SESSION['flash_message'] = "Vui lòng chọn mệnh giá!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../user/naptien");
            exit();
        }
        $user = (new UserModel())->naptien($user_id, $sotien);
        $naptien = (new lichsunaptienModel())->AddLichSuNap($user_id, $sotien);
        $_SESSION['currentUser'] = (new UserModel())->getUserById($user_id);
        $_SESSION['flash_message'] = "Nạp tiền thành công!!!";
        $_SESSION['type_message'] = "success";
        header("Location: ../index");
    }

    public function muaacc()
    {
        session_start();
        $user = $_SESSION['currentUser'];
        $user_id = $user['user_id'];
        $acc_id = $_POST['acc_id'];
        $sotien = $_POST['sotien'];
        if ($sotien > $user['sotien']) {
            $_SESSION['flash_message'] = "So Du Khong Du!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../user/naptien");
        } else {
            $acc = (new AccountModel())->getAccountById($acc_id);
            if ($acc['damua'] == 0) {
                $user = (new UserModel())->trutien($user_id, $sotien);
                $hoadon = (new hoadonModel())->Addhoadon($acc_id, $user_id, $sotien);
                $mua = (new AccountModel())->muaacc($acc_id);
                $_SESSION['currentUser'] = (new UserModel())->getUserById($user_id);
                $_SESSION['flash_message'] = "Mua acc thành công!!!";
                $_SESSION['type_message'] = "success";
                header("Location: ../user/hoadonlist");
            } else {
                $_SESSION['flash_message'] = "Giao Dịch Thất Bại-Bạn Đã Chậm Tay!!!";
                $_SESSION['type_message'] = "danger";
                header("Location: ../index");
            }
        }
    }
}

<?php

namespace App\Controller;

use App\Model\UserModel;
use App\Controller;

class UserController extends Controller
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    //get Allusers
    public function index()
    {
        $allusers = $this->userModel->getAllUsers_topnaptien();
        $typeAcc = $this->userModel->getsoban();
        $sltypeAcc = $this->userModel->getslByType();
        $this->render('users\index', ['allusers' => $allusers, 'typeaccs' => $typeAcc, 'slaccs' => $sltypeAcc]);
        // $this->render('users\index', []);

    }

    public function signin()
    {
        //header('Location: /src/View/users/signin.php');
        $this->render('users\signin', []);
    }

    public function register()
    {
        //header('Location: /src/View/users/signin.php');
        $this->render('users\register', []);
    }

    public function changePassword()
    {
        //header('Location: /src/View/users/signin.php');
        session_start();
        $user = $_SESSION['currentUser'];
        $this->render('users\changePassword', ['user' => $user]);
    }


    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            session_start();
            if (isset($_SESSION['currentUser'])) {
                unset($_SESSION['currentUser']);
                session_destroy();
                header("Location: ../index");
                exit();
            }
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $configPassword = $_POST['configPassword'];

            session_start();

            if ($password != $configPassword) {
                $_SESSION['flash_message'] = "Vui lòng xác nhận chính xác mật khẩu!!!";
                $_SESSION['type_message'] = "danger";

                header("Location: ../user/register");
                exit();
            }

            if ($this->userModel->getUserByUsername($username) != null) {
                $_SESSION['flash_message'] = "Vui lòng chọn tên đăng nhập khác!!!";
                $_SESSION['type_message'] = "danger";

                header("Location: ../user/register");
                exit();
            }

            // Call the model to create a new user
            $user = $this->userModel->createUser($name, $email, $username, $password);

            if ($user) {
                // Redirect to the user list page or show a success message
                $_SESSION['flash_message'] = "Đăng ký tài khoản thành công!!!";
                $_SESSION['type_message'] = "success";
                $_SESSION['currentUser'] = $this->userModel->getUserByUsername($username);

                header("Location: ../index");
                exit();
            } else {
                // Handle the case where the user creation failed
                echo 'User creation failed.';
            }
        }
    }

    public function naptien()
    {
        session_start();
        $user = $_SESSION['currentUser'];
        if ($user == null) {
            $_SESSION['flash_message'] = "Vui lòng Đăng Nhập!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../index");
            exit();
        } else $this->render('users\naptien', ['user' => $user]);
    }


    //ADMIN
    public function getAllUsers()
    {
        $users = $this->userModel->getAllUsers();
        $this->render('admin\user-list', ['users' => $users]);
    }

    public function show($userId)
    {
        // Fetch a single user by ID and display in a view
        $user = $this->userModel->getUserById($userId);
        $this->render('admin\user-detail', ['user' => $user]);
    }

    public function createUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            // Display the form for creating a new user
            $this->render('admin\create-user', []);
        }
    }

    private function processForm()
    {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];


        session_start();
        if ($this->userModel->getUserByUsername($username) != null) {
            $_SESSION['flash_message'] = "Vui lòng chọn tên đăng nhập khác!!!";
            $_SESSION['type_message'] = "danger";

            header("Location: ../admin/create-new-user");
            exit();
        }
        // Call the model to create a new user
        $user = $this->userModel->createUser($name, $email, $username, $password);

        if ($user) {
            // Redirect to the user list page or show a success message
            $_SESSION['flash_message'] = "Tạo tài khoản thành công!!!";
            $_SESSION['type_message'] = "success";

            header("Location: ../admin/user-list");
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'User creation failed.';
        }
    }

    public function update($userId)
    {
        // Handle form submission to update a user
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $this->userModel->getUserById($userId);
            $currentName = $user['taikhoan'];

            $this->processFormUpdate($userId, $currentName);
        } else {
            // Fetch the user data and display the form to update
            $user = $this->userModel->getUserById($userId);
            $this->render('admin\user-form', ['user' => $user]);
        }
    }

    private function processFormUpdate($userId, $currentName)
    {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sotien = $_POST['sotien'];

        session_start();
        if ($username != $currentName && $this->userModel->getUserByUsername($username) != null) {
            $_SESSION['flash_message'] = "Vui lòng chọn tên đăng nhập khác!!!";
            $_SESSION['type_message'] = "danger";

            header('Location: ../admin/update-user-info/' . $userId);
            exit();
        }

        // Call the model to update the user
        $user = $this->userModel->updateUser($userId, $username, $password, $name, $email, $sotien);

        if ($user) {
            // Redirect to the user list page or show a success message
            $_SESSION['flash_message'] = "Chỉnh sửa tài khoản thành công!!!";
            $_SESSION['type_message'] = "success";
            header('Location: ../admin/user-list');
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'User update failed.';
        }
    }

    public function delete($userId)
    {
        // Call the model to delete the user
        $this->userModel->deleteUser($userId);

        // Redirect to the user list page after deletion
        header('Location: ../admin/user-list');
    }
}

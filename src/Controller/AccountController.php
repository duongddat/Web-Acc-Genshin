<?php

namespace App\Controller;

use App\Model\AccountModel;
use App\Model\TypeAccountModel;
use App\Controller;

class AccountController extends Controller
{
    private $accountModel;

    public function __construct()
    {
        $this->accountModel = new AccountModel();
    }

    public function accountList()
    {
        // Fetch all users and display them in a view
        $accounts = $this->accountModel->getAllAccounts();

        $this->render('admin\account-list', ['accounts' => $accounts]);
    }



    public function createAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            $types = (new TypeAccountModel())->getAllTypeAccounts();
            $this->render('admin\create-account', ['types' => $types]);
        }
    }

    private function processForm()
    {
        // Retrieve form data
        $level = $_POST['level'];
        $area = $_POST['area'];
        $amountChar = $_POST['amountChar'];
        $amountWeapon = $_POST['amountWeapon'];
        $cost = $_POST['cost'];
        $typeAcc = $_POST['typeAcc'];
        $taikhoan = $_POST['taikhoan'];
        $password = $_POST['password'];

        $target_dir = __DIR__ . "/../../public/asset/img/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);

        session_start();

        if ($area == "") {
            $_SESSION['flash_message'] = "Vui lòng chọn khu vực!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../admin/account-create");
            exit();
        }

        if ($typeAcc == "") {
            $_SESSION['flash_message'] = "Vui lòng chọn loại account!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../admin/account-create");
            exit();
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION['flash_message'] = "Ảnh đã tồn tại trong hệ thống!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../admin/account-create");
            exit();
        }

        if (isset($_FILES['img'])) {

            $img = $_FILES['img'];
            $img_name = $_FILES["img"]["name"];
            move_uploaded_file($img['tmp_name'], $target_file);
        } else {
            $_SESSION['flash_message'] = "Lỗi không thể load ảnh!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../admin/account-create");
            exit();
        }



        $account = $this->accountModel->createAccount($level, $area, $amountChar, $amountWeapon, $img_name, $cost, $typeAcc, $taikhoan, $password);
        if ($account) {
            // Redirect to the user list page or show a success message
            $_SESSION['flash_message'] = "Thêm account thành công!!!";
            $_SESSION['type_message'] = "success";

            header("Location: ../admin/account-list");
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'Account creation failed.';
        }
    }

    public function getAccount($accId)
    {
        $account = $this->accountModel->getAccountById($accId);
        $types = (new TypeAccountModel())->getAllTypeAccounts();

        $this->render('admin\account-detail', ['account' => $account, 'types' => $types]);
    }

    public function updateAccount($accId)
    {
        // Handle form submission to update a user
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processFormUpdate($accId);
        } else {
            // Fetch the user data and display the form to update
            $account = $this->accountModel->getAccountById($accId);
            $types = (new TypeAccountModel())->getAllTypeAccounts();

            $this->render('admin\account-form', ['account' => $account, 'types' => $types]);
        }
    }

    private function processFormUpdate($accId)
    {

        // Retrieve form data
        $level = $_POST['level'];
        $area = $_POST['area'];
        $amountChar = $_POST['amountChar'];
        $amountWeapon = $_POST['amountWeapon'];
        $cost = $_POST['cost'];
        $typeAcc = $_POST['typeAcc'];
        $taikhoan = $_POST['taikhoan'];
        $password = $_POST['password'];

        session_start();
        if ($area == "") {
            $_SESSION['flash_message'] = "Vui lòng chọn khu vực!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../admin/account-create");
            exit();
        }

        if ($typeAcc == "") {
            $_SESSION['flash_message'] = "Vui lòng chọn loại account!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../admin/account-create");
            exit();
        }

        // Check if file already exists
        if (isset($_FILES['img']) && $_FILES["img"]["name"] != null) {
            $target_dir = __DIR__ . "/../../public/asset/img/";
            $target_file = $target_dir . basename($_FILES["img"]["name"]);

            if (file_exists($target_file)) {
                $_SESSION['flash_message'] = "Ảnh đã tồn tại trong hệ thống!!!";
                $_SESSION['type_message'] = "danger";
                header("Location: ../admin/account-form");
                exit();
            }

            $img = $_FILES['img'];
            $img_name = $_FILES["img"]["name"];
            move_uploaded_file($img['tmp_name'], $target_file);
        } else {
            $accountCurrent = $this->accountModel->getAccountById($accId);
            $img_name = $accountCurrent['img'];
        }

        // Call the model to update the user
        $account = $this->accountModel->updateAccount($accId, $level, $area, $amountChar, $amountWeapon, $img_name, $cost, $typeAcc, $taikhoan, $password);

        if ($account) {
            // Redirect to the user list page or show a success message
            $_SESSION['flash_message'] = "Cập nhật thông tin account thành công!!!";
            $_SESSION['type_message'] = "success";

            header("Location: ../admin/account-list");
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'Account update failed.';
        }
    }

    public function deleteAccount($accId)
    {
        // Call the model to delete the user
        $this->accountModel->deleteAccount($accId);

        // Redirect to the user list page after deletion
        session_start();
        $_SESSION['flash_message'] = "Xóa account thành công!!!";
        $_SESSION['type_message'] = "success";

        header("Location: ../admin/account-list");
    }

    public function acctype()
    {
        $level = isset($_POST['level']) ? (int)$_POST['level'] : null;
        $price = isset($_POST['price']) ? (int)$_POST['price'] : null;
        $server = isset($_POST['acc_server']) ? $_POST['acc_server'] : null;

        $type = 0;
        $uri = $_SERVER['REQUEST_URI'];
        $uri = basename($uri);
        $decodedUri = urldecode($uri);

        $loaiaccs = (new TypeAccountModel())->getAllTypeAccounts();
        foreach ($loaiaccs as $loaiacc) {
            if (str_replace(' ', '', strtolower($loaiacc['loaiacc'])) == $decodedUri) {
                $type = $loaiacc['loaiacc_id'];
            }
        }

        if ($level !== null && $price !== null && $server !== null) {
            $Accounts = $this->accountModel->getAccountByType_search($type, $level, $price, $server);
            $this->render('users\acctype', ['accounts' => $Accounts]);
        } else {
            $Accounts = $this->accountModel->getAccountByType($type);
            $this->render('users\acctype', ['accounts' => $Accounts]);
        }
    }
    public function accdetail($accId)
    {
        $Account = $this->accountModel->getAccountById($accId);
        $this->render('users\accdetail', ['account' => $Account]);
    }
}

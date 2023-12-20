<?php

namespace App\Controller;

use App\Model\AccountModel;
use App\Model\TypeAccountModel;
use App\Controller;

class TypeAccountController extends Controller
{
    private $typeAccountModel;

    public function __construct()
    {
        $this->typeAccountModel = new TypeAccountModel();
    }

    public function typeAccountList()
    {
        // Fetch all users and display them in a view
        $types = $this->typeAccountModel->getAllTypeAccounts();

        $this->render('admin\type-account-list', ['types' => $types]);
    }



    public function createTypeAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            $this->render('admin\create-type-account', []);
        }
    }

    private function processForm()
    {
        // Retrieve form data
        $loaiacc = $_POST['loaiacc'];

        $target_dir = __DIR__ . "/../../public/asset/imgType/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);

        session_start();

        // Check if file already exists
        if (file_exists($target_file)) {
            $_SESSION['flash_message'] = "Ảnh đã tồn tại trong hệ thống!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../admin/type-account-create");
            exit();
        }

        if (isset($_FILES['img'])) {

            $img = $_FILES['img'];
            $img_name = $_FILES["img"]["name"];
            move_uploaded_file($img['tmp_name'], $target_file);
        } else {
            $_SESSION['flash_message'] = "Lỗi không thể load ảnh!!!";
            $_SESSION['type_message'] = "danger";
            header("Location: ../admin/type-account-create");
            exit();
        }

        $type = $this->typeAccountModel->createTypeAccount($loaiacc, $img_name);
        if ($type) {
            // Redirect to the user list page or show a success message
            $_SESSION['flash_message'] = "Thêm loại loại account thành công!!!";
            $_SESSION['type_message'] = "success";

            header("Location: ../admin/type-account-list");
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'Account creation failed.';
        }
    }

    public function getTypeAccount($loaiAccId)
    {
        $type = $this->typeAccountModel->getTypeAccountById($loaiAccId);

        $this->render('admin\type-account-detail', ['type' => $type]);
    }

    public function updateTypeAccount($loaiAccId)
    {
        // Handle form submission to update a user
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processFormUpdate($loaiAccId);
        } else {
            // Fetch the user data and display the form to update
            $type = $this->typeAccountModel->getTypeAccountById($loaiAccId);

            $this->render('admin\type-account-form', ['type' => $type]);
        }
    }

    private function processFormUpdate($loaiAccId)
    {

        // Retrieve form data
        $loaiacc = $_POST['loaiacc'];
        session_start();

        // Check if file already exists
        if (isset($_FILES['img']) && $_FILES["img"]["name"] != null) {
            $target_dir = __DIR__ . "/../../public/asset/imgType/";
            $target_file = $target_dir . basename($_FILES["img"]["name"]);

            if (file_exists($target_file)) {
                $_SESSION['flash_message'] = "Ảnh đã tồn tại trong hệ thống!!!";
                $_SESSION['type_message'] = "danger";
                header("Location: ../admin/type-account-form");
                exit();
            }

            $img = $_FILES['img'];
            $img_name = $_FILES["img"]["name"];
            move_uploaded_file($img['tmp_name'], $target_file);
        } else {
            $accountCurrent = $this->typeAccountModel->getTypeAccountById($loaiAccId);
            $img_name = $accountCurrent['img'];
        }

        // Call the model to update the user
        $account = $this->typeAccountModel->updateTypeAccount($loaiAccId, $loaiacc, $img_name);

        if ($account) {
            // Redirect to the user list page or show a success message
            $_SESSION['flash_message'] = "Cập nhật thông tin loại account thành công!!!";
            $_SESSION['type_message'] = "success";

            header("Location: ../admin/type-account-list");
            exit();
        } else {
            // Handle the case where the user creation failed
            echo 'Type account update failed.';
        }
    }

    public function deleteTypeAccount($accId)
    {
        // Call the model to delete the user
        $this->typeAccountModel->deleteTypeAccount($accId);

        // Redirect to the user list page after deletion
        session_start();
        $_SESSION['flash_message'] = "Xóa loại account thành công!!!";
        $_SESSION['type_message'] = "success";

        header("Location: ../admin/type-account-list");
    }
}

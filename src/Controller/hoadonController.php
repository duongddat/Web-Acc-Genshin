<?php

namespace App\Controller;

use App\Model\hoadonModel;
use App\Controller;

class hoadonController extends Controller
{
    private $hoadonModel;

    public function __construct()
    {
        $this->hoadonModel = new hoadonModel();
    }
    public function HoaDonListId()
    {
        session_start();
        $user = $_SESSION['currentUser'];
        $accounts = $this->hoadonModel->gethoadonId($user['user_id']);
        $this->render('users\hoadon', ['accounts' => $accounts]);
    }
    public function thongke()
    {
        $accounts = $this->hoadonModel->thongketheloai();
        $tk = $this->hoadonModel->thongketong();
        $hd = $this->hoadonModel->getallhoadon();
        $this->render('admin\thongke', ['accounts' => $accounts, 'tk' => $tk, 'hd' => $hd]);
    }
}

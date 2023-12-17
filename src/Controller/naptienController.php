<?php

namespace App\Controller;

use App\Model\lichsunaptienModel;
use App\Controller;

class naptienController extends Controller
{
    private $naptienModel;

    public function __construct()
    {
        $this->naptienModel = new lichsunaptienModel();
    }
    public function naptienlistid()
    {  
        session_start();
        $user = $_SESSION['currentUser'];
        $accounts = $this->naptienModel->getLichSuId($user['user_id']);
        $this->render('users\lichsunaptien', ['accounts' => $accounts]);
    }
    public function naptienlist()
    {  
        $accounts = $this->naptienModel->getLichSu();
        $this->render('admin\quanlynap', ['accounts' => $accounts]);
    }
}
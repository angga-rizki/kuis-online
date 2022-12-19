<?php

namespace App\Controllers;

use App\Models\HistoryModel;
use App\Models\AuthModel;
use CodeIgniter\Controller;

class History extends Controller {

    public function index() {
        $session = session();
        $historyModel = new HistoryModel();
        $userModel = new AuthModel();
        
        if (!$session->has('authenticated')) {
            return redirect()->to(site_url('auth'));
        }
        $typeUser = $session->get('type');
        if ($typeUser == 'admin') {
            return redirect()->to(site_url('admin'));
        }
        
        $data_user = $userModel->getUser($session->get('username'));
        $data_header = [
            'title' => 'History',
            'user' => $data_user
        ];
        
        $username = $session->get('username');
        $data_history = [
            'history' => $historyModel->getHistoryByUsername($username)
        ];
        
        echo view('templates/user/header', $data_header);
        echo view('user/history', $data_history);
        echo view('templates/user/footer');
    }
}

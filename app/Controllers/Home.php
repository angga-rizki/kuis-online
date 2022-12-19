<?php

namespace App\Controllers;

use App\Models\QuisModel;
use App\Models\AuthModel;
use CodeIgniter\Controller;

class Home extends Controller {

    public function index() {
        $session = session();
        $quisModel = new QuisModel();
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
            'title' => 'Home',
            'user' => $data_user
        ]; 
        $data_quis['quis'] = $quisModel->getQuisByLevel($data_user->level);
        
        echo view('templates/user/header', $data_header);
        echo view('user/home', $data_quis);
        echo view('templates/user/footer');
    }
}

<?php

namespace App\Controllers;

use App\Models\SoalModel;
use App\Models\QuisModel;
use App\Models\AuthModel;
use CodeIgniter\Controller;

class Quis extends Controller {

    public function index($kode_quis) {
        $session = session();
        $soalModel = new SoalModel();
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
            'title' => $quisModel->getQuis($kode_quis)->nama_quis,
            'user' => $data_user
        ];
        $data_quis = [
            'soal' => $soalModel->getSoalByKodeQuis($kode_quis),
            'quis' => $quisModel->getQuis($kode_quis)
        ];

        echo view('templates/user/header', $data_header);
        echo view('user/quis', $data_quis);
        echo view('templates/user/footer');
    }

}

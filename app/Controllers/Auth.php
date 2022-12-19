<?php

namespace App\Controllers;

use App\Models\AuthModel;
use CodeIgniter\Controller;

class Auth extends Controller {

    public function index() {
        $session = session();
        if ($session->has('authenticated')) {
            $typeUser = $session->get('type');
            if ($typeUser == 'admin') {
                 return redirect()->to(site_url('admin'));
            }
            return redirect()->to(site_url('home'));
        }
        
        echo view('auth');
    }

    public function login() {
        $model = new AuthModel();
        $session = session();

        if (!$this->validate([
                    'username' => 'required',
                    'password' => 'required'
                ])) {

            $session->setflashdata('message', 'Username dan Password harus diisi!');
            return redirect()->to(site_url('auth'));
        }

        $usernameInput = $this->request->getVar('username');
        $passwordInput = $this->request->getVar('password');

        $akun = $model->getUser($usernameInput);

        if (empty($akun)) {
            $session->setflashdata('message', 'Username tidak ditemukan!');
            return redirect()->to(site_url('auth'));
        }

        if ($passwordInput != $akun->password) {
            $session->setflashdata('message', 'Password salah!');
            return redirect()->to(site_url('auth'));
        }

        $user_data = [
            'username' => $akun->username,
            'nama' => $akun->nama,
            'type' => $akun->type,
            'level' => $akun->level,
            'authenticated' => TRUE
        ];
        $session->set($user_data);
        
        if ($akun->type == 'admin') {
            return redirect()->to(site_url('admin'));
        }
        return redirect()->to(site_url('home'));
    }

    public function logout() {
        session()->destroy();
        return redirect()->to(site_url('auth'));
    }

}

<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\HistoryModel;
use App\Models\QuisModel;
use App\Models\SoalModel;
use App\Models\GambarModel;
use CodeIgniter\Controller;

class Admin extends Controller {

    public function index() {
        $session = session();
        if (!$session->has('authenticated')) {
            return redirect()->to(site_url('auth'));
        }
        $typeUser = $session->get('type');
        if ($typeUser != 'admin') {
            return redirect()->to(site_url('home'));
        }

        $userModel = new AuthModel();
        $historyModel = new HistoryModel();
        $quisModel = new QuisModel();
        $soalModel = new SoalModel();

        $data_header = [
            'title' => 'Home',
            'nama' => $session->get('nama')
        ];
        $data = [
            'jumlah_user' => count($userModel->getAll()),
            'jumlah_history' => count($historyModel->getAll()),
            'jumlah_quis' => count($quisModel->getAll()),
            'jumlah_soal' => count($soalModel->getAll())
        ];
        echo view('templates/admin/header', $data_header);
        echo view('admin/home', $data);
        echo view('templates/admin/footer');
    }

    public function user() {
        $session = session();
        if (!$session->has('authenticated')) {
            return redirect()->to(site_url('auth'));
        }
        $typeUser = $session->get('type');
        if ($typeUser != 'admin') {
            return redirect()->to(site_url('home'));
        }

        $userModel = new AuthModel();
        $data_header = [
            'title' => 'User',
            'nama' => $session->get('nama')
        ];
        $data = [
            'admin' => $userModel->getUserByType('admin'),
            'user' => $userModel->getUserByType('user')
        ];
        echo view('templates/admin/header', $data_header);
        echo view('admin/user', $data);
        echo view('templates/admin/footer');
    }

    public function saveuser() {
        $model = new AuthModel();
        $session = session();

        if (!$this->validate([
                    'id' => 'max_length[12]',
                    'username' => 'required|max_length[12]',
                    'password' => 'required|max_length[12]',
                    'nama' => 'required|max_length[50]',
                    'type' => 'required',
                    'level' => 'required'
                ])) {
            //$this->setMessageFlashData : memanggil function setMessageFlashData yang ada di page ini
            $session->setflashdata($this->setMessageFlashData('Value tidak valid!', 'error'));
            return redirect()->to(site_url('admin/user'));
        }

        $id = $this->request->getVar('id');
        $usernameInput = $this->request->getVar('username');
        $passwordInput = $this->request->getVar('password');
        $namaInput = $this->request->getVar('nama');
        $typeInput = $this->request->getVar('type');
        $levelInput = $this->request->getVar('level');

        if ($typeInput == 'admin') {
            $levelInput = 'superadmin';
        }

        $data = [
            'username' => $usernameInput,
            'password' => $passwordInput,
            'nama' => $namaInput,
            'type' => $typeInput,
            'level' => $levelInput
        ];

        //Insert
        if (empty($model->getUser($id)) && !$model->insert($data, false)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menambah data!', 'error'));
            return redirect()->to(site_url('admin/user'));
        }

        //Update
        if (!$model->update($id, $data)) {
            $session->setflashdata($this->setMessageFlashData('Gagal meng-edit data!', 'error'));
            return redirect()->to(site_url('admin/user'));
        }

        $session->setflashdata($this->setMessageFlashData('Sukses!', 'sukses'));

        return redirect()->to(site_url('admin/user'));
    }

    public function deleteuser($username) {
        $model = new AuthModel();
        $session = session();

        if (!$model->delete($username)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menghapus data!', 'error'));
            return redirect()->to(site_url('admin/user'));
        }
        $session->setflashdata($this->setMessageFlashData('Sukses!', 'sukses'));
        return redirect()->to(site_url('admin/user'));
    }

    public function gambar() {
        $session = session();
        if (!$session->has('authenticated')) {
            return redirect()->to(site_url('auth'));
        }
        $typeUser = $session->get('type');
        if ($typeUser != 'admin') {
            return redirect()->to(site_url('home'));
        }

        $gambarModel = new GambarModel();
        $data_header = [
            'title' => 'Gambar',
            'nama' => $session->get('nama')
        ];
        $data = [
            'gambar' => $gambarModel->getAll()
        ];
        echo view('templates/admin/header', $data_header);
        echo view('admin/gambar', $data);
        echo view('templates/admin/footer');
    }

    public function savegambar() {
        $session = session();
        $gambarModel = new GambarModel();
        $userModel = new AuthModel();

        if (!$this->validate([
                    'file_gambar' => 'uploaded[file_gambar]|is_image[file_gambar]',
                    'deskripsi' => 'required|max_length[255]',
                    'from' => 'max_length[4]'
                ])) {
            $session->setflashdata($this->setMessageFlashData('Upload gagal atau file tidak valid!', 'error'));
            return redirect()->to(site_url('admin/gambar'));
        }

        $from = $this->request->getVar('from');

        $fileUpload = $this->request->getFile('file_gambar');
        /* Nama img + random int, agar saat user update foto tidak bug looping menghapus file foto baru yang memiliki 
          nama sama dengan foto lama di database jika foto lama tidak tidak ada atau terhapus di assets.
          tl:dr : Agar nama foto baru tidak sama dengan nama foto lama. */
        $fileUpload->move(ROOTPATH . 'assets/picture', 'img' . random_int(0, 99) . '-' . $fileUpload->getName());

        $deskripsi = $this->request->getVar('deskripsi');
        $namaFile = $fileUpload->getName();
        $ukuranFile = $fileUpload->getSizeByUnit('kb');
        $tipeFile = $fileUpload->getExtension();

        $data = [
            'deskripsi' => $deskripsi,
            'nama_file' => $namaFile,
            'ukuran_file' => $ukuranFile,
            'tipe_file' => $tipeFile
        ];

        if ($gambarModel->insert($data) == 0) {
            $session->setflashdata($this->setMessageFlashData('Gagal menambahkan data!', 'error'));
            return redirect()->to(site_url('admin/gambar'));
        }

        if ($from == 'user') {
            $username = $session->get('username');

            //Foto lama
            $foto_user = $userModel->getUser($username)->foto;

            //Hapus foto lama
            if (!empty($foto_user) && file_exists('../assets/picture/' . $foto_user)) {
                unlink('../assets/picture/' . $foto_user);
                $gambarModel->where('nama_file', $foto_user)->delete();
            }

            //Update foto baru            
            $userModel->update($username, ['foto' => $namaFile]);

            return redirect()->to(site_url('home'));
        }

        $session->setflashdata($this->setMessageFlashData('Sukses!', 'sukses'));
        return redirect()->to(site_url('admin/gambar'));
    }

    public function deletegambar($id) {
        $model = new GambarModel();
        $session = session();

        $nama_file = $model->getGambar($id)->nama_file;

        if (!$model->delete($id)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menghapus data!', 'error'));
            return redirect()->to(site_url('admin/gambar'));
        }

        if (file_exists('../assets/picture/' . $nama_file)) {
            unlink('../assets/picture/' . $nama_file);
        }
        
        $session->setflashdata($this->setMessageFlashData('Sukses!', 'sukses'));
        return redirect()->to(site_url('admin/gambar'));
    }

    public function quis() {
        $session = session();
        if (!$session->has('authenticated')) {
            return redirect()->to(site_url('auth'));
        }
        $typeUser = $session->get('type');
        if ($typeUser != 'admin') {
            return redirect()->to(site_url('home'));
        }

        $quisModel = new QuisModel();
        $data_header = [
            'title' => 'Quis',
            'nama' => $session->get('nama')
        ];
        $data = [
            'quis' => $quisModel->getAll()
        ];
        echo view('templates/admin/header', $data_header);
        echo view('admin/quis', $data);
        echo view('templates/admin/footer');
    }

    public function getquisdata() {
        $modelSoal = new SoalModel();

        $kode_quis = $this->request->getVar('kode_quis');
        $resultSoal = $modelSoal->getSoalByKodeQuis($kode_quis);

        return $this->response->setJSON($resultSoal);
    }

    public function savequis() {
        $session = session();
        $modelQuis = new QuisModel();
        $modelSoal = new SoalModel();

        if (!$this->validate([
                    'id_quis' => 'max_length[20]',
                    'kode_quis' => 'required|max_length[20]',
                    'nama_quis' => 'required|max_length[20]',
                    'level' => 'required'
                ])) {

            $session->setflashdata($this->setMessageFlashData('Value quis tidak valid!', 'error'));
            return redirect()->to(site_url('admin/quis'));
        }

        $id_quis = $this->request->getVar('id_quis');
        $kode_quis = $this->request->getVar('kode_quis');
        $nama_quis = $this->request->getVar('nama_quis');
        $level = $this->request->getVar('level');
        $nomor_soal = $this->request->getVar('nomor_soal');
        $soal_di_delete = explode(',', $this->request->getVar('soal_di_delete'));

        $data_quis = [
            'kode_quis' => $kode_quis,
            'nama_quis' => $nama_quis,
            'level' => $level,
            'jumlah_soal' => count($nomor_soal)
        ];

        //Insert Quis
        if (empty($modelQuis->getQuis($id_quis)) && !$modelQuis->insert($data_quis, false)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menambahkan data!', 'error'));
            return redirect()->to(site_url('admin/quis'));
        }

        //Update Quis
        if (!$modelQuis->update($id_quis, $data_quis)) {
            $session->setflashdata($this->setMessageFlashData('Gagal meng-edit data!', 'error'));
            return redirect()->to(site_url('admin/quis'));
        }

        foreach ($nomor_soal as $nomor) {
            if (!$this->validate([
                        'id_soal_' . $nomor => 'max_length[10]',
                        'soal_' . $nomor => 'required|max_length[255]',
                        'jawab_a' . $nomor => 'required|max_length[255]',
                        'jawab_b' . $nomor => 'required|max_length[255]',
                        'jawab_c' . $nomor => 'required|max_length[255]',
                        'jawaban_benar' . $nomor => 'required|max_length[1]'
                    ])) {

                $session->setflashdata($this->setMessageFlashData('Value soal tidak valid!', 'error'));
                return redirect()->to(site_url('admin/quis'));
            }

            $id_soal = $this->request->getVar('id_soal_' . $nomor);
            $soal = $this->request->getVar('soal_' . $nomor);
            $jawab_a = $this->request->getVar('jawab_a' . $nomor);
            $jawab_b = $this->request->getVar('jawab_b' . $nomor);
            $jawab_c = $this->request->getVar('jawab_c' . $nomor);
            $jawaban_benar = $this->request->getVar('jawaban_benar' . $nomor);

            $data_soal = [
                'kode_quis' => $kode_quis,
                'pertanyaan' => $soal,
                'jawaban_a' => $jawab_a,
                'jawaban_b' => $jawab_b,
                'jawaban_c' => $jawab_c,
                'jawaban_benar' => $jawaban_benar
            ];

            //Insert Soal
            if (empty($modelSoal->getSoal($id_soal)) && $modelSoal->insert($data_soal) == 0) {
                $session->setflashdata($this->setMessageFlashData('Gagal menambahkan data!', 'error'));
                return redirect()->to(site_url('admin/quis'));
            }

            //Update Soal
            if (!$modelSoal->update($id_soal, $data_soal)) {
                $session->setflashdata($this->setMessageFlashData('Gagal meng-edit data!', 'error'));
                return redirect()->to(site_url('admin/quis'));
            }
        }

        //Delete Soal
        if (!empty($soal_di_delete) && !$modelSoal->delete($soal_di_delete)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menambahkan data!', 'error'));
            return redirect()->to(site_url('admin/quis'));
        }

        $session->setflashdata($this->setMessageFlashData('Sukses!', 'sukses'));
        return redirect()->to(site_url('admin/quis'));
    }

    public function deletequis($id) {
        $model = new QuisModel();
        $session = session();

        if (!$model->delete($id)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menghapus data!', 'error'));
            return redirect()->to(site_url('admin/quis'));
        }

        $session->setflashdata($this->setMessageFlashData('Sukses!', 'sukses'));
        return redirect()->to(site_url('admin/quis'));
    }

    public function history() {
        $session = session();
        if (!$session->has('authenticated')) {
            return redirect()->to(site_url('auth'));
        }
        $typeUser = $session->get('type');
        if ($typeUser != 'admin') {
            return redirect()->to(site_url('home'));
        }

        $model = new HistoryModel();
        $data_header = [
            'title' => 'History',
            'nama' => $session->get('nama')
        ];
        $data = [
            'history' => $model->getAll()
        ];
        echo view('templates/admin/header', $data_header);
        echo view('admin/history', $data);
        echo view('templates/admin/footer');
    }

    public function deletehistory($id) {
        $model = new HistoryModel();
        $session = session();

        if (!$model->delete($id)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menghapus data!', 'error'));
            return redirect()->to(site_url('admin/history'));
        }

        $session->setflashdata($this->setMessageFlashData('Sukses!', 'sukses'));
        return redirect()->to(site_url('admin/history'));
    }

    public function soal() {
        $session = session();
        if (!$session->has('authenticated')) {
            return redirect()->to(site_url('auth'));
        }
        $typeUser = $session->get('type');
        if ($typeUser != 'admin') {
            return redirect()->to(site_url('home'));
        }

        $model = new SoalModel();
        $data_header = [
            'title' => 'Soal',
            'nama' => $session->get('nama')
        ];
        $data = [
            'soal' => $model->getAll()
        ];
        echo view('templates/admin/header', $data_header);
        echo view('admin/soal', $data);
        echo view('templates/admin/footer');
    }

    public function deletesoal($id) {
        $soalModel = new SoalModel();
        $quisModel = new QuisModel();
        $session = session();

        $kode_quis = $soalModel->getSoal($id)->kode_quis;
        if (!$soalModel->delete($id)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menghapus data!', 'error'));
            return redirect()->to(site_url('admin/soal'));
        }
        $jumlah_soal = count($soalModel->getSoalByKodeQuis($kode_quis));
        $quisModel->update($kode_quis, ['jumlah_soal' => $jumlah_soal]);

        $session->setflashdata($this->setMessageFlashData('Sukses!', 'sukses'));
        return redirect()->to(site_url('admin/soal'));
    }

    //menyetting array flash data berisi message dan status lalu dikirim ke Views untuk diproses sebagai notifikasi
    function setMessageFlashData($message, $status) {
        $data = [
            'message' => $message,
            'status' => $status
        ];
        return $data;
    }

}

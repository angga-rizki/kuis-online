<?php

namespace App\Controllers;

use App\Models\SoalModel;
use App\Models\QuisModel;
use App\Models\AuthModel;
use App\Models\HistoryModel;
use CodeIgniter\Controller;

class Hasil extends Controller {

    public function index() {
        $session = session();
        $soalModel = new SoalModel();
        $quisModel = new QuisModel();
        $historyModel = new HistoryModel();
        $userModel = new AuthModel();

        if (!$session->has('authenticated')) {
            return redirect()->to(site_url('auth'));
        }
        $typeUser = $session->get('type');
        if ($typeUser == 'admin') {
            return redirect()->to(site_url('admin'));
        }

        if (!$this->validate([
                    'nomor' => 'required',
                    'kode_quis' => 'required|max_length[20]'
                ])) {

            $session->setflashdata($this->setMessageFlashData('Form tidak valid!', 'error'));
            return redirect()->to(site_url('hasil'));
        }

        $nomor_soal = $this->request->getVar('nomor');
        $kode_quis = $this->request->getVar('kode_quis');
        $total_soal = count($nomor_soal);

        foreach ($nomor_soal as $nomor) {
            if (!$this->validate([
                        'id_soal' . $nomor => 'required|max_length[10]',
                        'jawaban' . $nomor => 'required|max_length[1]'
                    ])) {

                $session->setflashdata($this->setMessageFlashData('Jawaban yang di-submit tidak valid!', 'error'));
                return redirect()->to(site_url('hasil'));
            }

            $id_soal = $this->request->getVar('id_soal' . $nomor);
            $jawaban = $this->request->getVar('jawaban' . $nomor);

            $data_jawaban[$id_soal] = $jawaban;
        }

        $data_soal = $soalModel->getSoalByKodeQuis($kode_quis);
        foreach ($data_soal as $soal_item) {
            $jawaban_benar[$soal_item->id] = $soal_item->jawaban_benar;
        }

        $score = 0;
        foreach (array_keys($jawaban_benar) as $id_soal) {
            if ($data_jawaban[$id_soal] == $jawaban_benar[$id_soal]) {
                $score++;
            }
        }

        $nilai = round((($score / $total_soal) * 100), 2);

        $data_hasil = [
            'score' => $score,
            'total_soal' => $total_soal,
            'nilai' => $nilai,
            'soal' => $data_soal,
            'jawaban' => $data_jawaban,
            'jawaban_benar' => $jawaban_benar
        ];

        $data_user = $userModel->getUser($session->get('username'));
        $data_header = [
            'title' => 'Hasil',
            'user' => $data_user
        ];

        $quis = $quisModel->getQuis($kode_quis);
        date_default_timezone_set("Asia/Jakarta");
        $data_history = [
            'username' => $session->get('username'),
            'nama_quis' => $quis->nama_quis,
            'level' => $quis->level,
            'tanggal' => date("Y-m-d H:i:s"),
            'hasil' => $nilai
        ];

        if (!$historyModel->insert($data_history)) {
            $session->setflashdata($this->setMessageFlashData('Gagal menambahkan history!', 'error'));
            return redirect()->to(site_url('hasil'));
        }

        echo view('templates/user/header', $data_header);
        echo view('user/hasil', $data_hasil);
        echo view('templates/user/footer');
    }

    function setMessageFlashData($message, $status) {
        $data = [
            'message' => $message,
            'status' => $status
        ];
        return $data;
    }

}

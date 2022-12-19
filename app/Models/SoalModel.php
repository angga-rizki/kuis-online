<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model {

    protected $table = 'soal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_quis', 'pertanyaan', 'jawaban_a', 'jawaban_b', 'jawaban_c', 'jawaban_benar'];

    public function getAll() {
        return $this->asObject()->findAll();
    }
    
    public function getSoal($id) {
        return $this->asObject()
                ->where(['id' => $id])
                ->first();
    }
    
    public function getSoalByKodeQuis($kode_quis) {
        return $this->asObject()
                ->where(['kode_quis' => $kode_quis])
                ->findAll();
    }
}

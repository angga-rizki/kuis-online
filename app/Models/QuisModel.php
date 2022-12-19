<?php

namespace App\Models;

use CodeIgniter\Model;

class QuisModel extends Model {

    protected $table = 'quis';
    protected $primaryKey = 'kode_quis';
    protected $allowedFields = ['kode_quis', 'nama_quis', 'jumlah_soal', 'level'];

    public function getAll() {
        return $this->asObject()->findAll();
    }

    public function getQuisByLevel($level) {
        return $this->asObject()
                        ->where(['level' => $level])
                        ->findAll();
    }

    public function getQuis($kode_quis) {
        return $this->asObject()
                        ->where(['kode_quis' => $kode_quis])
                        ->first();
    }

}

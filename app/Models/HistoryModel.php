<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model {

    protected $table = 'history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'nama_quis', 'level', 'tanggal', 'hasil'];

    public function getAll() {
        return $this->asObject()->findAll();
    }
    
    public function getHistoryByUsername($username) {
        return $this->asObject()
                ->where(['username' => $username])
                ->findAll();
    }
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class GambarModel extends Model {

    protected $table = 'gambar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'deskripsi', 'nama_file', 'ukuran_file', 'tipe_file'];

    public function getAll() {
        return $this->asObject()->findAll();
    }
    
    public function getGambar($id) {
        return $this->asObject()->where(['id' => $id])
                        ->first();
    }
    
    public function getGambarByDeskripsi($deskripsi) {
        return $this->asObject()->where(['deskripsi' => $deskripsi])
                        ->findAll();
    }
}

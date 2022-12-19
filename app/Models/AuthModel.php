<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model {

    protected $table = 'user';
    protected $primaryKey = 'username';
    protected $allowedFields = ['username', 'password', 'nama', 'type', 'level', 'foto'];

    public function getUser($username) {
        return $this->asObject()
                        ->where(['username' => $username])
                        ->first();
    }

    public function getAll() {
        return $this->asObject()->findAll();
    }

    public function getUserByType($type) {
        return $this->asObject()
                        ->where(['type' => $type])
                        ->findAll();
    }
}

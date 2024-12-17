<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\User;
use App\Utils\Session;

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->user = new User($this->db);
    }

    public function login(array $data): bool {
        $this->user->email = $data['email'];
        $this->user->senha = $data['senha'];
        
        $result = $this->user->login();
        
        if($result) {
            Session::set('user_id', $result['id']);
            Session::set('user_name', $result['nome']);
            return true;
        }
        
        return false;
    }

    public function register(array $data): bool {
        $this->user->nome = $data['nome'];
        $this->user->email = $data['email'];
        $this->user->senha = $data['senha'];
        
        return $this->user->create();
    }

    public function logout(): void {
        Session::destroy();
    }
}
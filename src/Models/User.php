<?php
namespace App\Models;

use PDO;

class User {
    private $conn;
    private $table_name = "usuarios";

    public $id;
    public $nome;
    public $email;
    public $senha;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function create(): bool {
        $query = "INSERT INTO " . $this->table_name . " (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->conn->prepare($query);

        $this->senha = md5($this->senha);

        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);

        return $stmt->execute();
    }

    public function login(): array|false {
        $query = "SELECT id, nome, email FROM " . $this->table_name . " WHERE email = :email AND senha = :senha";
        $stmt = $this->conn->prepare($query);

        $this->senha = md5($this->senha);

        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":senha", $this->senha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
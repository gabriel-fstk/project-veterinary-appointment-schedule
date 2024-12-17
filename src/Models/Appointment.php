<?php
namespace App\Models;

use PDO;

class Appointment {
    private $conn;
    private $table_name = "consultas";

    public $id;
    public $id_usuario;
    public $idade;
    public $data;
    public $hora;
    public $motivo;

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function create(): bool {
        $query = "INSERT INTO " . $this->table_name . " 
                 (id_usuario, idade, data, hora, motivo) 
                 VALUES (:id_usuario, :idade, :data, :hora, :motivo)";
        
        return $this->executeStatement($query);
    }

    public function read(): \PDOStatement {
        $query = "SELECT c.*, u.nome FROM " . $this->table_name . " c 
                 LEFT JOIN usuarios u ON c.id_usuario = u.id 
                 ORDER BY c.data, c.hora";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update(): bool {
        $query = "UPDATE " . $this->table_name . " 
                 SET idade = :idade, data = :data, hora = :hora, motivo = :motivo 
                 WHERE id = :id AND id_usuario = :id_usuario";
        
        return $this->executeStatement($query);
    }

    public function delete(): bool {
        $query = "DELETE FROM " . $this->table_name . " 
                 WHERE id = :id AND id_usuario = :id_usuario";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        return $stmt->execute();
    }

    public function readOne(): array|false {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function executeStatement(string $query): bool {
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":idade", $this->idade);
        $stmt->bindParam(":data", $this->data);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":motivo", $this->motivo);

        if (isset($this->id)) {
            $stmt->bindParam(":id", $this->id);
        }

        return $stmt->execute();
    }
}
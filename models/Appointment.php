<?php
class Appointment {
    private $conn;
    private $table_name = "consultas";

    public $id;
    public $id_usuario;
    public $idade;
    public $data;
    public $hora;
    public $motivo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (id_usuario, idade, data, hora, motivo) VALUES (:id_usuario, :idade, :data, :hora, :motivo)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":idade", $this->idade);
        $stmt->bindParam(":data", $this->data);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":motivo", $this->motivo);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT c.*, u.nome FROM " . $this->table_name . " c 
                 LEFT JOIN usuarios u ON c.id_usuario = u.id 
                 ORDER BY c.data, c.hora";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET idade = :idade, data = :data, hora = :hora, motivo = :motivo 
                 WHERE id = :id AND id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":idade", $this->idade);
        $stmt->bindParam(":data", $this->data);
        $stmt->bindParam(":hora", $this->hora);
        $stmt->bindParam(":motivo", $this->motivo);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id AND id_usuario = :id_usuario";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":id_usuario", $this->id_usuario);

        return $stmt->execute();
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
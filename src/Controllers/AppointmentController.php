<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\Appointment;
use App\Utils\Session;

class AppointmentController {
    private $db;
    private $appointment;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->appointment = new Appointment($this->db);
    }

    public function getAllAppointments(): \PDOStatement {
        return $this->appointment->read();
    }

    public function getAppointment(int $id): array|false {
        $this->appointment->id = $id;
        return $this->appointment->readOne();
    }

    public function createAppointment(array $data): bool {
        $this->setAppointmentData($data);
        return $this->appointment->create();
    }

    public function updateAppointment(array $data): bool {
        $this->setAppointmentData($data);
        $this->appointment->id = $data['id'];
        return $this->appointment->update();
    }

    public function deleteAppointment(int $id): bool {
        $this->appointment->id = $id;
        $this->appointment->id_usuario = Session::get('user_id');
        return $this->appointment->delete();
    }

    private function setAppointmentData(array $data): void {
        $this->appointment->id_usuario = Session::get('user_id');
        $this->appointment->idade = $data['idade'];
        $this->appointment->data = $data['data'];
        $this->appointment->hora = $data['hora'];
        $this->appointment->motivo = $data['motivo'];
    }
}
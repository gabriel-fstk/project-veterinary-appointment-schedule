<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Utils\Session;
use App\Controllers\AppointmentController;

header('Content-Type: application/json');

if (!Session::isLoggedIn()) {
    echo json_encode(['success' => false]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $appointmentController = new AppointmentController();
    $success = $appointmentController->deleteAppointment($_POST['id']);
    
    echo json_encode(['success' => $success]);
    exit();
}

echo json_encode(['success' => false]);
exit();
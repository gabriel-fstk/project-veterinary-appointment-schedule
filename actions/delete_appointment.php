<?php
session_start();
header('Content-Type: application/json');

if(!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false]);
    exit();
}

require_once '../config/database.php';
require_once '../models/Appointment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $database = new Database();
    $db = $database->getConnection();
    
    $appointment = new Appointment($db);
    $appointment->id = $_POST['id'];
    $appointment->id_usuario = $_SESSION['user_id'];
    
    if($appointment->delete()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
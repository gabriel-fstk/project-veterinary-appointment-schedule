<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../config/database.php';
require_once '../models/Appointment.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $appointment = new Appointment($db);
    $appointment->id_usuario = $_SESSION['user_id'];
    $appointment->idade = $_POST['idade'];
    $appointment->data = $_POST['data'];
    $appointment->hora = $_POST['hora'];
    $appointment->motivo = $_POST['motivo'];
    
    if(isset($_POST['id'])) {
        $appointment->id = $_POST['id'];
        $success = $appointment->update();
    } else {
        $success = $appointment->create();
    }
    
    if($success) {
        header("Location: ../dashboard.php?success=1");
    } else {
        header("Location: ../appointment_form.php?error=1");
    }
    exit();
} else {
    header("Location: ../dashboard.php");
    exit();
}
?>
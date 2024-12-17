<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Utils\Session;
use App\Controllers\AppointmentController;
use App\Utils\Validator;

if (!Session::isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = Validator::validateAppointment($_POST);
    
    if (empty($errors)) {
        $appointmentController = new AppointmentController();
        
        $success = isset($_POST['id']) 
            ? $appointmentController->updateAppointment($_POST)
            : $appointmentController->createAppointment($_POST);
        
        if ($success) {
            header("Location: ../dashboard.php?success=1");
            exit();
        }
    }
    
    header("Location: ../appointment_form.php?error=1");
    exit();
}

header("Location: ../dashboard.php");
exit();
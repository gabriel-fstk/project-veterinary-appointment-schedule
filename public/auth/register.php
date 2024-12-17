<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Utils\Validator;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = Validator::validateUser($_POST);
    
    if (empty($errors)) {
        $authController = new AuthController();
        
        if ($authController->register($_POST)) {
            header("Location: ../index.php?success=1");
            exit();
        }
    }
    
    header("Location: ../register.php?error=1");
    exit();
}

header("Location: ../register.php");
exit();
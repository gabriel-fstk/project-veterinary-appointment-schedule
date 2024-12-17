<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $user = new User($db);
    $user->email = $_POST['email'];
    $user->senha = $_POST['senha'];
    
    $result = $user->login();
    
    if($result) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['user_name'] = $result['nome'];
        header("Location: ../dashboard.php");
    } else {
        header("Location: ../index.php?error=1");
    }
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>
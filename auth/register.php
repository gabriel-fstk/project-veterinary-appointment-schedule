<?php
session_start();
require_once '../config/database.php';
require_once '../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    
    $user = new User($db);
    $user->nome = $_POST['nome'];
    $user->email = $_POST['email'];
    $user->senha = $_POST['senha'];
    
    if($user->create()) {
        header("Location: ../index.php?success=1");
    } else {
        header("Location: ../register.php?error=1");
    }
    exit();
} else {
    header("Location: ../register.php");
    exit();
}
?>
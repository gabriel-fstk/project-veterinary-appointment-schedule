<?php
namespace App\Utils;

class Validator {
    public static function validateAppointment(array $data): array {
        $errors = [];
        
        if (empty($data['idade']) || !is_numeric($data['idade'])) {
            $errors[] = "Idade inválida";
        }
        
        if (empty($data['data'])) {
            $errors[] = "Data é obrigatória";
        }
        
        if (empty($data['hora'])) {
            $errors[] = "Hora é obrigatória";
        }
        
        if (empty($data['motivo'])) {
            $errors[] = "Motivo é obrigatório";
        }
        
        return $errors;
    }

    public static function validateUser(array $data): array {
        $errors = [];
        
        if (empty($data['nome'])) {
            $errors[] = "Nome é obrigatório";
        }
        
        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email inválido";
        }
        
        if (empty($data['senha']) || strlen($data['senha']) < 6) {
            $errors[] = "Senha deve ter no mínimo 6 caracteres";
        }
        
        return $errors;
    }
}
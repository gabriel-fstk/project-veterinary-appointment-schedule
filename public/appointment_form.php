<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Utils\Session;
use App\Controllers\AppointmentController;

if (!Session::isLoggedIn()) {
    header("Location: index.php");
    exit();
}

$appointmentController = new AppointmentController();
$data = null;

if (isset($_GET['id'])) {
    $data = $appointmentController->getAppointment($_GET['id']);
    
    if (!$data || $data['id_usuario'] != Session::get('user_id')) {
        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($_GET['id']) ? 'Editar' : 'Nova'; ?> Consulta - Sistema Veterinário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center"><?php echo isset($_GET['id']) ? 'Editar' : 'Nova'; ?> Consulta</h3>
                    </div>
                    <div class="card-body">
                        <?php if(isset($_GET['error'])): ?>
                            <div class="alert alert-danger">Erro ao salvar consulta. Verifique os dados e tente novamente.</div>
                        <?php endif; ?>
                        
                        <form action="auth/save_appointment.php" method="POST">
                            <?php if(isset($_GET['id'])): ?>
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                            <?php endif; ?>
                            
                            <div class="mb-3">
                                <label for="idade" class="form-label">Idade do Animal</label>
                                <input type="number" class="form-control" id="idade" name="idade" required
                                       value="<?php echo $data ? $data['idade'] : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="data" class="form-label">Data</label>
                                <input type="date" class="form-control" id="data" name="data" required
                                       value="<?php echo $data ? $data['data'] : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="hora" class="form-label">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora" required
                                       value="<?php echo $data ? $data['hora'] : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="motivo" class="form-label">Motivo da Consulta</label>
                                <textarea class="form-control" id="motivo" name="motivo" rows="3" required><?php echo $data ? $data['motivo'] : ''; ?></textarea>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
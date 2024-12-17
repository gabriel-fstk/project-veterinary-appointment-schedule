<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'config/database.php';
require_once 'models/Appointment.php';

$database = new Database();
$db = $database->getConnection();

$appointment = new Appointment($db);
$data = null;

if(isset($_GET['id'])) {
    $appointment->id = $_GET['id'];
    $data = $appointment->readOne();
    
    if($data['id_usuario'] != $_SESSION['user_id']) {
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
                        <form action="actions/save_appointment.php" method="POST">
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
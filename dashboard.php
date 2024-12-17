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
$result = $appointment->read();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema Veterinário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema Veterinário</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="auth/logout.php">Sair</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Consultas Agendadas</h2>
            <a href="appointment_form.php" class="btn btn-success">Nova Consulta</a>
        </div>

        <?php if($result->rowCount() > 0): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th>Idade</th>
                            <th>Data</th>
                            <th>Hora</th>
                            <th>Motivo</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nome']); ?></td>
                                <td><?php echo htmlspecialchars($row['idade']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['data'])); ?></td>
                                <td><?php echo $row['hora']; ?></td>
                                <td><?php echo htmlspecialchars($row['motivo']); ?></td>
                                <td>
                                    <?php if($row['id_usuario'] == $_SESSION['user_id']): ?>
                                        <a href="appointment_form.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                                        <a href="javascript:void(0);" onclick="deleteAppointment(<?php echo $row['id']; ?>)" class="btn btn-sm btn-danger">Excluir</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                Não há consultas marcadas.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function deleteAppointment(id) {
        if(confirm('Tem certeza que deseja excluir esta consulta?')) {
            $.ajax({
                url: 'actions/delete_appointment.php',
                type: 'POST',
                data: {id: id},
                success: function(response) {
                    if(response.success) {
                        location.reload();
                    } else {
                        alert('Erro ao excluir consulta.');
                    }
                },
                error: function() {
                    alert('Erro ao excluir consulta.');
                }
            });
        }
    }
    </script>
</body>
</html>
<?php
// Iniciar sesión y conexión con la base de datos
session_start();
include __DIR__ . '/../plantillas/header_admin.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "perfect_vides";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Cambiar estado del mensaje si se hace clic en el botón
if (isset($_POST['cambiar_estado'])) {
    $mensaje_id = $_POST['mensaje_id'];
    $nuevo_estado = $_POST['estado'] === 'pendiente' ? 'leido' : 'pendiente';

    $stmt = $conn->prepare("UPDATE mensajes SET estado = ? WHERE id = ?");
    $stmt->bind_param("si", $nuevo_estado, $mensaje_id);
    $stmt->execute();
    $stmt->close();
}

// Obtener todos los mensajes
$result = $conn->query("SELECT * FROM mensajes ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes - Administrador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Mensajes de Clientes</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                        <td>
                            <span class="badge bg-<?php echo $row['estado'] == 'pendiente' ? 'warning' : 'success'; ?>">
                                <?php echo ucfirst($row['estado']); ?>
                            </span>
                        </td>
                        <td>
                            <!-- Botón para cambiar el estado -->
                            <form action="mensajes.php" method="post" style="display:inline;">
                                <input type="hidden" name="mensaje_id" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="estado" value="<?php echo $row['estado']; ?>">
                                <button type="submit" name="cambiar_estado" class="btn btn-sm btn-<?php echo $row['estado'] == 'pendiente' ? 'success' : 'warning'; ?>">
                                    <?php echo $row['estado'] == 'pendiente' ? 'Marcar como Leído' : 'Marcar como Pendiente'; ?>
                                </button>
                            </form>
                            <!-- Botón para ver el mensaje completo -->
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#mensajeModal<?php echo $row['id']; ?>">
                                Ver Mensaje
                            </button>

                            <!-- Modal para mostrar el mensaje completo -->
                            <div class="modal fade" id="mensajeModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="mensajeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="mensajeModalLabel">Mensaje de <?php echo htmlspecialchars($row['nombre']); ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo nl2br(htmlspecialchars($row['mensaje'])); ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Cerrar la conexión
$conn->close();
include __DIR__ . '/../plantillas/footer.php';
?>

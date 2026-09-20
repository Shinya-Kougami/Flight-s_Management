<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para ver tus reservas.'); window.location.href='index.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Lógica para eliminar la reserva si se envió la solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'delete') {
    $reserva_id = $_POST['reserva_id'];
    $stmt_delete = $pdo->prepare("DELETE FROM Reservations WHERE id = ? AND user_id = ?");
    if($stmt_delete->execute([$reserva_id, $user_id])) {
        echo "<script>alert('Reserva cancelada con éxito.'); window.location.href='manage_reservations.php';</script>";
        exit;
    } else {
        echo "<script>alert('Hubo un error al cancelar la reserva.');</script>";
    }
}

// Obtener las reservas actualizadas
$sql = "SELECT r.id as reserva_id, r.fecha_reserva, f.origen, f.destino, f.fecha_salida, f.precio
        FROM Reservations r
        JOIN Flights f ON r.flight_id = f.id
        WHERE r.user_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$reservas = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AETHER | Mis Reservas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="padding-top: 100px;">
    <nav>
        <a href="index.php" class="logo">AETHER</a>
        <div class="nav-links">
            <a href="index.php" class="btn-login" style="border: none;">NUEVA BÚSQUEDA</a>
            <a href="#" class="btn-login" style="border: none; color: var(--gold);">HOLA, <?= htmlspecialchars($_SESSION['user_name']) ?></a>
        </div>
    </nav>

    <div class="results-container">
        <h2 style="color: var(--gold); margin-bottom: 20px; font-family: 'Cinzel', serif;">Mi Historial de Vuelos</h2>

        <?php if (count($reservas) > 0): ?>
            <table style="width: 100%; border-collapse: collapse; background: var(--glass-bg); text-align: left;">
                <tr style="border-bottom: 2px solid var(--gold);">
                    <th style="padding: 15px;">ID Reserva</th>
                    <th style="padding: 15px;">Origen</th>
                    <th style="padding: 15px;">Destino</th>
                    <th style="padding: 15px;">Fecha de Vuelo</th>
                    <th style="padding: 15px;">Precio Pagado</th>
                    <th style="padding: 15px;">Acción</th>
                </tr>
                <?php foreach ($reservas as $reserva): ?>
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 15px;">#<?= htmlspecialchars($reserva['reserva_id']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($reserva['origen']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($reserva['destino']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($reserva['fecha_salida']) ?></td>
                    <td style="padding: 15px; color: var(--gold); font-weight: bold;">$<?= htmlspecialchars($reserva['precio']) ?></td>
                    <td style="padding: 15px;">
                        <form method="POST" style="margin: 0;" onsubmit="return confirm('¿Estás seguro de que deseas cancelar esta reserva de vuelo? Esta acción no se puede deshacer.');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="reserva_id" value="<?= $reserva['reserva_id'] ?>">
                            <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 8px 15px; cursor: pointer; border-radius: 5px; font-weight: bold; font-size: 12px; text-transform: uppercase;">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p style="text-align: center; font-size: 1.2rem; margin-top: 40px;">Aún no tienes vuelos reservados.</p>
        <?php endif; ?>
    </div>
</body>
</html>
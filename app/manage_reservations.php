<?php
session_start();
require 'db.php';

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para ver tus reservas.'); window.location.href='login.html';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// Consulta SQL con JOIN para obtener los datos de la reserva y del vuelo
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
        <a href="search.html" class="logo">AETHER</a>
        <div class="nav-links">
            <a href="search.html" class="btn-login" style="border: none;">NUEVA BÚSQUEDA</a>
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
                    <th style="padding: 15px;">Fecha de Compra</th>
                    <th style="padding: 15px;">Precio Pagado</th>
                </tr>
                <?php foreach ($reservas as $reserva): ?>
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 15px;">#<?= htmlspecialchars($reserva['reserva_id']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($reserva['origen']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($reserva['destino']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($reserva['fecha_salida']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($reserva['fecha_reserva']) ?></td>
                    <td style="padding: 15px; color: var(--gold); font-weight: bold;">$<?= htmlspecialchars($reserva['precio']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p style="text-align: center; font-size: 1.2rem; margin-top: 40px;">Aún no tienes vuelos reservados.</p>
        <?php endif; ?>
    </div>
</body>
</html>
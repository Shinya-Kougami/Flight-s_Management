<?php
session_start();
require 'db.php';

// Redirigir si no hay sesión activa
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para buscar y reservar vuelos.'); window.location.href='login.html';</script>";
    exit;
}

$origen = $_GET['origen'] ?? '';
$destino = $_GET['destino'] ?? '';
$fecha = $_GET['fecha'] ?? '';

// Preparar la consulta SQL
$sql = "SELECT * FROM Flights WHERE origen LIKE ? AND destino LIKE ?";
$params = ["%$origen%", "%$destino%"];

if (!empty($fecha)) {
    $sql .= " AND DATE(fecha_salida) = ?";
    $params[] = $fecha;
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$vuelos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AETHER | Resultados de Búsqueda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body style="padding-top: 100px;">
    <nav>
        <a href="search.html" class="logo">AETHER</a>
        <a href="#" class="btn-login" style="border: none; color: var(--gold);">HOLA, <?= htmlspecialchars($_SESSION['user_name']) ?></a>
    </nav>

    <div class="results-container">
        <h2 style="color: var(--gold); margin-bottom: 20px; font-family: 'Cinzel', serif;">Vuelos Encontrados</h2>
        
        <?php if (count($vuelos) > 0): ?>
            <table style="width: 100%; border-collapse: collapse; background: var(--glass-bg); text-align: left;">
                <tr style="border-bottom: 2px solid var(--gold);">
                    <th style="padding: 15px;">Origen</th>
                    <th style="padding: 15px;">Destino</th>
                    <th style="padding: 15px;">Fecha y Hora</th>
                    <th style="padding: 15px;">Precio</th>
                    <th style="padding: 15px;">Acción</th>
                </tr>
                <?php foreach ($vuelos as $vuelo): ?>
                <tr style="border-bottom: 1px solid var(--border-color);">
                    <td style="padding: 15px;"><?= htmlspecialchars($vuelo['origen']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($vuelo['destino']) ?></td>
                    <td style="padding: 15px;"><?= htmlspecialchars($vuelo['fecha_salida']) ?></td>
                    <td style="padding: 15px;">$<?= htmlspecialchars($vuelo['precio']) ?></td>
                    <td style="padding: 15px;">
                        <!-- Formulario para enviar la reserva -->
                        <form action="reserve_flight.php" method="POST" style="margin: 0;">
                            <input type="hidden" name="flight_id" value="<?= $vuelo['id'] ?>">
                            <button type="submit" class="btn-search" style="padding: 8px 15px; margin: 0; font-size: 12px;">Reservar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p style="text-align: center; font-size: 1.2rem; margin-top: 40px;">No se encontraron vuelos para esta ruta. Por favor intenta con otra búsqueda.</p>
        <?php endif; ?>
    </div>
</body>
</html>
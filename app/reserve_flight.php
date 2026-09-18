<?php
session_start();
require 'db.php';

// Verificar seguridad
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Debes iniciar sesión para reservar un vuelo.'); window.location.href='login.html';</script>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $flight_id = $_POST['flight_id'];

    $stmt = $pdo->prepare("INSERT INTO Reservations (user_id, flight_id) VALUES (?, ?)");
    
    try {
        $stmt->execute([$user_id, $flight_id]);
        echo "<script>alert('¡Vuelo reservado con éxito!'); window.location.href='manage_reservations.php';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Hubo un problema al procesar tu reserva. Intenta nuevamente.'); window.history.back();</script>";
    }
}
?>
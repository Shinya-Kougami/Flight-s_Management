<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';

    if ($action === 'register') {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO Users (nombre, email, password) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$nombre, $email, $password]);
            echo "<script>alert('Registro exitoso. Por favor, inicia sesión.'); window.location.href='login.html';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: El email ya está registrado.'); window.history.back();</script>";
        }
    } elseif ($action === 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT id, nombre, password FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];
            echo "<script>alert('Bienvenido " . $user['nombre'] . "'); window.location.href='search.html';</script>";
        } else {
            echo "<script>alert('Credenciales incorrectas'); window.history.back();</script>";
        }
    }
}
?>
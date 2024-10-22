<?php
session_start();

// Asegúrate de que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

// Devuelve el carrito guardado en la sesión
echo json_encode($_SESSION['carrito'] ?? []);
?>
<?php
session_start();

if (!isset($_SESSION['idusuario'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

$carrito = json_decode(file_get_contents('php://input'), true);

$_SESSION['carrito'] = $carrito;

echo json_encode(['success' => true]);
?>
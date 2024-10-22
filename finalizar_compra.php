<?php
session_start();
require 'bd.php';

if (!isset($_SESSION['idusuario'])) {
    echo "Sesión no iniciada.";
    exit();
}

$idusuario = $_SESSION['idusuario'];

$data = json_decode(file_get_contents('php://input'), true);
$carrito = $data['carrito'];

if (empty($carrito)) {
    echo "El carrito está vacío.";
    exit();
}

mysqli_begin_transaction($conn);

try {
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    $sqlCompra = "INSERT INTO compras (idusuario, fecha, total) VALUES (?, NOW(), ?)";
    $stmtCompra = mysqli_prepare($conn, $sqlCompra);
    mysqli_stmt_bind_param($stmtCompra, "id", $idusuario, $total);
    mysqli_stmt_execute($stmtCompra);
    $idcompra = mysqli_insert_id($conn);

    $sqlDetalle = "INSERT INTO detalle_compra (idcompra, idproducto, cantidad, precio) VALUES (?, ?, ?, ?)";
    $stmtDetalle = mysqli_prepare($conn, $sqlDetalle);

    foreach ($carrito as $item) {
        mysqli_stmt_bind_param($stmtDetalle, "iiid", $idcompra, $item['idproductos'], $item['cantidad'], $item['precio']);
        mysqli_stmt_execute($stmtDetalle);
    }

    mysqli_commit($conn);
    echo "Compra registrada con éxito.";
} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error al registrar la compra: " . $e->getMessage();
}

mysqli_close($conn);
?>
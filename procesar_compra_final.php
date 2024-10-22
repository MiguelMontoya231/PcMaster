<?php
session_start();
require 'bd.php';

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (!isset($_SESSION['idusuario'])) {
    echo "Sesión no iniciada.";
    exit();
}

$idusuario = $_SESSION['idusuario'];
$idmetodo_de_pago = $_POST['metodoPago'];
$direccion = $_POST['direccion'];
$carrito = json_decode($_POST['carrito'], true);

if (empty($carrito)) {
    echo "El carrito está vacío.";
    exit();
}

mysqli_begin_transaction($conn);

try {
    // Insertar método de pago
    $sqlMetodoPago = "INSERT INTO metodos_de_pago (idmetodo_de_pago, direccion) VALUES (?, ?)";
    $stmtMetodoPago = mysqli_prepare($conn, $sqlMetodoPago);
    if (!$stmtMetodoPago) {
        throw new Exception("Error en la preparación de la sentencia de método de pago: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmtMetodoPago, "is", $idmetodo_de_pago, $direccion);
    if (!mysqli_stmt_execute($stmtMetodoPago)) {
        throw new Exception("Error al ejecutar la sentencia de método de pago: " . mysqli_stmt_error($stmtMetodoPago));
    }
    $idMetodoPagoInsertado = mysqli_insert_id($conn);
    mysqli_stmt_close($stmtMetodoPago);

    // Verificar que el método de pago se insertó correctamente
    $sqlVerificarMetodo = "SELECT * FROM metodos_de_pago WHERE idmetodo_de_pago = ?";
    $stmtVerificarMetodo = mysqli_prepare($conn, $sqlVerificarMetodo);
    if (!$stmtVerificarMetodo) {
        throw new Exception("Error en la preparación de la sentencia de verificación de método de pago: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmtVerificarMetodo, "i", $idMetodoPagoInsertado);
    if (!mysqli_stmt_execute($stmtVerificarMetodo)) {
        throw new Exception("Error al ejecutar la sentencia de verificación de método de pago: " . mysqli_stmt_error($stmtVerificarMetodo));
    }
    $resultVerificarMetodo = mysqli_stmt_get_result($stmtVerificarMetodo);
    if (!$resultVerificarMetodo || mysqli_num_rows($resultVerificarMetodo) == 0) {
        throw new Exception("Error: No se encontró el método de pago insertado.");
    }
    mysqli_stmt_close($stmtVerificarMetodo);

    // Calcular total
    $total = 0;
    foreach ($carrito as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // Insertar compra
    $sqlCompra = "INSERT INTO compras (idusuario, idmetodo_de_pago, fecha, total) VALUES (?, ?, NOW(), ?)";
    $stmtCompra = mysqli_prepare($conn, $sqlCompra);
    if (!$stmtCompra) {
        throw new Exception("Error en la preparación de la sentencia de compra: " . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmtCompra, "iid", $idusuario, $idMetodoPagoInsertado, $total);
    if (!mysqli_stmt_execute($stmtCompra)) {
        throw new Exception("Error al ejecutar la sentencia de compra: " . mysqli_stmt_error($stmtCompra));
    }
    $idCompra = mysqli_insert_id($conn);
    mysqli_stmt_close($stmtCompra);

    // Insertar detalles de compra
    $sqlDetalle = "INSERT INTO detalle_compra (idcompra, idproducto, cantidad, precio) VALUES (?, ?, ?, ?)";
    $stmtDetalle = mysqli_prepare($conn, $sqlDetalle);
    if (!$stmtDetalle) {
        throw new Exception("Error en la preparación de la sentencia de detalle de compra: " . mysqli_error($conn));
    }

    foreach ($carrito as $item) {
        mysqli_stmt_bind_param($stmtDetalle, "iiid", $idCompra, $item['idproductos'], $item['cantidad'], $item['precio']);
        if (!mysqli_stmt_execute($stmtDetalle)) {
            throw new Exception("Error al ejecutar la sentencia de detalle de compra: " . mysqli_stmt_error($stmtDetalle));
        }
    }
    mysqli_stmt_close($stmtDetalle);

    mysqli_commit($conn);
    echo "Compra registrada con éxito.";

} catch (Exception $e) {
    mysqli_rollback($conn);
    echo "Error al registrar la compra: " . $e->getMessage();
}

mysqli_close($conn);
?>

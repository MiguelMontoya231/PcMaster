<?php
session_start();
require 'bd.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.html");
    exit();
}

// Obtener el carrito de la solicitud POST
$carrito = json_decode($_POST['carrito'], true);

// Verifica que el carrito no esté vacío
if (empty($carrito)) {
    echo "El carrito está vacío.";
    exit();
}

// Aquí puedes agregar tu lógica para registrar la compra y los detalles de compra en la base de datos
// Usar el correo del usuario para registrar la compra
$email_usuario = $_SESSION['email'];

// Inserta la compra en la base de datos
$sqlCompra = "INSERT INTO compras (email_usuario, fecha) VALUES ('$email_usuario', NOW())";
if (mysqli_query($conn, $sqlCompra)) {
    $idCompra = mysqli_insert_id($conn);

    // Inserta los detalles de la compra en la base de datos
    foreach ($carrito as $item) {
        $idProducto = $item['idproductos'];
        $cantidad = $item['cantidad'];
        $precio = $item['precio'];

        $sqlDetalle = "INSERT INTO detalles_compra (id_compra, id_producto, cantidad, precio) VALUES ('$idCompra', '$idProducto', '$cantidad', '$precio')";
        mysqli_query($conn, $sqlDetalle);
    }

    echo "Compra registrada con éxito.";
} else {
    echo "Error al registrar la compra: " . mysqli_error($conn);
}
?>

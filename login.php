<?php
// Mostrar todos los errores para depurar
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include 'bd.php'; // Archivo de conexión a la base de datos

echo "Inicio de sesión..."; // Mensaje de depuración

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    echo "Recibidos email y contraseña."; // Otro mensaje de depuración

    $sql = "SELECT idusuario, nombre, contrasena, rol FROM usuarios WHERE email = ? AND estado = 'activo'";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "Consulta ejecutada."; // Mensaje de depuración

        if ($result->num_rows == 1) {
            $usuario = $result->fetch_assoc();
            if ($contrasena === $usuario['contrasena']) {
                $_SESSION['idusuario'] = $usuario['idusuario'];
                $_SESSION['nombre'] = $usuario['nombre'];
                $_SESSION['rol'] = $usuario['rol'];

                echo "Inicio de sesión exitoso."; // Otro mensaje de depuración

                // Redirigir a la página de bienvenida
                header("Location: index.php");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "No se encontró un usuario con ese correo electrónico o la cuenta está inactiva.";
        }

        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>

<?php
require 'bd.php';
session_start();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) && !empty($_POST['contrasena'])) {
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $contrasena = mysqli_real_escape_string($conn, $_POST['contrasena']);
        $rol = 'cliente';
        $estado = 'activo';

        // Verificar si el correo electrónico ya existe
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($conn, $sql);

        if (!$resultado) {
            die('Error en la consulta: ' . mysqli_error($conn));
        }

        if (mysqli_num_rows($resultado) == 0) {
            // Insertar el nuevo usuario
            $sql1 = "INSERT INTO usuarios (nombre, apellido, email, contrasena, rol, estado) VALUES ('$nombre', '$apellido', '$email', '$contrasena', '$rol', '$estado')";
            if (mysqli_query($conn, $sql1)) {
                $message = 'Se ha registrado correctamente';
                echo $message;
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="3;URL=index.html">';
                exit();
            } else {
                $message = '<h1 style="text-align:center">Lo sentimos, hubo un error en el registro: ' . mysqli_error($conn) . '</h1>';
            }
        } else {
            $message = '<h1 style="text-align:center">El correo que ingresaste ya existe</h1>';
        }
        echo $message;
    } else {
        $message = '<h1 style="text-align:center">Por favor, completa todos los campos del formulario</h1>';
        echo $message;
    }
}
?>

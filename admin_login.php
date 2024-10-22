<?php
session_start();
include 'conexion.php'; // Asegúrate de tener el archivo de conexión a la base de datos

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

  
    $sql = "SELECT * FROM administradores WHERE nombre_usuario = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña usando password_verify()
        if (password_verify($password, $row['contraseña'])) {
            // Si la verificación es exitosa, crear la sesión
            $_SESSION['admin_logged_in'] = true;
            header('Location: admin_panel.php');
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Administrador</title>
</head>
<body>
    <h2>Iniciar sesión como administrador</h2>
    <form method="POST" action="admin_login.php">
        <label for="username">Usuario:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" name="login" value="Iniciar Sesión">
    </form>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
</body>
</html>

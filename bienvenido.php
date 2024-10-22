<?php
session_start();
if (!isset($_SESSION['idusuario'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - PC Masters</title>
    <link rel="stylesheet" href="styles.css">
    <script src="carrito.js"></script>
</head>
<body>
    <header>
        <h1>PC Masters</h1>
        <div class="auth-buttons">
            <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
            <a href="logout.php" class="button">Cerrar Sesión</a>
        </div>
    </header>

    <nav>
        <a href="index.php">Inicio</a>
        <a href="carrito.php">Carrito</a>
        <a href="computadores.php">Computadores</a>
        <a href="componentes.php">Componentes</a>
        <a href="contactos.php">Contactos</a>
    </nav>

    <main>
        <section class="welcome">
            <h2>Bienvenido a PC Masters</h2>
            <p>Gracias por iniciar sesión. Aquí puedes ver tus productos favoritos y realizar compras.</p>
        </section>
    </main>
</body>
</html>
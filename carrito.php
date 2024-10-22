<?php
session_start();
$loggedIn = isset($_SESSION['idusuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - PC Masters</title>
    <link rel="stylesheet" href="carrito.css">
    <script src="carrito.js"></script>
</head>
<body>

    <header>
        <h1>PC Masters</h1>
        <div class="auth-buttons">
            <?php if ($loggedIn): ?>
                <span>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></span>
                <a href="logout.php" class="button">Cerrar Sesión</a>
            <?php else: ?>
                <a href="registrarse.php" class="button">Registrarse</a>
                <a href="login.php" class="button">Iniciar Sesión</a>
            <?php endif; ?>
        </div>
    </header>

<nav>
    <a href="index.php">Inicio</a>
    <a href="carrito.php" class="active">Carrito</a>
    <a href="computadores.php">Computadores</a>
    <a href="componentes.php">Componentes</a>
    <a href="contactos.php">Contactos</a>
</nav>

<main>
    <section class="section">
        <h2>Carrito de Compras</h2>
        <div class="cart">
                <button class="checkout-button">Finalizar Compra</button>
            </div>
        </div>
    </section>
</main>
</body>
</html>

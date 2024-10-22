<?php
session_start();
$loggedIn = isset($_SESSION['idusuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos - PC Masters</title>
    <link rel="stylesheet" href="contactos.css">
    <script src="scripts.js" defer></script>
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
        <h2>Contacto</h2>
        <div class="contact-form">
            <form action="#" method="post">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit">Enviar</button>
            </form>
        </div>
        <div class="contact-info">
            <h2>Información de Contacto</h2>
            <p><strong>Dirección:</strong> Calle 7 #23-1 Cali Valle</p>
            <p><strong>Teléfono:</strong> +57 316 6954241</p>
            <p><strong>Email:</strong> fanster231@gmail.com</p>
            <div class="social-media">
                <h3>Síguenos en nuestras redes sociales</h3>
                <a href="#"><img src="SocialMedia/facebook-icon.png" alt="Facebook"></a>
                <a href="#"><img src="SocialMedia/twitter-icon.png" alt="Twitter"></a>
                <a href="#"><img src="SocialMedia/instagram-icon.png" alt="Instagram"></a>
            </div>
        </div>
    </section>
</main>

</body>
</html>

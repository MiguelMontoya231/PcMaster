<?php
session_start();
$loggedIn = isset($_SESSION['idusuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC Masters</title>
    <link rel="stylesheet" href="styles.css">
    <script src="carrito.js"></script>
    <style>
        .user-info {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 14px;
        }
        
        .admin-panel {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: right;
        }
    </style>
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
        <a href="carrito.php">Carrito</a>
        <a href="computadores.php">Computadores</a>
        <a href="componentes.php">Componentes</a>
        <a href="contactos.php">Contactos</a>
    </nav>

    <main>
        <!-- Nueva sección para administradores -->
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin'): ?>
            <div class="admin-panel">
                <a href="agregar_producto.php" class="button">Agregar Producto</a>
            </div>
        <?php endif; ?>

        <h2 class="catalog-title">Productos Destacados</h2>
        <div class="catalog">
            <div class="product">
                <h2>PC PREDATOR</h2>
                <img src="Catalogo-index/pc1.png" alt="PC Gamer 1">
                <p>Intel core i9, RTX 4090, 2TB SSD, 64 RAM.</p>
                <p>$17,390.000 COP</p>
                <a href="carrito.php" class="button">Agregar al carrito</a>
            </div>
            <div class="product">
                <h2>Portatil MSI </h2>
                <img src="Catalogo-index/pc2.png" alt="PC Gamer 2">
                <p>Pantalla 15.6" intel core i5, SSD 512 GB, RTX 2060.</p>
                <p>$5,490.000 COP</p>
                <a href="carrito.php" class="button">Agregar al carrito</a>
            </div>
            <div class="product">
                <h2>Portatil Asus ROG Strix G15</h2>
                <img src="Catalogo-index/pc3.png" alt="PC Gamer 3">
                <p>Descripción breve del PC Gamer 3.</p>
                <p>$8,990.000 COP</p>
                <a href="carrito.php" class="button">Agregar al carrito</a>
            </div>
        </div>

        <div class="testimonials">
            <h2>Lo que dicen nuestros clientes</h2>
            <div class="testimonial">
                <p>"El producto vino en perfectas condiciones y la entrega fue muy rapida, excelente tienda."</p>
                <p>- Nelson Holguin</p>
            </div>
            <div class="testimonial">
                <p>"La mejor tienda para comprar computadores de alta calidad."</p>
                <p>- Jero Rivera</p>
            </div>
        </div>

        <div class="benefits">
            <h2>¿Por qué elegirnos?</h2>
            <ul>
                <li><img src="benefits images/support-icon.png" alt="Soporte técnico">Soporte técnico especializado</li>
                <li><img src="benefits images/warranty-icon.png" alt="Garantía">Garantía en todos nuestros productos</li>
                <li><img src="benefits images/shipping-icon.png" alt="Envío rápido">Envío rápido y seguro</li>
            </ul>
        </div>

        <div class="social-media">
            <h2>Síguenos en nuestras redes sociales</h2>
            <a href="#"><img src="SocialMedia/facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="SocialMedia/twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="SocialMedia/instagram-icon.png" alt="Instagram"></a>
        </div>
    </main>

    <script>
        document.getElementById('inicio-link').addEventListener('click', function() {
            showSection('inicio');
        });

        document.getElementById('carrito-link').addEventListener('click', function() {
            showSection('carrito');
        });

        document.getElementById('computadores-link').addEventListener('click', function() {
            showSection('catalogo');
        });

        function showSection(sectionId) {
            document.querySelectorAll('.section').forEach(function(section) {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }

        showSection('inicio');
    </script>

</body>
</html>
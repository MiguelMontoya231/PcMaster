<?php
session_start();
$loggedIn = isset($_SESSION['idusuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computadores - PC Masters</title>
    <link rel="stylesheet" href="computadores.css">
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
        <h2>Catálogo de Computadores</h2>
        <div class="catalog">
            <div class="product">
                <h2>PC PREDATOR</h2>
                <img src="Catalogo-index/pc1.png" alt="PC Gamer 1">
                <p>Intel core i9, RTX 4090, 2TB SSD, 64 RAM.</p>
                <p>$17,390.000 COP</p>
                <button onclick="agregarAlCarrito({idproductos: 1, nombre: 'PC PREDATOR', precio: 17390000})" class="button">Agregar al carrito</button>
                
            </div>
            <div class="product">
                <h2>Portatil MSI </h2>
                <img src="Catalogo-index/pc2.png" alt="PC Gamer 2">
                <p>Pantalla 15.6" intel core i5, SSD 512 GB, RTX 2060.</p>
                <p>$5,490.000 COP</p>
                <button onclick="agregarAlCarrito({idproductos: 2, nombre: 'Portatil', precio: 5490000})" class="button">Agregar al carrito</button>
            </div>
            <div class="product">
                <h2>Portatil Asus ROG Strix G15</h2>
                <img src="Catalogo-index/pc3.png" alt="PC Gamer 3">
                <p>Pantalla 15.6" intel core i7, SSD 1 TB, RTX 4060</p>
                <p>$8,990.000 COP</p>
                <button onclick="agregarAlCarrito({idproductos: 3, nombre: 'Portatil Asus ROG Strix G15', precio: 8990000})" class="button">Agregar al carrito</button>
            </div>
            <div class="product">
                <h2>Portatil Asus ROG Strix G17</h2>
                <img src="Computadores/pc4.png" alt="PC Gamer 4">
                <p>Pantalla 15.6" Intel Core i5, SSD 512, RTX 2050 Ti</p>
                <p>$3,990.000 COP</p>
                <button onclick="agregarAlCarrito({idproductos: 4, nombre: 'Portatil Asus ROG Strix G17', precio: 3990000})" class="button">Agregar al carrito</button>
            </div>
            <div class="product">
                <h2>PC Master g35</h2>
                <img src="Computadores/pc5.png" alt="PC Gamer 5">
                <p>Intel Core i9, SSD 1 TB, Ryzen 6600 xt. </p>
                <p>$6,590.000 COP</p>
                <button onclick="agregarAlCarrito({idproductos: 5, nombre: 'Pc Master g35', precio: 6790000})" class="button">Agregar al carrito</button>
            </div>
            <div class="product">
                <h2>PC Master g23</h2>
                <img src="Computadores/pc6.png" alt="PC Gamer 6">
                <p>Incluye Pantalla 2k 144 hz, Intel core i7, SSD 512 GB, RTX 2080</p>
                <p>$5,990.000 COP</p>
                <button onclick="agregarAlCarrito({idproductos: 6, nombre: 'Pc Master g23', precio: 59900000})" class="button">Agregar al carrito</button>
                
                </div>
            </div>
        </section>
    </main>
</body>
</html>

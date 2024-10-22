<?php
session_start();
$loggedIn = isset($_SESSION['idusuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componentes - PC Masters</title>
    <link rel="stylesheet" href="componentes.css">
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
        <h2>Catálogo de Componentes</h2>
        <div class="catalog">
                <div class="product">
                    <h2>Chasis Auros </h2>
                    <img src="Componentes-images/Chasis.png" alt="Componente 1">
                    <p>Chasis Auros.</p>
                    <p>$350.000 COP</p>
                    <button onclick="agregarAlCarrito({idproductos: 7, nombre: 'Chasis Auros', precio: 350000})" class="button">Agregar al Carrito</button>
                    </div>
                <div class="product">
                    <h2>Geforce GTX 1050 Ti</h2>
                    <img src="Componentes-images/Grafica1.png" alt="Componente 2">
                    <p>Tarjeta grafica GTX 1050 Ti 4 GB VRAM.</p>
                    <p>$500.000 COP</p>
                    <button onclick="agregarAlCarrito({idproductos: 8, nombre: 'Geforce GTX 1050 Ti', precio: 500000})" class="button">Agregar al Carrito</button>
                </div>
                <div class="product">
                    <h2>Procesador I5</h2>
                    <img src="Componentes-images/i5.png" alt="Componente 3">
                    <p>Procesador intel i5 8th Gen.</p>
                    <p>$279.000 COP</p>
                    <button onclick="agregarAlCarrito({idproductos: 9, nombre: 'Procesador I5', precio: 279000})" class="button">Agregar al Carrito</button>
                </div>
                <div class="product">
                    <h2>Procesador I7</h2>
                    <img src="Componentes-images/I7.png" alt="Componente 4">
                    <p>Procesador intel i7 8th Gen.</p>
                    <p>$599.900 COP</p>
                    <button onclick="agregarAlCarrito({idproductos: 10, nombre: 'Procesador I7', precio: 599900})" class="button">Agregar al Carrito</button>
                </div>
                <div class="product">
                    <h2>Sistema de refrigeracion</h2>
                    <img src="Componentes-images/refrigeracion.png" alt="Componente 5">
                    <p>Sistema de refrigeracion por aire</p>
                    <p>$160.900 COP</p>
                    <button onclick="agregarAlCarrito({idproductos: 11, nombre: 'Sistema de refrigeracion', precio: 160900})" class="button">Agregar al Carrito</button>
                </div>
                <div class="product">
                    <h2>Fuente de poder</h2>
                    <img src="Componentes-images/Fuente de poder.png" alt="Componente 6">
                    <p>Fuente de poder AX 1200i, 1200.</p>
                    <p>$860.900 COP</p>
                    <button onclick="agregarAlCarrito({idproductos: 12, nombre: 'Funete de poder', precio: 860900})" class="button">Agregar al Carrito</button>
                </div>
            </div>
        </section>
    </main>
</body>
</html>

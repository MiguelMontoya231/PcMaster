<?php 
session_start(); 
include 'bd.php';

// Verificar si el usuario es administrador 
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'admin') {
    echo "Acceso denegado. Solo los administradores pueden agregar productos.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $idproveedor = $_POST['idproveedor'];
    $idcategoria = $_POST['idcategoria'];
    $idofertas = $_POST['idofertas'];

    // Subir la imagen del producto
    $target_dir = "uploads/";  // Asegúrate de que la carpeta 'uploads' exista
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar que el archivo es una imagen
    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
    if ($check === false) {
        echo "El archivo no es una imagen.";
        exit();
    }

    // Mover la imagen subida al directorio de destino
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        // Insertar el producto en la base de datos
        $sql = "INSERT INTO productos (nombre, descripcion, precio, imagen, stock, idproveedor, idcategoria, idofertas) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssdsiisi", $nombre, $descripcion, $precio, $target_file, $stock, $idproveedor, $idcategoria, $idofertas);
            if ($stmt->execute()) {
                echo "Producto agregado exitosamente.";
            } else {
                echo "Error al agregar el producto: " . $conn->error;
            }
            $stmt->close();
        }
    } else {
        echo "Error al subir la imagen.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - PC Masters</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Agregar Nuevo Producto</h1>
        
        <form action="agregar_producto.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" step="0.01" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" id="stock" name="stock" required>
            </div>

            <div class="form-group">
                <label for="idproveedor">ID del Proveedor:</label>
                <input type="number" id="idproveedor" name="idproveedor" required>
            </div>

            <div class="form-group">
                <label for="idcategoria">ID de la Categoría:</label>
                <input type="number" id="idcategoria" name="idcategoria" required>
            </div>

            <div class="form-group">
                <label for="idofertas">ID de Ofertas (Opcional):</label>
                <input type="number" id="idofertas" name="idofertas">
            </div>

            <div class="form-group">
                <label for="imagen">Imagen del Producto:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" required>
            </div>

            <button type="submit" class="submit-btn">Agregar Producto</button>
        </form>
        
        <p><a href="index.php">Volver al Inicio</a></p>
    </div>
</body>
</html>

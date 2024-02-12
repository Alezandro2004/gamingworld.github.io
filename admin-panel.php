<?php
session_start();

// Verificar si el administrador no ha iniciado sesión, si es así, redirigirlo a la página de inicio de sesión.
if(!isset($_SESSION['admin'])) {
    header("Location: admin-login.php");
    exit;
}

// Conexión a la base de datos
$servername = "localhost"; // Reemplaza con tu servidor de base de datos
$username = "root"; // Reemplaza con tu nombre de usuario de la base de datos
$password = ""; // Reemplaza con tu contraseña de la base de datos
$database = "compras"; // Reemplaza con el nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Verificar si se ha enviado el formulario para agregar un nuevo producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_producto'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    
    // Insertar el nuevo producto en la base de datos
    $sql = "INSERT INTO productos (nombre, precio, imagen, descripcion) VALUES ('$nombre', $precio, '$imagen', '$descripcion')";
    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado exitosamente";
    } else {
        echo "Error al agregar el producto: " . $conn->error;
    }
}

// Verificar si se ha enviado el formulario para eliminar un producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_producto'])) {
    $id_producto = $_POST['id_producto'];
    
    // Eliminar el producto de la base de datos
    $sql = "DELETE FROM productos WHERE id = $id_producto";
    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado exitosamente";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

// Resto del código para editar y mostrar productos...
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <style>
        body {
            background: linear-gradient(to bottom right, #8A2BE2, #191970);
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.5);
        }
        h1 {
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            background-color: #2e2e2e;
            color: #fff;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .producto {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #2e2e2e;
            border-radius: 5px;
        }
        .producto img {
            width: 100px;
            height: auto;
            border-radius: 5px;
        }
        .producto h3 {
            margin-top: 0;
        }
        .producto p {
            margin-bottom: 10px;
        }
        .producto form {
            margin-top: 10px;
        }
        .producto form button {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        .producto form button:hover {
            background-color: #d32f2f;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Panel de Administrador</h1>
        
        <!-- Formulario para agregar un nuevo producto -->
        <h2>Agregar Nuevo Producto</h2>
        <form method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required><br>
            <label for="imagen">Imagen:</label>
            <input type="text" id="imagen" name="imagen" required><br>
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" rows="4" required></textarea><br>
            <input type="submit" name="agregar_producto" value="Agregar Producto">
        </form>

        <!-- Lista de productos existentes -->
        <?php
        // Consulta SQL para obtener los productos
        $sql = "SELECT * FROM productos";
        $result = $conn->query($sql);

        // Mostrar los productos
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        ?>
        <div class="producto">
            <!-- Mostrar información del producto -->
            <img src="<?php echo $row['imagen']; ?>" alt="<?php echo $row['nombre']; ?>">
            <h3><?php echo $row['nombre']; ?></h3>
            <p><?php echo $row['descripcion']; ?></p>
            <p>Precio: $<?php echo number_format($row['precio'], 2); ?></p>
            
            <!-- Formulario para eliminar un producto -->
            <form method="post">
                <input type="hidden" name="id_producto" value="<?php echo $row['id']; ?>">
                <button type="submit" name="eliminar_producto">Eliminar</button>
            </form>
        </div>
        <?php
            }
        } else {
            echo "No se encontraron productos";
        }
        ?>

        <!-- Enlaces para cerrar sesión -->
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>

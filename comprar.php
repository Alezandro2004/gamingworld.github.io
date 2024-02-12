<?php
session_start();

// Conexión a la base de datos (ajusta estos valores con los tuyos)
$servername = "Localhost";
$username = "root";
$password = "";
$database = "compras";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Función para registrar un nuevo usuario
function registrarUsuario($conn, $usuario, $contrasena) {
    // Verificar si el usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return "El nombre de usuario ya está en uso";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuario', '$contrasena')";
        if ($conn->query($sql) === TRUE) {
            return "Usuario registrado exitosamente";
        } else {
            return "Error al registrar el usuario: " . $conn->error;
        }
    }
}

// Verificar si se ha enviado el formulario de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    // Registrar al nuevo usuario
    $mensaje = registrarUsuario($conn, $usuario, $contrasena);
    // Mostrar el mensaje de registro
    echo "<script>alert('$mensaje');</script>";
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['iniciar_sesion'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    // Verificar las credenciales en la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contrasena = '$contrasena'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        // Iniciar sesión (opcional) y redirigir a la página de confirmación
        $_SESSION['usuario'] = $usuario;
        header("Location: confirmacion.php");
        exit;
    } else {
        // Mostrar un mensaje de error si las credenciales son incorrectas
        $error = "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión y Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #4b0082, #00008b); /* Degradado de morado oscuro a azul oscuro */
            font-family: Arial, sans-serif;
            color: #fff; /* Color del texto */
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: #282828; /* Gris metálico */
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }
        form input[type="text"],
        form input[type="password"] {
            width: 100%;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }
        form button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4b0082; /* Morado oscuro */
            background-image: linear-gradient(to right, #4b0082, #00008b); /* Degradado de morado oscuro a azul oscuro */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        form button[type="submit"]:hover {
            background-color: #2a0047; /* Morado más oscuro */
        }
        .alert {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }
        .alert-danger {
            background-color: #4b0082; /* Morado oscuro */
            background-image: linear-gradient(to right, #4b0082, #00008b); /* Degradado de morado oscuro a azul oscuro */
            color: #fff;
            border: 1px solid #4b0082; /* Morado oscuro */
        }
        .signin-text,
        .signup-text {
            color: #fff; /* Color del texto de Iniciar sesión y Registrarse */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Iniciar sesión</h1>
        <?php if(isset($error)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="post">
            <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
            <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña" required>
            <button type="submit" name="iniciar_sesion">Iniciar sesión</button>
        </form>
        <h1>Registrarse</h1>
        <form method="post">
            <input type="text" id="usuario_reg" name="usuario" placeholder="Usuario" required>
            <input type="password" id="contrasena_reg" name="contrasena" placeholder="Contraseña" required>
            <button type="submit" name="registrar">Registrar</button>
        </form>
    </div>
</body>
</html>


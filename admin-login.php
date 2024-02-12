<?php
session_start();

// Verificar si el administrador ya ha iniciado sesión, si es así, redirigirlo a la página de administrador.
if(isset($_SESSION['admin'])) {
    header("Location: admin-panel.php");
    exit;
}

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    // Verificar las credenciales del administrador (debes hacer la consulta a la base de datos)
    if($usuario === "admin" && $contrasena === "password") { // Aquí deberías realizar la consulta a la base de datos
        // Iniciar sesión y redirigir al panel de administrador
        $_SESSION['admin'] = $usuario;
        header("Location: admin-panel.php");
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
    <title>Iniciar sesión de administrador</title>
    <style>
        body {
            background: linear-gradient(to bottom right, #8A2BE2, #191970);
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
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
        input[type="password"] {
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
        .error {
            color: #ff0000;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Iniciar sesión de administrador</h1>
        <?php if(isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <input type="submit" name="login" value="Iniciar sesión">
        </form>
    </div>
</body>
</html>

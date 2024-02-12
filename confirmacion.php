<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra</title>
    <!-- Agrega aquí tus estilos CSS si es necesario -->
    <style>
        /* Estilos CSS */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4b0082, #00008b); /* Degradado de morado oscuro a azul oscuro */
            color: #fff; /* Color del texto */
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 100px auto;
            text-align: center;
            background-color: #282828; /* Gris metálico */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
        }
        .mensaje {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .boton {
            background-color: #4b0082; /* Morado oscuro */
            background-image: linear-gradient(to right, #4b0082, #00008b); /* Degradado de morado oscuro a azul oscuro */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        .boton:hover {
            background-color: #2a0047; /* Morado más oscuro */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mensaje">
            ¡Producto adquirido con éxito!
        </div>
        <a href="index.php" class="boton">Volver a la tienda</a>
    </div>
</body>
</html>

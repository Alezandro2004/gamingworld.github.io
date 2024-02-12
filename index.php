<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Computadoras RZ</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos específicos para el encabezado superior */
        header.top-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #4b0082; /* Morado oscuro */
            background-image: linear-gradient(to right, #4b0082, #00008b); /* Degradado de morado oscuro a azul oscuro */
            color: #fff;
            text-align: center;
            padding: 1px 0;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }
        /* Estilos para el contenido principal */
        main {
            margin-top: 70px; /* Ajusta el margen superior para que no se superponga con el encabezado fijo */
            padding: 20px;
        }
        /* Estilos para los productos */
        .productos {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            justify-items: center;
        }
        .producto {
            background-color: #f8f9fa; /* Gris claro */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .producto img {
            width: 200px;
            height: auto;
            margin-bottom: 10px;
        }
        .producto h3 {
            margin: 10px 0;
            color: #4b0082; /* Morado oscuro */
        }
        .producto p {
            margin-bottom: 10px;
        }
        .producto button {
            background-color: #4b0082; /* Morado oscuro */
            background-image: linear-gradient(to right, #4b0082, #00008b); /* Degradado de morado oscuro a azul oscuro */
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .producto button:hover {
            background-color: #2a0047; /* Morado más oscuro */
        }
        /* Estilos específicos para el encabezado inferior */
        header.bottom-header {
            background-color: #4b0082; /* Morado oscuro */
            background-image: linear-gradient(to right, #4b0082, #00008b); /* Degradado de morado oscuro a azul oscuro */
            color: #fff;
            text-align: center;
            padding: 10px;
            width: 100%;
            box-shadow: 0px -2px 5px rgba(0, 0, 0, 0.1);
        }
        header.bottom-header a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        header.bottom-header a:hover {
            color: #f8f9fa; /* Blanco */
        }
        /* Estilos para el formulario de búsqueda */
        form.search-form {
            margin-bottom: 20px;
            text-align: center;
        }
        form.search-form input[type="text"] {
            padding: 10px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        form.search-form button {
            padding: 10px 20px;
            background-color: #4b0082; /* Morado oscuro */
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        form.search-form button:hover {
            background-color: #2a0047; /* Morado más oscuro */
        }
    </style>
</head>
<body>
    <header class="top-header">
        <h1>ʙɪᴇɴᴠᴇɴɪᴅᴏ ᴀ ɢᴀᴍɪɴɢ ᴡᴏʀʟᴅ</h1>
        <!-- Enlace para el panel de administrador -->
        <a href="admin-login.php" style="position: absolute; top: 10px; right: 10px; color: #fff; text-decoration: none;">Admin</a>
    </header>
    <main>
        <section>
            <h2>Nuestros Productos</h2>
            <!-- Formulario de búsqueda -->
            <form method="GET" class="search-form">
                <input type="text" name="q" placeholder="Buscar productos...">
                <button type="submit">Buscar</button>
            </form>
            <div class="productos">
                <!-- Código PHP para mostrar los productos -->
                <?php
                // Conexión a la base de datos
                $servername = "localhost"; // Reemplaza con tu servidor de base de datos
                $username = "root"; // Reemplaza con tu nombre de usuario de la base de datos
                $password = ""; // Reemplaza con tu contraseña de la base de datos
                $database = "compras"; // Reemplaza con el nombre de tu base de datos

                $conn = new mysqli($servername, $username, $password, $database);
                if ($conn->connect_error) {
                    die("Error de conexión a la base de datos: " . $conn->connect_error);
                }

                // Consulta SQL para obtener los productos
                $sql = "SELECT * FROM productos";
                
                // Procesar búsqueda si se envió un término de búsqueda
                if(isset($_GET['q']) && !empty($_GET['q'])) {
                    $search_term = $_GET['q'];
                    $sql .= " WHERE nombre LIKE '%$search_term%'";
                }
                
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
                    <a href="comprar.php"><button type="button">Comprar</button></a>
                </div>
                <?php
                    }
                } else {
                    echo "No se encontraron productos";
                }
                $conn->close();
                ?>
            </div>
        </section>
    </main>
    <header class="bottom-header">
        <h3>2024 ɢᴀᴍɪɴɢ ᴡᴏʀʟᴅ</h3>
        <p>Para soporte o contacto, por favor visita nuestra página de contacto: <a href="https://www.facebook.com/rodrigoalezandro.zavalaromero.5?locale=es_LA">@alez_zavala</a></p>
    </header> 
</body>
</html>



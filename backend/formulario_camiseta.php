<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Carga de Camisetas</title>
</head>
<body>
    <header>
        <h1>Formulario de Carga de Camisetas</h1>
    </header>
    <main>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "127.0.0.1";
            $username = "root";
            $password = "";
            $dbname= "camisetas";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $nombre = $_POST['nombre'];
                $precio = $_POST['precio'];
                $descripcion = $_POST['descripcion'];
                $imagen = $_POST['imagen'];

                    $stsm = $conn->prepare("INSERT INTO productos (nombre, precio, descripcion, imagen) VALUES (?, ?, ?, ?)");
                    $stsm->bindParam(1, $nombre);
                    $stsm->bindParam(2, $precio);
                    $stsm->bindParam(3, $descripcion);
                    $stsm->bindParam(4, $imagen);
                    $stsm->execute();

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;

            header("Location: ../index.php");
            exit();
        }
        ?>

            <form form action="formulario_camiseta.php" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
            <label for="precio">Precio</label>
            <input type="number" name="precio" id="precio" required>
            <label for="descripcion">Descripcion</label>
            <input type="text" name="descripcion" id="descripcion" required>
            <label for="imagen">Nombre del Archivo de Imagen</label>
            <input type="text" name="imagen" id="imagen" required>
            <input type="submit" value="Agregar Producto">
            </form>
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="assets/css/estilos.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>Tienda de Camisetas de Fútbol</title>
    </head>
    <body>
        <header>
            <div class="header-container">
                <img src="assets/img/logo.jpeg" alt="Logo" class="logo" style="max-width: 100px; height:auto;">
                <h1>Tienda de Camisetas de Fútbol</h1>
                <a href="#formulario" id="contacto">Contacto</a>
            </div>
            <nav>       
                <div class="carrito-container">
                    <div class="carrito-icon" onclick="mostrarCarrito()">
                            <i class="fas fa-shopping-cart"></i>
                            <span id="cantidad-carrito">0</span>
                    </div>
                    <div class="carrito-popup" id="carrito-popup">
                        <div class="carrito-contenido" id="carrito-contenido">
                            <h2>Carrito de Compras</h2>
                            <ul id="lista-carrito">
                            </ul>
                            <div class="total-carrito">
                                <p>Total: $<span id="total-carrito">0.00</span></p>
                            </div>
                            <button id="cerrar-carrito">Cerrar carrito</button>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <section class="destacados">
                <?php
                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $dbname = "camisetas";

                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stsm = $conn->prepare("SELECT id, nombre, precio, descripcion, imagen FROM productos");
                $stsm->execute();

                while($producto = $stsm->fetch(PDO::FETCH_ASSOC)) {
                    echo '<article>';
                    echo '<h3>' . $producto['nombre'] . '</h3>';
                    echo '<img src="assets/img/' . $producto['imagen'] . '" alt="' . $producto['nombre'] .'" style="max-width: 100%; max-height: 225px; height:auto; display:block;">';
                    echo '<br>';
                    echo '<p> $' . $producto['precio'] . '</p>';
                    echo '<p>' . $producto['descripcion'] . '</p>';
                    echo '<button class="btnAgregarCarrito" data-product-id="' . $producto['id'] . '" data-nombre="' . $producto['nombre'] . '" data-descripcion="' . $producto['descripcion'] . '" data-precio ="' . $producto['precio'] . '" data-imagen="' . $producto['imagen'] . '">Añadir al carrito</button>';
                    echo '</article>';
                }
                ?>
            </section>
        </main>
        <footer>
            <h3>Contacto</h3>
            <form id="formulario" action="https://formsubmit.co/c2d420f892ebfe1db2caab45a1eb7f23" method="POST" class="p-3">
                <div class="mb-3">  
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" id="correo" name="correo" required>
                </div>
                <div class="mb-3">
                    <label for="asunto" class="form-label">Asunto:</label>
                    <input type="text" class="form-control" id="asunto" name="asunto" required>
                </div>
                <div class="mb-3">
                    <label for="consulta" class="form-label">Consulta:</label>
                    <textarea class="form-control" id="consulta" name="consulta" rows="7" required></textarea>
                </div>

                <input type="hidden" name="_next" value="http://localhost/pp2/index.php">

                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
            <p>2023 Tienda de Camisetas de Fútbol</p>
        </footer>
        <script src="assets/js/carrito.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>
<?php
    require 'includes/app.php';

    use App\Producto;

    iniciarSession();

    $db = conectarDB();

    $auth = $_SESSION['login'] ?? false;

    //Validar la URL por ID valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /kerostore/index.php');
    }

    //Obtener los datos del producto
    $producto = Producto::find($id);

    incluirTemplate('header');
?>

                <?php if($auth): ?>
                    <a href="/KeroStore/logout.php">Log Out</a>
                <?php else: ?>
                    <a href="/KeroStore/login.php">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

    <main class="contenedor">

        <h1> <?php echo $producto->nombre; ?> </h1>

        <div class="producto-grid">
            <div class="producto-grid-imagen">
                <img src="/kerostore/imagenes/<?php echo $producto->imagen; ?>" alt="Imagen del producto">
            </div>

            <div class="producto-grid-info">

                <p class="producto-detalle"> Talla: <span class="producto-detalle-span"> <?php echo $producto->talla; ?> </span> </p>

                <p class="producto-detalle" > Precio: <span class="producto-detalle-span" ><?php echo "$" . $producto->precio; ?></span> </p>

                <p class="producto-detalle">Cantidad: <input type="number" id="cantidad" placeholder="Cantidad" min="1"> </p>

                <div class="agregar">
                    <form class="formulario" action="">
                        <input class="boton-carrito-v2" type="submit" value="Agregar">
                    </form>
                </div>
            </div>
        </div>

    </main>

<?php 
    incluirTemplate('footer');
?>
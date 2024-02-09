<?php 
    require '../includes/app.php';

    //estaAutenticado();
    iniciarSession();
    isAdmin();

    use App\Producto;

    //Implementar un método para obtener todas las propiedades
    $productos = Producto::all();

    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];

    $auth = $_SESSION['login'] ?? false;

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            $tipo = $_POST['tipo'];

            if(validarTipoContenido($tipo)){
                //Compara lo que vamos a eliminar
                if($tipo === 'producto'){
                    $producto = Producto::find($id);
                    $producto->eliminar();
                }
            }
        }
    }

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
    <h1>Administrador de KeroStore</h1>

    <h3>Hola <span> <?php echo $nombre . " " . $apellido; ?> </span> </h3>

    <?php $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje): ?>
            <p class="alerta exito">
                <?php echo s($mensaje); ?>
            </p>
    <?php endif; ?>

    <a href="/kerostore/admin/productos/crear.php" class="boton-verde">Nuevo Producto</a>
    <a href="/kerostore/admin/indexCategorias.php" class="boton-datos">Categorias</a>
    <a href="/kerostore/admin/productos/crear.php" class="boton-datos">Usuarios</a>

    <h2>Productos</h2>

    <table class="productos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Cantidad de Piezas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos as $producto): ?>
                <tr>
                    <td> <?php echo $producto->id; ?> </td>
                    <td> <?php echo $producto->nombre; ?> </td>
                    <td>
                        <img src="../imagenes/<?php echo $producto->imagen; ?>" class="imagen-tabla"> 
                    </td>
                    <td> <?php echo "$" . number_format($producto->precio); ?> </td>
                    <td> <?php echo $producto->cantidad; ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $producto->id; ?>">
                            <input type="hidden" name="tipo" value="producto">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/kerostore/admin/productos/actualizar.php?id=<?php echo $producto->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php 
    incluirTemplate("footer");
?>
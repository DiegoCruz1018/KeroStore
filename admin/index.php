<?php 
    require '../includes/app.php';

    estaAutenticado();

    use App\Producto;

    //Implementar un método para obtener todas las propiedades
    $productos = Producto::all();

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    incluirTemplate('header');
?>

<main class="contenedor">
    <h1>Administrador de KeroStore</h1>

    <?php $mensaje = mostrarNotificacion(intval($resultado));
        if($mensaje): ?>
            <p class="alerta exito">
                <?php echo $mensaje; ?>
            </p>
    <?php endif; ?>

    <a href="/kerostore/admin/productos/crear.php" class="boton-verde">Nuevo Producto</a>
    <a href="/kerostore/admin/productos/crear.php" class="boton-datos">Usuarios</a>

    <h2>Productos</h2>

    <table class="productos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Cantidad</th>
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
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php 
    incluirTemplate("footer");
?>
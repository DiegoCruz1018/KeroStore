<?php 
    require '../includes/app.php';

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
                <th>Categoria</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos as $producto): ?>
                <tr>
                    <td>  </td>
                    <td>  </td>
                    <td>
                        <img src="../imagenes/" class="imagen-tabla"> 
                    </td>
                    <td></td>
                    <td> </td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php 
    incluirTemplate("footer");
?>
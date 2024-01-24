<?php 
    require '../../includes/app.php';

    use App\Producto;

    $db = conectarDB();

    incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h1>Actualizar Producto</h1>

        <a href="/kerostore/admin/index.php" class="boton-datos">Volver</a>

        <form class="formulario" action="actualizar.php" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_productos.php'; ?>

            <div class="alinear-derecha">
                <input type="submit" value="Actualizar Producto" class="boton-verde">
            </div>

        </form>

    </main>

<?php 
    incluirTemplate('footer');
?>
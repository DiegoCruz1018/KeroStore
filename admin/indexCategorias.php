<?php 
    require '../includes/app.php';

    estaAutenticado();

    use App\Categoria;

    //Traer todas las categorias
    $categorias = Categoria::all();

    //Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){

            $tipo = $_POST['tipo'];

            if(validarTipoContenido($tipo)){
                //Compara lo que vamos a eliminar
                $categoria = Categoria::find($id);
                $categoria->eliminar();
            }
        }
    }

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

    <a href="/kerostore/admin/categorias/crear.php" class="boton-verde">Nueva Categoria</a>
    <a href="/kerostore/admin/index.php" class="boton-datos">Productos</a>
    <a href="/kerostore/admin/usuarios/crear.php" class="boton-datos">Usuarios</a>

    <h2>Categorias</h2>

    <table class="productos">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categorias as $categoria): ?>
                <tr>
                    <td> <?php echo $categoria->id; ?> </td>
                    <td> <?php echo $categoria->nombre; ?> </td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $categoria->id; ?>">
                            <input type="hidden" name="tipo" value="categoria">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a href="/kerostore/admin/categorias/actualizar.php?id=<?php echo $categoria->id; ?>" class="boton-verde-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php 
    incluirTemplate('footer');
?>
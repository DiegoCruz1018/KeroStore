<?php
    require '../../includes/app.php';

    //estaAutenticado();

    use App\Categoria;

    $db = conectarDB();

    $categoria = new Categoria;
    
    //Arreglo con mensajes de errores
    $errores = Categoria::getErrores();

    //Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Creando una nueva instancia
        $categoria = new Categoria($_POST['categoria']);

        //Validar
        $errores = $categoria->validar();

        if(empty($errores)){

            //Guarda en la base de datos
            $categoria->guardar();
        }
    }

    incluirTemplate('header');
?>

<main class="contenedor seccion">

    <h1>Nueva Categoria</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <a href="/kerostore/admin/indexCategorias.php" class="boton-datos">Volver</a>

    <form class="formulario" method="post" action="crear.php">
        
        <?php include '../../includes/templates/formulario_categorias.php'; ?>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Categoria" class="boton-verde">
        </div>
    </form>

</main>

<?php 
    incluirTemplate('footer');
?>
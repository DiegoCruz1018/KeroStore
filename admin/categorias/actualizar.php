<?php

    require '../../includes/app.php';

    //estaAutenticado();

    use App\Categoria;

    //Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /kerostore/admin/indexCategoria.php');
    }

    //Obtener los datos de la categoria
    $categoria = Categoria::find($id);

    //Arreglo con errores
    $errores = Categoria::getErrores(); 

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Asignar los atributos
        $args = $_POST['categoria'];

        //Sincronizar objeto en memoria con lo que el usuario escribio
        $categoria->sincronizar($args);

        //Validación
        $errores = $categoria->validar();

        if(empty($errores)){

            $categoria->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h1>Actualizar Categoria</h1>

        <?php include_once __DIR__ . '/../../includes/templates/alertas.php'; ?>

        <a href="/kerostore/admin/indexCategorias.php" class="boton-datos">Volver</a>

        <form class="formulario" method="post" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_categorias.php'; ?>

            <div class="alinear-derecha">
                <input type="submit" value="Actualizar Categoria" class="boton-verde">
            </div>

        </form>

    </main>

<?php 
    incluirTemplate('footer');
?>
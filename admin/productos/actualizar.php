<?php

    require '../../includes/app.php';

    //estaAutenticado();

    use App\Producto;
    use App\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    //Validar la URL por ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /kerostore/admin/index.php');
    }

    //Obtener los datos del producto
    $producto = Producto::find($id);

    //Obtener todas las categorias
    $categorias = Categoria::all();

    //Arreglo con errores
    $errores = Producto::getErrores(); 

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Asignar los atributos
        $args = $_POST['producto'];

        $producto->sincronizar($args);

        //Validación
        $errores = $producto->validar();

        //SUBIDA DE ARCHIVOS

        //Generar un nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Setear la imagen
        //Realiza un resize a la imagen con intervention
        if($_FILES['producto']['tmp_name']['imagen']){
            $image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800,600);
            $producto->setImagen($nombreImagen);
        }

        if(empty($errores)){

            if($_FILES['producto']['tmp_name']['imagen']){
                //Almacenar la imagen
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }

            $producto->guardar();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">

        <h1>Actualizar Producto</h1>

        <?php foreach($errores as $error): ?>
            <p class="alerta error" >
                <?php echo $error; ?>
            </p>
        <?php endforeach; ?>

        <a href="/kerostore/admin/index.php" class="boton-datos">Volver</a>

        <form class="formulario" method="post" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_productos.php'; ?>

            <div class="alinear-derecha">
                <input type="submit" value="Actualizar Producto" class="boton-verde">
            </div>

        </form>

    </main>

<?php 
    incluirTemplate('footer');
?>
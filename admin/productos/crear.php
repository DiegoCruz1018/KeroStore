<?php
    require '../../includes/app.php';

    estaAutenticado();

    use App\Producto;
    use Intervention\Image\ImageManagerStatic as Image;

    //Se necesita que el usuario este autenticado
    // estaAutenticado();

    $db = conectarDB();

    $producto = new Producto;

    //Consultar para obtener las categorias
    $consulta = "SELECT * FROM categorias";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = Producto::getErrores();

    //Ejecutar el código después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Creando una nueva instancia
        $producto = new Producto($_POST['producto']);

        /** SUBIDA DE ARCHIVOS **/

        //Generar un nombre único para la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        //Setear la imagen
        //Realiza un resize a la imagen con intervention
        if($_FILES['producto']['tmp_name']['imagen']){
            $image = Image::make($_FILES['producto']['tmp_name']['imagen'])->fit(800,600);
            $producto->setImagen($nombreImagen);
        }

        //Validar
        $errores = $producto->validar();

        if(empty($errores)){

            //Crear la carpeta para subir imagenes
            if(!is_dir(CARPETA_IMAGENES)){
                mkdir(CARPETA_IMAGENES);
            }

            //Guarda la imagen en el servidor
            $image->save(CARPETA_IMAGENES . $nombreImagen);

            //Guarda en la base de datos
            $resultado = $producto->guardar();

            //Mensaje de exito o error
            if($resultado){
                //Redireccionar al usuario
                header('Location: /KeroStore/admin?resultado=1');
            }
        }
    }

    incluirTemplate('header');
?>

<main class="contenedor seccion">

    <h1>Nuevo Producto</h1>

    <a href="/KeroStore/admin/index.php" class="boton-datos">Volver</a>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post" action="crear.php" enctype="multipart/form-data">
        
        <?php include '../../includes/templates/formulario_productos.php'; ?>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Producto" class="boton-verde">
        </div>
    </form>

</main>

<?php 
    incluirTemplate('footer');
?>
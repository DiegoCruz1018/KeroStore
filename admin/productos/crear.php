<?php
    require '../../includes/app.php';

    //estaAutenticado();
    iniciarSession();
    isAdmin();

    use App\Producto;
    use App\Categoria;
    use Intervention\Image\ImageManagerStatic as Image;

    //Se necesita que el usuario este autenticado
    // estaAutenticado();

    $db = conectarDB();

    $auth = $_SESSION['login'] ?? false;

    $producto = new Producto;

    //Consulta para obtener todas las categorias
    $categorias = Categoria::all();

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
            $producto->guardar();
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

<main class="contenedor seccion">

    <h1>Nuevo Producto</h1>

    <a href="/KeroStore/admin/index.php" class="boton-datos">Volver</a>

    <?php include_once __DIR__ . '/../../includes/templates/alertas.php'; ?>

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
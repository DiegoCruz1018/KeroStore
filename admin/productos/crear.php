<?php
    require '../../includes/app.php';

    use App\Producto;
    use Intervention\Image\ImageManagerStatic as Image;

    //Se necesita que el usuario este autenticado
    // estaAutenticado();

    $db = conectarDB();

    //Consultar para obtener las categorias
    $consulta = "SELECT * FROM categorias";
    $resultado = mysqli_query($db, $consulta);

    //Arreglo con mensajes de errores
    $errores = Producto::getErrores();

    $nombre = '';
    $imagen = '';
    $precio = '';
    $cantidad = '';
    $idCategoria = '';
    $talla = '';
    $creado = '';

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
        <fieldset>
            <legend>Información general</legend>

            <label for="nombre">Nombre: </label>
            <input type="text" id="nombre" name="producto[nombre]" placeholder="Nombre del Producto" value="<?php echo $producto->nombre; ?>">

            <label for="imagen">Imagen: </label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="producto[imagen]">

            <?php if($producto->imagen){ ?>
                <img src="../../imagenes/<?php echo $producto->imagen ?>" class="imagen-small">
            <?php } ?>

            <label for="precio">Precio: </label>
            <input type="text" id="precio" name="producto[precio]" placeholder="Precio del Producto" value="<?php echo $producto->precio; ?>">

            <label for="cantidad">Cantidad de piezas: </label>
            <input type="text" id="cantidad" name="producto[cantidad]" placeholder="Cantidad de piezas del Producto" value="<?php echo $producto->cantidad; ?>">

            <label for="talla">Talla: </label>
            <input type="text" id="talla" name="producto[talla]" placeholder="Talla del Producto" value="<?php echo $producto->talla; ?>">
        </fieldset>

        <fieldset>
            <legend>Categoria del Producto</legend>

            <label for="categoria">Categoría</label>

            <!-- <select name="producto[idCategoria]" id="categoria">
                <option selected value="">-- Seleccione --</option>
                <?php //foreach($categorias as $categoria): ?>
                    <option <?php //echo $producto->idCategoria === $categoria->id ? 'selected' : '' ?> 
                        value="<?php //echo $categoria->id; ?>" > <?php //echo $categoria->nombre ?> 
                    </option>
                <?php //endforeach; ?> 
            </select> -->

                <select name="idCategoria">
                    <option value="">-- Seleccione --</option>
                    <?php while($categoria = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $idCategoria === $categoria['id'] ? 'selected' : ''; ?> value="<?php echo $categoria['id']; ?>"> <?php echo $categoria['categoria']; ?> </option>
                    <?php endwhile; ?>
                </select>
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Producto" class="boton-verde">
        </div>
    </form>

</main>

<?php 
    incluirTemplate('footer');
?>
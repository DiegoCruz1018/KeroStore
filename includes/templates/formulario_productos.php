<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre: </label>
    <input type="text" id="nombre" name="producto[nombre]" placeholder="Nombre del Producto" value="<?php echo s($producto->nombre); ?>">

    <label for="imagen">Imagen: </label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="producto[imagen]">

    <?php if($producto->imagen){ ?>
        <img src="../../imagenes/<?php echo $producto->imagen ?>" class="imagen-small">
    <?php } ?>

    <label for="precio">Precio: </label>
    <input type="text" id="precio" name="producto[precio]" placeholder="Precio del Producto" value="<?php echo s($producto->precio); ?>">

    <label for="cantidad">Cantidad de piezas: </label>
    <input type="text" id="cantidad" name="producto[cantidad]" placeholder="Cantidad de piezas del Producto" value="<?php echo s($producto->cantidad); ?>">

    <label for="talla">Talla: </label>
    <input type="text" id="talla" name="producto[talla]" placeholder="Talla del Producto" value="<?php echo s($producto->talla); ?>">
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
<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">

    <h1>Crea una cuenta</h1>

    <form class="formulario">
        <fieldset>
            <legend>Llena el formulario</legend>

            <label for="nombre">Nombre:</label>
            <input type="nombre" name="nombre" placeholder="Tu Nombre">

            <label for="apellido">Apellido: </label>
            <input type="apellido" name="apellido" placeholder="Tu Apellido">

            <label for="telefono">Teléfono: </label>
            <input type="telefono" name="telefono" placeholder="Tu Teléfono">

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Tu Email">

            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Tu Password">
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Crear Cuenta" class="boton-submit">
        </div>
    </form>

    <div class="contenedor contenido-centrado acciones">
        <a href="login.php">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="olvide-password.php">¿Olvidaste la contraseña?</a>
    </div>

</main>

<?php 
    incluirTemplate('footer');
?>
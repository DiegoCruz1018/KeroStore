<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">

    <h1>Inicia Sesión</h1>

    <form class="formulario">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Tu Email">

            <label for="password">Password: </label>
            <input type="password" name="password" placeholder="Tu Password">
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Iniciar Sesión" class="boton-submit">
        </div>
    </form>

    <div class="contenedor contenido-centrado acciones">
        <a href="crear-cuenta.php">¿Aún no tienes una cuenta? Crea Una</a>
        <a href="olvide-password.php">¿Olvidaste la contraseña?</a>
    </div>

</main>

<?php 
    incluirTemplate('footer');
?>
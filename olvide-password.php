<?php 
    require 'includes/app.php';
    incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado mb-2">

    <h1>Olvide mi Password</h1>

    <form class="formulario">
        <fieldset>
            <legend>Restablece tu password</legend>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Tu Email">
        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Enviar Instrucciones" class="boton-submit">
        </div>
    </form>

    <div class="contenedor contenido-centrado acciones">
        <a href="crear-cuenta.php">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="olvide-password.php">¿Aún no tienes cuenta? Crea Una</a>
    </div>

</main>

<?php 
    incluirTemplate("footer");
?>
<?php
    require 'includes/app.php';

    incluirTemplate('header');
?>

<main class="contenedor contenido-centrado margin-top">
    <h1>Confirma tu cuenta</h1>

    <h3>Hemos enviado las instrucciones para confirmar tu cuenta a tu e-mail</h3>
</main>

<?php
    incluirTemplate('footer', $inicio = false, $abajo = true);
?>
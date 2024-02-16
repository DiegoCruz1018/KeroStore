<?php

    require 'includes/app.php';

    use App\Email;
    use App\Usuario;

    iniciarSession();

    $auth = $_SESSION['login'] ?? false;

    $errores = [];
    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $auth = new Usuario($_POST);

        $errores = $auth->validarEmail();

        if(empty($errores)){
            $usuario = Usuario::where('email', $auth->email);

            if($usuario && $usuario->confirmado = "1"){
                //Generar un token
                $usuario->crearToken();

                $usuario->actualizar();

                //Enviar el email
                $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                $email->enviarInstrucciones();

                //Alerta de exito
                Usuario::setAlerta('Revisa tu email');

            }else{
                Usuario::setError('El usuario no existe o no esta confirmado');
            }
        }
    }

    $errores = Usuario::getErrores();
    $alertas = Usuario::getAlertas();

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

<main class="contenedor seccion contenido-centrado margin-top">

    <h1>Olvide mi Password</h1>

    <?php include_once __DIR__ . '/includes/templates/alertas.php'; ?>

    <?php foreach($alertas as $alerta): ?>
        <div class="alerta exito">
            <?php echo $alerta ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="post" action="olvide-password.php">
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
        <a href="login.php">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="crear-cuenta.php">¿Aún no tienes cuenta? Crea Una</a>
    </div>

</main>

<?php 
    incluirTemplate('footer', $inicio = false, $abajo = false, $masAbajo = true);
?>
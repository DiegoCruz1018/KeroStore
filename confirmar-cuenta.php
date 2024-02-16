<?php

    use App\Usuario;

    require 'includes/app.php';

    iniciarSession();

    $auth = $_SESSION['login'] ?? false;

    $alertas = [];
    $errores = [];

    $token = s($_GET['token']);

    $usuario = Usuario::where('token', $token);

    if(empty($usuario) || $usuario->token === ''){
        //Mostrar mensaje de error
        Usuario::setError('Token no valido');
    }else{
        //Modificar a usuario confirmado
        $usuario->confirmado = "1";
        $usuario->token = null;
        $usuario->actualizar();

        Usuario::setAlerta('Cuenta Comprobada correctamente');
    }

    $alertas = Usuario::getAlertas();
    $errores = Usuario::getErrores();

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

<main class="contenedor contenido-centrado margin-top">
    <h1>Confirmar Cuenta</h1>

    <?php foreach($alertas as $alerta): ?>
        <div class="alerta exito">
            <?php echo $alerta ?>
        </div>
    <?php endforeach; ?>

    <?php include_once __DIR__ . '/includes/templates/alertas.php'; ?>

    <div class="contenedor contenido-centrado acciones">
        <a href="login.php">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="olvide-password.php">¿Olvidaste la contraseña?</a>
    </div>
</main>

<?php 
    incluirTemplate('footer', $inicio = false, $abajo = false, $masAbajo = true);
?>
<?php

    require 'includes/app.php';

    use App\Usuario;

    iniciarSession();

    $auth = $_SESSION['login'];

    $errores = [];
    $alerta = false;

    //Obtenemos el token del usuario desde get
    $token = s($_GET['token'] ?? "");

    //Buscar usuario por su token
    $usuario = Usuario::where('token', $token);

    if(empty($usuario)){
        // //Si token no obtiene un valor desde GET detenemos la renderización de la vista
        // if(!$token){
            
        // }
        Usuario::setError('Token no válido');
        $alerta = true;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        //Leer el nuevo password
        $password = new Usuario($_POST);

        $errores = $password->validarPassword();

        if(empty($errores)){

            $usuario->password = null;

            $usuario->password = $password->password;
            $usuario->hashPassword();
            $usuario->token = null;

            $resultado = $usuario->actualizar();

            if($resultado){
                header('Location: /kerostore/login.php');
            }
        }
    }

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

<main class="contenedor contenido-centrado margin-top-2">
    <h1>Recuperar Password</h1>
    <h3>Coloca tu nuevo passsword a continuación</h3>

    <?php include_once __DIR__ . '/includes/templates/alertas.php'; ?>

    <?php if($alerta) return; ?>

    <form class="formulario" method="post">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password" placeholder="Tu Nuevo Password">

        <div class="alinear-derecha">
            <input type="submit" class="boton-submit" value="Guardar Nuevo Password">
        </div>
    </form>

    <div class="contenedor contenido-centrado acciones">
        <a href="crear-cuenta.php">¿Ya tienes cuenta? Inicia Sesión</a>
        <a href="olvide-password.php">¿Aún no tienes cuenta? Crea Una</a>
    </div>
</main>

<?php 
    incluirTemplate('footer', $inicio=false, $abajo=true);
?>
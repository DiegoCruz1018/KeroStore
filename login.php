<?php

    require 'includes/app.php';

    use App\Usuario;

    iniciarSession();

    $auth = $_SESSION['login'] ?? false;

    $errores = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $auth = new Usuario($_POST);

        $errores = $auth->validarLogin();

        if(empty($errores)){
            //Comprobar que el usuario exista
            $usuario = Usuario::where('email', $auth->email);

            if($usuario){
                //Verificar el password
                if($usuario->comprobarPasswordAndVerificado($auth->password)){
                    //Autenticar al usuario
                    session_start();

                    $_SESSION['id'] = $usuario->id;
                    $_SESSION['nombre'] = $usuario->nombre;
                    $_SESSION['apellido'] = $usuario->apellido;
                    $_SESSION['email'] = $usuario->email;
                    $_SESSION['login'] = true;

                    //Redireccionamiento
                    if($usuario->idRol === '1'){
                        $_SESSION['idRol'] = $usuario->idRol ?? null;
                        header('Location: /kerostore/admin/index.php');
                    }else{
                        header('Location: /kerostore/index.php');
                    }
                }
            }else{
                Usuario::setError('Usuario no encontrado');
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

<main class="contenedor seccion contenido-centrado">

    <h1>Inicia Sesión</h1>

    <?php include_once __DIR__ . '/includes/templates/alertas.php'; ?>

    <form class="formulario" method="post" action="login.php">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Tu Email" value="<?php echo $auth->email; ?>">

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
    incluirTemplate('footer', $inicio = false, $abajo = true);
?>
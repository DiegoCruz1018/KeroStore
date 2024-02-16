<?php
    require 'includes/app.php';

    iniciarSession();

    $auth = $_SESSION['login'] ?? false;

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
    <h1>Confirma tu cuenta</h1>

    <h3>Hemos enviado las instrucciones para confirmar tu cuenta a tu e-mail</h3>
</main>

<?php
    incluirTemplate('footer', $inicio = false, $abajo = false, $masAbajo=true);
?> 
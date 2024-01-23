<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KeroStore</title>
        <link rel="stylesheet" href="/KeroStore/build/css/app.css">
        <link rel="icon" href="/KeroStore/src/img/logo.ico">
    </head>
    <body>
        <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
            <div class="contenedor">
                <div class="barra">

                    <a class="a-header" href="/KeroStore/index.php"> Kero<span>Store</span> </a> 

                    <div class="navegacion">
                        <a href="/KeroStore/login.php">Login</a>
                        <a href="/KeroStore/contacto.php">Contacto</a>
                        <a href="/KeroStore/carrito.php">Carrito</a>
                    </div>
                </div>
            </div>
        </header>
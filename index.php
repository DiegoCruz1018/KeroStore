<?php
    require 'includes/app.php';

    use App\Producto;

    $db = conectarDB();

    iniciarSession();
    $auth = $_SESSION['login'] ?? false;

    $productos = Producto::all();

    incluirTemplate('header', $inicio = true);
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

        <main class="contenedor">
            <h2>Nuestra Variedad</h2>

            <div class="info-publicidad">
                <div class="publicidad">
                    <div class="diseño-publicidad">
                        <img src="build/img/info-playera.png" alt="Imagen playera">
                    </div>
                    <h3>Playeras</h3>
                </div>
                <div class="publicidad">
                    <div class="diseño-publicidad">
                        <img src="build/img/info-gorro.png" alt="Imagen playera">
                    </div>
                    <h3>Gorras</h3>
                </div>
                <div class="publicidad">
                    <div class="diseño-publicidad">
                        <img src="build/img/info-sueter.png" alt="Imagen playera">
                    </div>
                    <h3>Sueters</h3>
                </div>
            </div>
            
        </main>

        <section class="contenedor">
            <div class="vista-grid">
                <div class="vista1">
                    <img src="build/img/vista1.png" alt="vista 1">
                </div>
                <div class="vista2">
                    <img src="build/img/vista2.jpg" alt="vista 2">
                </div>
                <div class="vista3">
                    <img src="build/img/vista3.jpg" alt="vista 3">
                </div>
            </div>
        </section>

        <section class="contenedor productos">

            <h3>Nuestros Productos</h3>

            <!-- <div class="info-publicidad">
                <?php // foreach($productos as $producto): ?>
                    <div class="publicidad">
                        <div class="diseño-producto">
                            <img class="producto-imagen" src="/kerostore/imagenes/<?php echo $producto->imagen; ?>" alt="Imagen playera">
                        </div>

                        <h3 class="nombre-producto" ><?php // echo $producto->nombre; ?></h3>

                        <p class="precio-producto"><?php // echo "$" . $producto->precio; ?></p>

                        <div id="agregar" class="agregar">
                            <a href="producto.php?id=<?php // echo $producto->id; ?>" class="boton-ver">Ver</a>
                            <button id="agregarCarrito" class="agregar-carrito boton-carrito-v1">Agregar</button>
                        </div>
                    </div>
                <?php // endforeach; ?>
            </div>  -->

            <!-- MOSTRAR LOS PRODUCTOS EXTRAIDOS DESDE UNA API -->
            <div id="productos" class="info-publicidad"></div> 
        </section>

        <script src="build/js/bundle.min.js"></script>
    </body>

<?php 
    incluirTemplate('footer');
?>
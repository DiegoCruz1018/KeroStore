<?php
    require 'includes/app.php';

    use App\Producto;

    $db = conectarDB();

    $productos = Producto::all();

    incluirTemplate('header', $inicio = true);
?>

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

            <div class="info-publicidad">
                <?php foreach($productos as $producto): ?>
                    <a href="producto.php?id=<?php echo $producto->id; ?>" class="publicidad">
                        <div class="diseño-producto">
                            <img src="/kerostore/imagenes/<?php echo $producto->imagen; ?>" alt="Imagen playera">
                        </div>

                        <h3><?php echo $producto->nombre; ?></h3>

                        <div class="agregar">
                            <p><?php echo "$" . $producto->precio; ?></p>
                            <form action="">
                                <input class="boton-carrito-v1" type="submit" value="Agregar">
                            </form>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>

        <script src="build/js/bundle.min.js" ></script>
    </body>

<?php 
    incluirTemplate('footer');
?>
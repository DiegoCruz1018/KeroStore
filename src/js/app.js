const carrito = {
    productos: [],
    precio: '',
    cantidad: ''
};

document.addEventListener('DOMContentLoaded', function() {
    iniciarApp();
});

function iniciarApp(){
    consultarAPI();
}

async function consultarAPI(){
    try {
        const url = 'http://localhost/KeroStore/APIProductos.php';
        const resultado = await fetch(url);
        const productos = await resultado.json();

        mostrarProductos(productos);
    } catch (error) {
        console.log(error);
    }
}

function mostrarProductos(productos){
    productos.forEach(producto =>{
        const {id, nombre, imagen, precio} = producto;

        /* PRODUCTOS DEL INDEX */
        //DIV para la imagen del producto
        const imagenProducto = document.createElement('DIV');
        imagenProducto.innerHTML =`<img class="producto-imagen" src="/kerostore/imagenes/${imagen}" alt="Imagen playera"> `;
        imagenProducto.classList.add('diseño-producto');

        //Nombre del producto
        const nombreProducto = document.createElement('H3');
        nombreProducto.classList.add('nombre-producto');
        nombreProducto.textContent = nombre;

        //Precio del producto
        const precioProducto = document.createElement('P');
        precioProducto.classList.add('precio-producto');
        precioProducto.textContent = `$${precio}`;

        //Div para el boton agregar y el boton ver
        const agregarDiv = document.createElement('DIV')
        agregarDiv.innerHTML = `<a href="producto.php?id=${id}" class="boton-ver">Ver</a>`;
        agregarDiv.classList.add('agregar');

        const btnAgregar = document.createElement('BUTTON');
        btnAgregar.classList.add('agregar-carrito');
        btnAgregar.classList.add('boton-carrito-v2');
        btnAgregar.textContent = 'Agregar';
        btnAgregar.dataset.idProducto = id;
        btnAgregar.onclick = function(){
            agregarCarrito(producto);
        }

        agregarDiv.appendChild(btnAgregar);

        //Div para cada producto
        const productoDiv = document.createElement('DIV');
        productoDiv.classList.add('publicidad');

        //Añadiendo las diferentes secciones al div de productos
        productoDiv.appendChild(imagenProducto);
        productoDiv.appendChild(nombreProducto);
        productoDiv.appendChild(precioProducto);
        productoDiv.appendChild(agregarDiv);

        //Añadiendo todo el div del producto al div con el id 'productos' que esta en el HTML
        document.querySelector('#productos').appendChild(productoDiv);
    });
}

function agregarCarrito(producto){

    const { id } = producto;

    //Extraer el arreglo de servicios
    const {productos} = carrito

    //Identificar el elemento al que se le da click
    const agregarBtn = document.querySelector(`[data-id-producto="${id}"]`);

    //Comprobar si un servicio ya fue agregado
    if(productos.some(agregado => agregado.id === id)){
        //Agregar Cantidad

        //Filter nos permite sacar un elemento basado en cierta condición
        carrito.productos = productos.filter(agregado => agregado.id != id);
        agregarBtn.classList.remove('boton-agregado');
        agregarBtn.classList.add('boton-carrito-v2');
        agregarBtn.textContent = 'Agregar';
    }else{
        //Agregarlo
        agregarBtn.classList.remove('boton-carrito-v2')
        agregarBtn.classList.add('boton-agregado');
        agregarBtn.textContent = 'Agregado';
        //Toma una copia y se agrega el nuevo producto
        carrito.productos = [...productos, producto];
    }

    console.log(carrito);
}
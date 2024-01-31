<?php

namespace App;

class Producto extends ActiveRecord{

    protected static $tabla = 'productos';
    protected static $columnasDB = ['id', 'nombre', 'imagen', 'precio', 'cantidad', 'idCategoria', 'talla', 'creado'];

    public $id;
    public $nombre;
    public $imagen;
    public $precio;
    public $cantidad;
    public $idCategoria;
    public $talla;
    public $creado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '' ;
        $this->imagen = $args['imagen'] ?? '';
        $this->precio = $args['precio'] ?? '' ;
        $this->cantidad = $args['cantidad'] ?? '' ;
        $this->idCategoria = $args['idCategoria'] ?? '';
        $this->talla = $args['talla'] ?? '';
        $this->creado = date('Y-m-d');
    }
}
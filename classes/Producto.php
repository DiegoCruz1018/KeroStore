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

    public function validar(){

        if(!$this->nombre){
            self::$errores[] = "Debes añadir un nombre";
        }

        if(!$this->imagen){
            self::$errores[] = "La imagen es obligatoria";
        }

        if(!$this->precio){
            self::$errores[] = "El precio es obligatorio";
        }

        if(!$this->cantidad){
            self::$errores[] = "La cantidad de piezas es obligatorio";
        }

        if(!$this->talla){
            self::$errores[] = "La talla es obligatoria";
        }

        if(!$this->idCategoria){
            self::$errores[] = "Debes añadir una categoría";
        }

        return self::$errores;
    }
}
<?php 

namespace App;

class Categoria extends ActiveRecord{

    protected static $tabla = 'categorias';
    protected static $columnasDB = ['id', 'nombre'];

    public $id;
    public $nombre;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '' ;
    }

    public function validar()
    {
        if(!$this->nombre){
            self::$errores[] = 'Debes darle un nombre a la categoria';

            return self::$errores;
        }
    }
}
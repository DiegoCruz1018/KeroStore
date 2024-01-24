<?php

namespace App;

class Producto{

    //Base de datos
    protected static $db;
    protected static $columnasDB = ['id', 'nombre', 'imagen', 'precio', 'cantidad', 'idCategoria', 'talla', 'creado'];

    //Errores 
    protected static $errores = [];
    
    public $id;
    public $nombre;
    public $imagen;
    public $precio;
    public $cantidad;
    public $idCategoria;
    public $talla;
    public $creado;

    //Definir la conexión a la BD
    public static function setDB($database){
        self::$db = $database;
    }

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '' ;
        $this->imagen = $args['imagen'] ?? '';
        $this->precio = $args['precio'] ?? '' ;
        $this->cantidad = $args['cantidad'] ?? '' ;
        $this->idCategoria = $args['idCategoria'] ?? 1;
        $this->talla = $args['talla'] ?? '';
        $this->creado = date('Y-m-d');
    }

    public function guardar(){

        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // $string = join(', ', array_keys($atributos));
        // $string = join(', ', array_values($atributos));
        
        $query = "INSERT INTO productos (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES ('";
        $query .= join("', '", array_values($atributos));
        $query .= "') ";

        $resultado = self::$db->query($query);

        return $resultado;
    }

    //Identificar y unir los atributos de la BD
    public function atributos(){
        $atributos = [];

        foreach(self::$columnasDB as $columna){
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    public function sanitizarAtributos(){
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    //Subida de archivos
    public function setImagen($imagen){
        
        //Asignar al atributo de imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    //Validación
    public static function getErrores(){
        return self::$errores;
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

    //Lista todas las propiedades
    public static function all(){

        $query = "SELECT * FROM productos";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    public static function consultarSQL($query){

        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = self::crearObjecto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjecto($registro){
        $objecto = new self;

        foreach($registro as $key => $value){
            if(property_exists($objecto, $key)){
                $objecto->$key = $value;
            }
        }

        return $objecto;
    }
}
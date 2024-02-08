<?php 

namespace App;

class Usuario extends ActiveRecord{

    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'token', 'confirmado', 'creado', 'idRol', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $token;
    public $confirmado;
    public $creado;
    public $idRol;
    public $telefono;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->creado = date('Y-m-d');
        $this->idRol = $args['idRol'] ?? '2';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validarNuevaCuenta(){

        if(!$this->nombre){
            self::$errores[] = 'El nombre es obligatorio';
        }

        if(!$this->apellido){
            self::$errores[] = 'El apellido es obligatorio';
        }

        if(!$this->email){
            self::$errores[] = 'El email es obligatorio';
        }

        if(!$this->telefono){
            self::$errores[] = 'El telefono es obligatorio';
        }

        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }

        if(strlen($this->password) < 6){
            self::$errores[] = 'El password debe contener al menos 6 caracteres';
        }

        return self::$errores;
    }

    //Revisa si el usuario ya existe
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado->num_rows){
            self::$errores[] = 'El usuario ya esta registrado';
        }

        return $resultado;
    }

    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token = uniqid();
    }
}